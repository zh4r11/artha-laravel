<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Keranjang;
use Illuminate\Http\Request;

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
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'telepon' => 'required|string',
            'prov' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'kode_pos' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $order = new Order();
        $order->pelanggan_id = $request->pelanggan_id;
        $order->telepon = $request->telepon;
        $order->no_order = 'ORD-' . time();
        $order->status = 'new';
        $order->prov = $request->prov;
        $order->kota = $request->kota;
        $order->kecamatan = $request->kecamatan;
        $order->kelurahan = $request->kelurahan;
        $order->kode_pos = $request->kode_pos;
        $order->alamat = $request->alamat;
        $order->save();

        $orderCart = Keranjang::where('id_pelanggan', $request->pelanggan_id)->get();

        foreach ($orderCart as $cart) {
            $order->orderDetail()->create([
                'id_produk' => $cart->id_produk,
                'qty' => $cart->qty,
            ]);
            $order->total += $cart->produk->harga_produk * $cart->qty;
        }
        
        $order->save();
        // $orderCart->each->delete();

        return response()->json([
            'status' => true,
            'message' => 'Order created',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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
