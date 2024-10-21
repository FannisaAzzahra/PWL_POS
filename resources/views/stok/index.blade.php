@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Stok Barang</h3>
            <div class="card-tools">
                <!-- Tombol untuk Import Stok -->
            <button onclick="modalAction('{{ url('/stok/import') }}')" class="btn btn-info">Import Stok</button>
            <!-- Tombol untuk Export Data ke Excel -->
            <a href="{{ url('/stok/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Stok</a>
            <!-- Tombol untuk Export Data ke PDF -->
            <a href="{{ url('/stok/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Stok</a>
            <!-- Tombol Tambah Data (Ajax) -->
            <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- <!-- Untuk Filter data -->
            <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2"> --}}
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row align-items-center">
                            <label class="col-2 control-label col-form-label">Filter supplier:</label>
                            <div class="col-3">
                                <select class="form-control" id="supplier_id" name="supplier_id" required>
                                    <option value="" style="padding: 5px 10px;">- Semua -</option>
                                    @foreach ($supplier as $item)
                                        <option value="{{ $item->supplier_id }}">{{ $item->supplier_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row align-items-center">
                            <label class="col-2 control-label col-form-label">Filter barang:</label>
                            <div class="col-3">
                                <select class="form-control" id="barang_id" name="barang_id" required>
                                    <option value="" style="padding: 5px 10px;">- Semua -</option>
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row align-items-center">
                            <label class="col-2 control-label col-form-label">Filter user:</label>
                            <div class="col-3">
                                <select class="form-control" id="user_id" name="user_id" required style="padding-left: 10px;">
                                    <option value="" style="padding: 5px 10px;">- Semua -</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->user_id }}">{{ $item->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                    
                    </div>
                </div>
                

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Nama Barang</th>
                        <th>Nama User</th>
                        <th>Stok Tanggal</th>
                        <th>Stok Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

<!-- Modal untuk Form Import -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>

@endsection
@push('css')
@endpush
@push('js')
    <script>

    // Fungsi modalAction untuk memuat konten ke dalam modal
    function modalAction(url = ''){
        $('#myModal').load(url, function(){
            $('#myModal').modal('show');
        });
    }
    var datastok;
        $(document).ready(function() {
                datastok = $('#table_stok').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('stok/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.supplier_id = $('#supplier_id').val();
                        d.barang_id = $('#barang_id').val();
                        d.user_id = $('#user_id').val();
                    }
                },
                columns: [{
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "supplier.supplier_nama",
                    className: "",
                    // orderable: true, jika ingin kolom ini bisa diurutkan
                    orderable: true,
                    // searchable: true, jika ingin kolom ini bisa dicari
                    searchable: true
                }, {
                    data: "barang.barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    // mengambil data level hasil dari ORM berelasi
                    data: "user.username",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "stok_tanggal",
                    className: "",
                    orderable: true,
                    searchable: false
                }, {
                    data: "stok_jumlah",
                    className: "",
                    orderable: true,
                    searchable: false
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#supplier_id').on('change',function(){
                datastok.ajax.reload();
            });
            $('#barang_id').on('change',function(){
                datastok.ajax.reload();
            });
            $('#user_id').on('change',function(){
                datastok.ajax.reload();
            });
        });
    </script>
@endpush