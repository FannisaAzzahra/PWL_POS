@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/transaksi/import') }}')" class="btn btn-info">Import transaksi</button>
                    <a href="{{ url('/transaksi/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export transaksi</a>
                    <a href="{{ url('/transaksi/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export transaksi</a>
                    <button onclick="modalAction('{{ url('/transaksi/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Untuk Filter data -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->user_id }}">{{ $item->username}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">user</small>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" id="table_transaksi">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Pembeli</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal Transaksi</th>
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

        var datatransaksi
        $(document).ready(function() {
                datatransaksi = $('#table_transaksi').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('transaksi/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
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
                    // mengambil data level hasil dari ORM berelasi
                    data: "user.user_id",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "pembeli",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "transaksi_kode",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "transaksi_tanggal",
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
            $('#user_id').on('change',function(){
                datatransaksi.ajax.reload();
            });
        });
    </script>
@endpush