<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.order.index');
    }

    public function indexOrder()
    {
        $orders = Order::with('pelanggan')->get();
        return response()->json([
            'data' => $orders,
        ]);
    }

    public function indexBuyer() {
        $user = Auth::user();
        $pelanggan = Pelanggan::where('email', $user->email)->first();
        $orders = Order::where('pelanggan_id', $pelanggan->id)->get();
        return view('order', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $pelanggan = Pelanggan::where('email', $user->email)->first();

        $request->validate([
            'nama' => 'required|string',
            'telepon' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'kode_pos' => 'required|string',
            'alamat' => 'required|string',
        ]);
        
        $order = new Order();
        $order->nama = $request->nama;
        $order->pelanggan_id = $pelanggan->id;
        $order->telepon = $request->telepon;
        $order->no_order = 'ORD-' . time();
        $order->status = 'new';
        $order->provinsi = $request->provinsi;
        $order->kota = $request->kota;
        $order->kecamatan = $request->kecamatan;
        $order->kelurahan = $request->kelurahan;
        $order->kode_pos = $request->kode_pos;
        $order->alamat = $request->alamat;
        $order->save();

        $orderCart = Keranjang::where('id_pelanggan', $pelanggan->id)->get();
        
        foreach ($orderCart as $cart) {
            $order->orderDetail()->create([
                'id_order' => $order->id,
                'id_produk' => $cart->id_produk,
                'qty' => $cart->qty,
            ]);
            $order->total += $cart->produk->harga_produk * $cart->qty;
        }
        
        $order->save();
        $orderCart->each->delete();

        return response()->json([
            'status' => true,
            'id' => $order->id,
            'message' => 'Order created',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::where('id', $id)->with('orderDetail.produk')->get();
        return response()->json([
            'data' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function uploadBukti(Request $request) {
        $order = Order::find($request->id);

        // Generate a unique file name
        $fileName = time() . '_' . $request->document->getClientOriginalName();
            
        // Store the photo with the custom file name
        $path = $request->document->storeAs('assets/buktibayar', $fileName, 'public');

        $order->bukti_bayar = $fileName;
        $order->status = 'processed';
        $order->status_pembayaran = true;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Upload Succeded'
        ]);
    }

    public function downloadInvoice(Request $request) {
        $order = Order::find($request->id);
        $orderDetail = OrderDetail::where('id_order', $order->id)->with('produk')->get();

        $customer = new Party([
            'name'          => $order->name,
            'address'       => $order->alamat,
            'custom_fields' => [
                'order number' => $order->no_order,
            ],
        ]);

        $items = [];

        foreach ($orderDetail as $detail) {
            $items[] = InvoiceItem::make($detail->produk->nama_produk)
                    ->pricePerUnit($detail->produk->harga_produk)
                    ->quantity($detail->qty);
        }
        Log::info($items);
        
        $notes = [
            'Pembayaran hanya ke rekening',
            'BCA 12345678 a/n Artha Kreasi',
        ];
        $notes = implode("<br>", $notes);

        $status_bayar = 'invoices::invoice.paid';
        if (!$order->status_pembayaran) {
            $status_bayar = 'invoices::invoice.due';
        }

        $invoice = Invoice::make('receipt')
                ->status(__($status_bayar))
                ->buyer($customer)
                ->currencySymbol('Rp')
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator('.')
                ->currencyDecimalPoint(',')
                ->filename(trim($order->no_order . ' ' . $customer->name))
                ->addItems($items)
                ->notes($notes)
                ->logo(public_path('vendor/invoices/zeks.T00.png'))
                ->date($order->created_at)
                ->dateFormat('d-m-Y')
                ->save('public');

        $link = $invoice->url();

        return response()->json([
            'success' => true,
            'message' => 'Invoice Downloaded',
            'link' => $link,
        ]);
    }

    public function updateStatus(Request $request) {
        $order = Order::find($request->id);

        if($order->status == 'processed') {
            $order->status = 'shiped';
            $order->tracking_number = $request->tracking_number;
        } else if($order->status == 'shiped') {
            $order->status = 'delivered';
        }
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Status Order Updated',
        ]);
    }

    public function completeOrder(Request $request) {
        $order = Order::find($request->id);
        $order->status = 'completed';
        $order->save();
        return response()->json([
            'success' => true,
            'message' => 'Order Completed',
        ]);
    }

    public function cancelOrder(Request $request) {
        $order = Order::find($request->id);
        $order->status = 'canceled';
        $order->save();
        return response()->json([
            'success' => true,
            'message' => 'Order Canceled',
        ]);
    }
}
