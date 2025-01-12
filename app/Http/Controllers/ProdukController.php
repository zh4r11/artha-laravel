<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.produk.index'); 
    }

    public function getAllProduks()
    {
        $produk = Produk::all();
        return response()->json([
            'data' => $produk,
        ]);
    }

    public function indexStore()
    {
        $produk = Produk::all();
        return view('index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produk.form', ['isFormEdit' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'harga_diskon' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validate each image
        ]);

        // Save the product data
        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->harga_produk = $request->harga_produk;
        $produk->harga_diskon = $request->harga_diskon;
        $produk->deskripsi = $request->deskripsi;
        $produk->save();

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            for ($i = 1; $i <= count($photos); $i++) {
                $path = $photos[$i]->store('public/assets/images/products-images');
                $produk->foto.$i = $path;
            }
            $produk->save();
        }

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'status' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $produk = Produk::find($id);
        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
