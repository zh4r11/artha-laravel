<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //        
    $validatedData = $request->validate([
        'id_produk' => 'required|integer',
        'qty' => 'required|integer|min:1',
    ]);

    $keranjang = new Keranjang();
    $keranjang->id_pelanggan = $validatedData['id_pelanggan'];
    $keranjang->id_produk = $validatedData['product_id'];
    $keranjang->quantity = $validatedData['quantity'];
    $keranjang->save();

    return response()->json(['message' => 'Product added to cart successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        //
    }
}
