@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Stok</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/stok/import') }}')" class="btn btn-info">Import stok</button>
                    <a href="{{ url('/stok/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export stok</a>
                    <a href="{{ url('/stok/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export stok</a>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="supplier_id" name="supplier_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($supplier as $l)
                                    <option value="{{ $l->supplier_id }}">{{ $l->supplier_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">supplier stok</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="barang_id" name="barang_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">barang stok</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->user_id }}">{{ $item->nama}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">user</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Supplier ID</th>
                        <th>Barang ID</th>
                        <th>User ID</th>
                        <th>Stok tanggal</th>
                        <th>Stok Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

<!-- Modal -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" 
data-keyboard="false" data-width="75%" aria-hidden="true"></div>

@endsection
@push('css')
@endpush
@push('js')
    <script>

        // Fungsi modalAction untuk load konten ke dalam modal
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var tableStok;
        $(document).ready(function() {
                tableStok = $('#table_stok').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                processing: true,
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
                    width: "10%",
                    orderable: true,
                    searchable: true
                }, {
                    data: "barang.barang_nama",
                    className: "",
                    width: "37%",
                    orderable: true,
                    searchable: true,
                }, {
                    // mengambil data level hasil dari ORM berelasi
                    data: "user.nama",
                    className: "",
                    width: "10%",
                    orderable: true,
                    searchable: true
                }, {
                    data: "stok_tanggal",
                    className: "",
                    width: "10%",
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                    if (data) {
                            var date = new Date(data);
                            var year = date.getFullYear();
                            var month = ("0" + (date.getMonth() + 1)).slice(-
                            2); // Add leading zero
                            var day = ("0" + date.getDate()).slice(-2); // Add leading zero
                            return year + "-" + month + "-" + day; // Format as YYYY-MM-DD
                        }
                        return data; // Return original value if no data
                    }
                }, {
                    data: "stok_jumlah",
                    className: "",
                    width: "14%",
                    orderable: true,
                    searchable: false
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#table-stok_filter input').unbind().bind().on('keyup', function(e) {
                    if (e.keyCode == 13) { // enter key
                        tableStok.search(this.value).draw();
                    }
            });
                $('.filter_kategori').change(function() {
                    tableStok.draw();
            });
        });
    </script>
@endpush