<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjang = Keranjang::where('id_pelanggan', Auth::id())->with('produk')->get();
        return response()->json([
            'message' => 'Success',
            'cartItems' => $keranjang
        ], 200);
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
        
        $existingCart = Keranjang::where('id_pelanggan', Auth::id())
            ->where('id_produk', $validatedData['id_produk'])
            ->first();

        if ($existingCart) {
            $existingCart->qty += $validatedData['qty'];
            $existingCart->save();

            return response()->json([
                'message' => 'Product added to cart successfully',
                'success' => true
            ], 201);
        }else {
            $keranjang = new Keranjang();
            $keranjang->id_pelanggan = Auth::id();
            $keranjang->id_produk = $validatedData['id_produk'];
            $keranjang->qty = $validatedData['qty'];
            $keranjang->save();

            return response()->json([
                'message' => 'Product added to cart successfully',
                'success' => true
            ], 201);
        }
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
    public function destroy(Request $request)
    {
        $keranjang = Keranjang::find($request->id);
        if (!$keranjang) {
            return response()->json([
                'message' => 'Cart item not found',
                'success' => false
            ], 404);
        }

        $keranjang->delete();
        return response()->json([
            'message' => 'Cart item deleted successfully',
            'success' => true
        ], 200);
    }
}
