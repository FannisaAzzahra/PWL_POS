@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($transaksi)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('transaksi') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/transaksi/' . $transaksi->transaksi_id) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh
                    method PUT -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">User</label>
                        <div class="col-11">
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">- Pilih user -</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->user_id }}" @if ($item->user_id == $transaksi->user_id) selected @endif>
                                        {{ $item->username }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Pembeli</label>
                        <div class="col-11">
                            <input type="text" class="form-control" name="pembeli" value="{{ old('pembeli', $transaksi->pembeli) }}" required>
                            @error('pembeli')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kode Transaksi</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="transaksi_kode" name="transaksi_kode" value="{{ old('transaksi_kode') }}" required>
                            @error('transaksi_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Transaksi</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="transaksi_tanggal" name="transaksi_tanggal"
                                value="{{ old('transaksi_tanggal', $transaksi->transaksi_tanggal) }}" required>
                            @error('transaksi_tanggal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('transaksi') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush