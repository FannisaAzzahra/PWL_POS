{{-- @extends('layouts.template')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Halo, apakabar!!!</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        Selamat datang semua, ini adalah halaman utama dari aplikasi ini.
    </div>
</div>
@endsection --}}

@extends('layouts.template')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Halo, Selamat Datang!</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <p>Selamat datang di halaman utama aplikasi kami! Di sini, Anda dapat mengakses berbagai fitur yang dirancang untuk mempermudah pengelolaan data dan meningkatkan efisiensi kerja Anda.</p>

        <!-- Kotak Zigzag -->
        <div class="zigzag-container">
            <div class="zigzag-box light-blue">
                <h4>Menu Navigasi:</h4>
                <div class="non-clickable"> 
                    <strong>Dashboard:</strong> Ikhtisar ringkas tentang semua aktivitas dan informasi penting.
                </div>
                <div class="non-clickable"> 
                    <strong>Profile:</strong> Kelola informasi pribadi dan foto profil Anda.
                </div>
                <div class="non-clickable"> 
                    <strong>Data Pengguna:</strong> Lihat dan kelola semua data pengguna yang terdaftar dalam sistem.
                </div>
                <div class="non-clickable"> 
                    <strong>Level User:</strong> Atur dan kelola level akses pengguna untuk keamanan yang lebih baik.
                </div>
                <div class="non-clickable"> 
                    <strong>Data Supplier:</strong> Informasi lengkap tentang pemasok barang Anda.
                </div>
            </div>
            <div class="zigzag-box dark-blue">
                <h4>Menu Tambahan:</h4>
                <div class="non-clickable"> 
                    <strong>Data Barang:</strong> Manajemen dan pengelolaan barang yang tersedia.
                </div>
                <div class="non-clickable"> 
                    <strong>Kategori Barang:</strong> Kategorisasi barang untuk memudahkan pencarian dan pengelolaan.
                </div>
                <div class="non-clickable"> 
                    <strong>Data Transaksi:</strong> Lihat dan analisis semua transaksi yang telah dilakukan.
                </div>
                <div class="non-clickable"> 
                    <strong>Stok Barang:</strong> Pantau dan kelola stok barang yang ada untuk menjaga ketersediaan.
                </div>
                <div class="non-clickable"> 
                    <strong>Transaksi Penjualan:</strong> Lihat semua transaksi penjualan dan laporan terkait.
                </div>
                <div class="non-clickable"> 
                    <strong>Logout:</strong> Keluar dari aplikasi dengan aman setelah selesai menggunakan.
                </div>
            </div>
        </div>
        <p> </p>
        <p>Jelajahi menu di atas untuk menemukan fitur yang sesuai dengan kebutuhan Anda. Jika ada pertanyaan, jangan ragu untuk menghubungi tim dukungan kami. Selamat bekerja!</p>
    </div>
</div>

@endsection

@push('css')
<style>
    /* Card Styling */
    .card {
        background: #ffffff; /* Putih untuk tampilan yang bersih */
        border-radius: 10px; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
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

    /* Zigzag Container */
    .zigzag-container {
        display: flex;
        flex-direction: column; /* Kolom untuk tata letak */
        gap: 15px; /* Jarak antar kotak */
        margin-top: 20px; /* Jarak atas untuk pemisah */
    }

    .zigzag-box {
        border-radius: 10px; /* Sudut membulat */
        padding: 20px; /* Jarak dalam */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
    }

    .light-blue {
        background-color: #C7E2FF; /* Latar belakang biru terang */
        color: #003366; /* Teks biru tua untuk kontras */
    }

    .dark-blue {
        background-color: #0056b3; /* Latar belakang biru gelap */
        color: #ffffff; /* Teks putih untuk kontras yang lebih baik */
        border: 1px solid #ffffff; /* Tambahkan border putih untuk pemisah yang lebih jelas */
    }

    .non-clickable {
        margin: 15px 0; /* Jarak atas dan bawah antar elemen dalam kotak */
        padding: 10px; /* Jarak dalam */
        background-color: rgba(255, 255, 255, 0.2); /* Latar belakang semi transparan untuk lebih kontras */
        border-radius: 5px; /* Sudut membulat */
    }

    .non-clickable:hover {
        background-color: rgba(255, 255, 255, 0.5); /* Latar belakang saat hover */
    }
</style>
@endpush
