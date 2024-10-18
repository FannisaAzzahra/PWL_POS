@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Supplier</h3>
        <div class="card-tools">
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}">Tambah</a> --}}
            <button onclick="modalAction('{{ url('/supplier/import') }}')" class="btn btn-info">Import supplier</button>
                <a href="{{ url('/supplier/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export supplier</a>
                <a href="{{ url('/supplier/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export supplier</a>
            <button onclick="modalAction('{{ url('/supplier/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Alamat Supplier</th>
                    <th>No Telepon</th>
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

    var dataSupplier;
    $(document).ready(function() {
            dataSupplier = $('#table_supplier').DataTable({
            // serverSide: true, jika ingin menggunakan server side processing
            serverSide: true, 
            ajax: {
                "url": "{{ url('supplier/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                {
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "supplier_id", 
                    className: "text-center",
                    width: "5%",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "supplier_kode", 
                    className: "",
                    width: "10%",
                    orderable: true, 
                    searchable: true
                },
                {
                    data: "supplier_nama", 
                    className: "",
                    width: "14%",
                    orderable: true, 
                    searchable: true
                },
                {
                    data: "supplier_alamat", 
                    className: "",
                    width: "37%",
                    orderable: true, 
                    searchable: true
                },
                {
                    data: "notelp", 
                    className: "",
                    width: "14%",
                    orderable: true, 
                    searchable: true
                },
                {
                    data: "aksi", 
                    className: "",
                    width: "14%",
                    orderable: false, 
                    searchable: false
                }
            ]
        });
        $('#table-supplier_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) { // enter key
                    tableSupplier.search(this.value).draw();
                }
        });
            $('.filter_supplier').change(function() {
                tableSupplier.draw();
        });
    });
</script>
@endpush
