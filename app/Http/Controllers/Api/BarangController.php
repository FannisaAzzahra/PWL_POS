<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        // $barang = BarangModel::create($request->all());
        // return response()->json($barang, 201);

        $validator = Validator::make($request->all(), [
            'kategori_id'   => 'required|integer',
            'barang_kode'   => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama'   => 'required|string|max:100', //nama harus diisi, berupa string, dan maksimal 100 karakter
            'harga_beli'    => 'required|integer', //nama harus diisi, berupa string, dan maksimal 100 karakter
            'harga_jual'    => 'required|integer',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename = time() . '.' . $extension;

        $path = 'image/barang/';
        $file->move($path, $filename);

        $barang = BarangModel::create([
            'kategori_id'   => $request->kategori_id,
            'barang_kode'   => $request->barang_kode,
            'barang_nama'   => $request->barang_nama,
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    => $request->harga_jual,
            'image'         => $path . $filename
        ]);
        if ($barang) {
            return response()->json([
                'success'   => true,
                'barang'      => $barang,
            ],201);
        }
        return response()->json([
            'success'   => false,
        ],409);
    }

    public function show(BarangModel $barang)
    {
        return response()->json($barang);
    }

    public function update(Request $request, BarangModel $barang)
    {
        $barang->update($request->all());
        return response()->json($barang);
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data barang terhapus',
        ]);
    }
}
