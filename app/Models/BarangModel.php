<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BarangModel extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $table = 'm_barang'; // Ganti dengan nama tabel yang sesuai

    // Mendefinisikan primary key dari tabel barang
    protected $primaryKey = 'barang_id';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'kategori_id', 
        'barang_kode', 
        'barang_nama', 
        'harga_beli', 
        'harga_jual',
        'image'
    ];

    // Hubungan dengan model Kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    public function barang():HasMany
    {
        return $this->hasMany(StokModel::class, 'stok_id', 'stok_id');
    }

    public function detail():HasMany{
        return $this->hasMany(DetailModel::class, 'barang_id', 'barang_id');
    }

    protected function image(): Attribute{
        return Attribute::make(
            get: fn ($image) => url($image),
        );
    }
    // Tambahkan metode atau logika lain yang diperlukan untuk model ini
}
