<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pelanggan.index');
    }

    public function indexPelanggan()
    {
        $pelanggan = Pelanggan::all();
        return response()->json([
            'message' => 'Success',
            'data' => $pelanggan
        ], 200);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.form', ['isFormEdit' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pelanggan = Pelanggan::create($request->all());
        return response()->json([
            'message' => 'Pelanggan created successfully',
            'data' => $pelanggan
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return view('admin.pelanggan.form', ['isFormEdit' => true, 'pelanggan' => $pelanggan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $pelanggan = Pelanggan::find($request->id);

        $pelanggan->update($request->all());

        return response()->json([
            'message' => 'Pelanggan updated successfully',
            'data' => $pelanggan
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        return response()->json([
            'message' => 'Pelanggan deleted successfully'
        ], 200);
    }
}
