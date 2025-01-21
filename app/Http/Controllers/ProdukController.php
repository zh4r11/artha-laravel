<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
        
            // Loop through the photos array
            for ($i = 0; $i < count($photos); $i++) {
                // Log file details for debugging
                Log::info("Uploaded File Details", [
                    'name' => $photos[$i]->getClientOriginalName(),
                    'size' => $photos[$i]->getSize(),
                    'mime' => $photos[$i]->getMimeType(),
                ]);

                // Generate a unique file name
                $fileName = time() . '_' . $photos[$i]->getClientOriginalName();
                
                // Store the photo with the custom file name
                $path = $photos[$i]->storeAs('assets/images/products-images', $fileName, 'public');
                Log::info("message", ['path' => $path]);
        
                // Dynamically assign the path to the corresponding foto field
                $fieldName = 'foto' . ($i + 1); // foto1, foto2, etc.
                $produk->$fieldName = $fileName;
            }
        }
        $produk->save();

        return response()->json([
            'message' => 'Produk berhasil diubah',
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
    public function edit($id)
    {
        $produk = Produk::find($id);
        Log::debug("Produk", ['produk' => $produk]);
        return view('admin.produk.form', ['isFormEdit' => true, 'produk' => $produk]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $produk = Produk::findOrFail($request->kode);
        // Handle deleted photos
        // $deletedPhotos = json_decode($request->input('deleted_photos'), true);
        // if ($deletedPhotos) {
        //     foreach ($deletedPhotos as $photoId) {
        //         // Delete photo from storage and database
        //         $photo = Photo::find($photoId);
        //         if ($photo) {
        //             Storage::delete($photo->path); // Delete from storage
        //             $photo->delete(); // Delete from database
        //         }
        //     }
        // }

        // Delete foto from DB
        $produk->foto1 = null;
        $produk->foto2 = null;
        $produk->foto3 = null;
        $produk->foto4 = null;


        // Handle new photos
        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            Log::info("photo", ['photos' => count($photos)]);
        
            // Loop through the photos array
            for ($i = 0; $i < count($photos); $i++) {
                // Log file details for debugging
                Log::info("Uploaded File Details", [
                    'name' => $photos[$i]->getClientOriginalName(),
                    'size' => $photos[$i]->getSize(),
                    'mime' => $photos[$i]->getMimeType(),
                ]);

                // Generate a unique file name
                $fileName = time() . '_' . $photos[$i]->getClientOriginalName();
                
                // Store the photo with the custom file name
                $path = $photos[$i]->storeAs('assets/images/products-images', $fileName, 'public');
                Log::info("message", ['path' => $path]);
        
                // Dynamically assign the path to the corresponding foto field
                $fieldName = 'foto' . ($i + 1); // foto1, foto2, etc.
                $produk->$fieldName = $fileName;
            }
        }

        // Update other fields
        $produk->update($request->only(['nama_produk', 'harga_produk', 'harga_diskon', 'deskripsi']));

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete(); // This will set the `deleted_at` column to the current timestamp
        return response()->json([
            'message' => 'Produk berhasil dihapus',
            'status' => true,
        ]);
    }
}
