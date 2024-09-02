<?php

namespace App\Models;

use App\Models\kategoriModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class barangModel extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primarykey = 'id';
    protected $fillable = [
        'kategori_id','kode_barang','tgl_input','nama_barang','stock','harga'
    ];

    public function barangMasuk()
    {
        return $this->hasMany(brg_masukModel::class);
    }

    public function kategori()
    {
        return $this->belongsTo(kategoriModel::class);
    }
}
