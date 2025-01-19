<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Supporrt\Facades\Log;

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

    /**
     * Get order details by ID.
     */
    public function getOrderDetails($id)
    {
        $order = Order::with(['pelanggan', 'orderDetail.produk'])->findOrFail($id);
        
        // Compact the response
        return response()->json([
            'no_order' => $order->no_order,
            'nama' => $order->nama,
            'telepon' => $order->telepon,
            'tracking_number' => $order->tracking_number,
            'total' => $order->total,
            'order_detail' => $order->orderDetail->map(function($detail) {
                return [
                    'qty' => $detail->qty,
                    'produk' => [
                        'nama_produk' => $detail->produk->nama_produk,
                    ],
                ];
            }),
        ]);
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
}
