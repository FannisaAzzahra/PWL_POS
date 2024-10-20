<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiModel extends Model
{
    use HasFactory;
    protected $table = 't_transaksi'; // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'transaksi_id'; // Mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = ['transaksi_id', 'user_id', 'pembeli', 'transaksi_kode', 'transaksi_tanggal'];

    public function user():BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id','user_id');
    }
}
