<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierModel extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $table = 'm_supplier';

    // Mendefinisikan primary key dari tabel supplier
    protected $primaryKey = 'supplier_id'; 

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'supplier_kode', 
        'supplier_nama', 
        'supplier_alamat', 
        'notelp'
    ];

    public function barang():HasMany
    {
        return $this->hasMany(StokModel::class, 'stok_id', 'stok_id');
    }
}
