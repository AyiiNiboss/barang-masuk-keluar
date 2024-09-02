<?php

namespace App\Models;

use App\Models\barangModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class brg_masukModel extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';
    protected $primarykey = 'id';
    protected $fillable = [
        'barang_id','tgl_input','stock'
    ];

    public function barangRelasi(): HasOne
    {
        return $this->hasOne(barangModel::class, 'id', 'barang_id');
    }
}
