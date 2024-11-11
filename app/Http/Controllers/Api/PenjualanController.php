<?php

// PenjualanController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        return PenjualanModel::with('user', 'detail')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:100',
            'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $imageName = $image ? $image->store('posts', 'public') : null;

        $penjualan = PenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'image' => $image->hashName()
        ]);

        return response()->json([
            'success' => true,
            'penjualan' => $penjualan,
        ], 201);
    }

    public function show(PenjualanModel $penjualan)
    {
        return response()->json($penjualan->load('user', 'detail'));
    }

    public function update(Request $request, PenjualanModel $penjualan)
    {
        $penjualan->update($request->all());
        return response()->json($penjualan);
    }

    public function destroy(PenjualanModel $penjualan)
    {
        $penjualan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data penjualan terhapus',
        ]);
    }
}
