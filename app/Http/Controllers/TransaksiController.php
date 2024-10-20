<?php

namespace App\Http\Controllers;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;


class TransaksiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Transaksi',
            'list' => ['Home', 'Transaksi']
        ];
        $page = (object) [
            'title' => 'Daftar Transaksi Penjualan yang terdaftar dalam sistem'
        ];
        $activeMenu = 'transaksi'; // set menu yang sedang aktif
        $user = UserModel::all(); // ambil data user untuk filter user
        return view('transaksi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Ambil data transaksi dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $transaksi = TransaksiModel::select('transaksi_id', 'user_id', 'pembeli', 'transaksi_kode', 'transaksi_tanggal')
            ->with('user');
        // filter data transaksi berdasarkan user_id
        if ($request->user_id) {
            $transaksi->where('user_id', $request->user_id);
        }
        
        return DataTables::of($transaksi)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($transaksi) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/transaksi/' . $transaksi->transaksi_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/transaksi/' . $transaksi->transaksi_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' .
                //     url('/transaksi/' . $transaksi->transaksi_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm
                //     (\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';

                $btn .= '<button onclick="modalAction(\'' . url('/transaksi/' . $transaksi->transaksi_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/transaksi/' . $transaksi->transaksi_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah transaksi 
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Transaksi',
            'list' => ['Home', 'Transaksi', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah Transaksi baru'
        ];
        $user = UserModel::all(); // ambil data user untuk filter user
        $activeMenu = 'transaksi'; // set menu yang sedang aktif
        return view('transaksi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    // Menyimpan data transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            // transaksiname harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel t_transaksi kolom transaksiname
            'user_id'       => 'required|integer',
            'pembeli'       => 'required|string|max:50',
            'transaksi_kode'  => 'required|string|min:3|unique:t_transaksi,transaksi_kode',
            'transaksi_tanggal'  => 'required|date'
        ]);
        TransaksiModel::create([
            'user_id'       => $request-> user_id,
            'pembeli'       => $request-> pembeli,
            'transaksi_kode'  => $request-> transaksi_kode,
            'transaksi_tanggal'  => $request-> transaksi_tanggal
        ]);
        return redirect('/transaksi')->with('success', 'Data transaksi berhasil disimpan');
    }
    // Menampilkan detail transaksi
    public function show(string $id)
    {
        $transaksi = TransaksiModel::with('user')->find($id);
        $breadcrumb = (object) ['title' => 'Detail transaksi', 'list' => ['Home', 'Transaksi', 'Detail']];
        $page = (object) ['title' => 'Detail transaksi'];
        $activeMenu = 'transaksi'; // set menu yang sedang aktif
        return view('transaksi.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi' => $transaksi, 'activeMenu' => $activeMenu]);
    }
    // Menampilkan halaman fore edit transaksi 
    public function edit(string $id)
    {
        $transaksi = TransaksiModel::find($id);
        $user = UserModel::all(); // ambil data user untuk filter supplier
        $breadcrumb = (object) [
            'title' => 'Edit Transaksi',
            'list' => ['Home', 'Transaksi', 'Edit']
        ];
        $page = (object) [
            "title" => 'Edit Transaksi'
        ];
        $activeMenu = 'transaksi'; // set menu yang sedang aktif
        return view('transaksi.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi'=> $transaksi, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    // Menyimpan perubahan data transaksi
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'       => 'required|integer',
            'pembeli'       => 'required|string|max:50',
            'transaksi_kode'  => 'required|string|min:3|unique:t_transaksi,transaksi_kode',
            'transaksi_tanggal'  => 'required|date'
        ]);
        TransaksiModel::find($id)->update([
            'user_id'       => $request-> user_id,
            'pembeli'       => $request-> pembeli,
            'transaksi_kode'  => $request-> transaksi_kode,
            'transaksi_tanggal'  => $request-> transaksi_tanggal
        ]);
        return redirect('/transaksi')->with("success", "Data transaksi berhasil diubah");
    }
    // Menghapus data transaksi 
    public function destroy(string $id)
    {
        $check = TransaksiModel::find($id);
        if (!$check) {      // untuk mengecek apakah data transaksi dengan id yang dimaksud ada atau tidak
            return redirect('/transaksi')->with('error', 'Data transaksi tidak ditemukan');
        }
        try {
            TransaksiModel::destroy($id); // Hapus data supplier
            return redirect('/transaksi')->with('success', 'Data transaksi berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/transaksi')->with('error', 'Data transaksi gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    // 1. public function create_ajax()
    public function create_ajax()
    {
        return view('transaksi.create_ajax');
    }

    // 2. public function store_ajax(Request $request)
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id'          => 'required|integer',
                'pembeli'          => 'required|string|max:100',
                'transaksi_kode'   => 'required|string|min:3|unique:t_transaksi,transaksi_kode',
                'transaksi_tanggal' => 'required|date',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(),
                ]);
            }

            TransaksiModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data transaksi berhasil disimpan',
            ]);
        }
        return redirect('/');
    }

    // 3. public function edit_ajax(string $id)
    public function edit_ajax(string $id)
    {
        $transaksi = TransaksiModel::find($id);
        return view('transaksi.edit_ajax', ['transaksi' => $transaksi]);
    }

    // 4. public function update_ajax(Request $request, $id)
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id'          => 'required|integer',
                'pembeli'          => 'required|string|max:100',
                'transaksi_kode'   => 'required|string|min:3|unique:t_transaksi,transaksi_kode,' . $id . ',transaksi_id',
                'transaksi_tanggal' => 'required|date',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(),
                ]);
            }

            $check = TransaksiModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    // 5. public function confirm_ajax(string $id)
    public function confirm_ajax(string $id)
    {
        $transaksi = TransaksiModel::find($id);
        return view('transaksi.confirm_ajax', ['transaksi' => $transaksi]);
    }

    // 6. public function delete_ajax(Request $request, $id)
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $transaksi = TransaksiModel::find($id);
            if ($transaksi) {
                $transaksi->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    // 7. public function show_ajax(string $id)
    public function show_ajax(string $id)
    {
        $transaksi = TransaksiModel::find($id);

        if (!$transaksi) {
            return response()->json([
                'message' => 'Transaksi tidak ditemukan.',
            ], 404);
        }

        return view('transaksi.show_ajax', ['transaksi' => $transaksi]);
    }

    // 8. public function import()
    public function import()
    {
        return view('transaksi.import');
    }

    // 9. public function import_ajax(Request $request)
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_transaksi' => ['required', 'mimes:xlsx', 'max:1024'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $file = $request->file('file_transaksi');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'user_id' => $value['A'],
                            'pembeli' => $value['B'],
                            'transaksi_kode' => $value['C'],
                            'transaksi_tanggal' => $value['D'],
                            'created_at' => now(),
                        ];
                    }
                }
            }

            if (count($insert) > 0) {
                TransaksiModel::insertOrIgnore($insert);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diimport',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tidak ada data yang diimport',
            ]);
        }

        return redirect('/');
    }

    // 10. public function export_excel()
    public function export_excel()
    {
        $transaksi = TransaksiModel::select('user_id', 'pembeli', 'transaksi_kode', 'transaksi_tanggal')
            ->with('user') // Pastikan ada relasi di model
            ->orderBy('transaksi_tanggal')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'User ID');
        $sheet->setCellValue('C1', 'Pembeli');
        $sheet->setCellValue('D1', 'Kode Transaksi');
        $sheet->setCellValue('E1', 'Tanggal Transaksi');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;

        foreach ($transaksi as $value) {
            $sheet->setCellValue('A'.$baris, $no);
            $sheet->setCellValue('B'.$baris, $value->user->name); // Menampilkan nama pengguna
            $sheet->setCellValue('C'.$baris, $value->pembeli);
            $sheet->setCellValue('D'.$baris, $value->transaksi_kode);
            $sheet->setCellValue('E'.$baris, $value->transaksi_tanggal);
            $baris++;
            $no++;
        }

        foreach(range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Transaksi');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Transaksi ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    // 11. public function print_pdf()
    public function print_pdf()
    {
        $transaksi = TransaksiModel::select('user_id', 'pembeli', 'transaksi_kode', 'transaksi_tanggal')
            ->with('user') // Pastikan ada relasi di model
            ->get();

            // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('transaksi.print_pdf', ['transaksi' => $transaksi]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption('isRemoteEnabled', true); // set true jika ada gambar dari url
        $pdf->render();

        return $pdf->stream('Data Transaksi ' . date('Y-m-d H:i:s') . '.pdf');
    }
}
