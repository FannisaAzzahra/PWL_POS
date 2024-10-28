@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar User</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/user/import') }}')" class="btn btn-info">Import user</button>
                <a href="{{ url('/user/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export user</a>
                <a href="{{ url('/user/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export user</a>
                <button onclick="modalAction('{{ url('/user/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="level_id" name="level_id" required>
                            <option value="">- Semua -</option>
                            @foreach($level as $item)
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Level Pengguna</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level Pengguna</th>
                    <th>Foto</th>
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
<style>
    /* Card Styling */
    .card {
        background: #ffffff; /* Putih untuk tampilan yang bersih */
        border-radius: 10px; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        transition: transform 0.2s ease; 
    }

    .card:hover {
        transform: translateY(-5px); 
    }

    .card-header {
        background: #007bff; /* Biru yang lebih lembut */
        color: white;
        border-top-left-radius: 10px; 
        border-top-right-radius: 10px; 
        padding: 15px; 
        font-weight: bold; 
        box-shadow: inset 0 -2px 5px rgba(0, 0, 0, 0.1); 
    }

    .card-tools .btn {
        margin-right: 8px; 
        border-radius: 20px; 
        padding: 6px 12px; 
        transition: background 0.3s ease; 
    }

    .btn-success {
        background: #28a745; /* Hijau yang lembut */
        border: none; 
        color: white; 
    }

    .btn-warning {
        background: #ffc107; /* Kuning lembut */
        border: none; 
        color: black; 
    }

    .btn-primary {
        background: #0056b3; /* Biru gelap */
        border: none; 
        color: white; 
    }

    .btn-info {
        background: #17a2b8; /* Biru tua yang lebih lembut */
        border: none; 
        color: white; 
    }

    .btn:hover {
        opacity: 0.9; 
    }

    /* Table Styling */
    #table_level {
        border-collapse: separate; 
        border-spacing: 0 10px; 
    }

    #table_level thead {
        background: #007bff; 
        color: white; 
        border-radius: 10px; 
    }

    #table_level tbody tr {
        background: #f8f9fa; 
        border-radius: 10px; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        transition: background 0.3s, transform 0.3s; 
    }

    #table_level tbody tr:hover {
        background: #e2e6ea; 
        transform: scale(1.02); 
    }

    /* Modal Styling */
    .modal-content {
        background: #ffffff; 
        border-radius: 10px; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    }

    /* Alerts Styling */
    .alert {
        border-radius: 10px; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        padding: 10px 15px; 
    }

    /* Input Search Custom */
    #table-level_filter input {
        border-radius: 20px; 
        padding: 8px 15px; 
        border: 1px solid #ddd; 
        outline: none; 
        transition: border-color 0.3s, box-shadow 0.3s; 
    }

    #table-level_filter input:focus {
        border-color: #007bff; 
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5); 
    }
</style>
@endpush

@push('js')
<script>

    // Fungsi modalAction untuk load konten ke dalam modal
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var tableUser;
    $(document).ready(function() {
            tableUser = $('#table_user').DataTable({
            // serverSide: true, jika ingin menggunakan server side processing
            processing: true,
            serverSide: true, 
            ajax: {
                "url": "{{ url('user/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.level_id = $('#level_id').val();
                }
            },
            columns: [
                {
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex", 
                    className: "text-center",
                    width: "5%",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "username", 
                    className: "",
                    // orderable: true, jika ingin kolom ini bisa diurutkan
                    width: "10%",
                    orderable: true, 
                    // searchable: true, jika ingin kolom ini bisa dicari
                    searchable: true
                },
                {
                    data: "nama", 
                    className: "",
                    width: "25%",
                    orderable: true, 
                    searchable: true
                },
                {
                    // mengambil data level hasil dari ORM berelasi
                    data: "level.level_nama", 
                    className: "",
                    width: "14%",
                    orderable: false, 
                    searchable: false
                },
                {
                    data: "foto",
                    className: "",
                    width: "14%",
                    orderable: false,
                    searchable: false,
                    "render": function(data) {
                            // Check if data exists
                            if (data) {
                                // Construct the image URL using Blade syntax
                                return '<img src=" {{ asset('data') }} " width="50px"/>';
                            }
                            return 'Image Unavailable'; // Return empty if no data
                    }
                },
                {
                    data: "aksi", 
                    className: "text-center",
                    width: "14%",
                    orderable: false, 
                    searchable: false
                    
                }
            ]
        });
        $('#table-user_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) { // enter key
                    tableUser.search(this.value).draw();
                }
            });
            $('#level_id').change(function() {
                tableBarang.draw();
        });
    });
</script>
@endpush
