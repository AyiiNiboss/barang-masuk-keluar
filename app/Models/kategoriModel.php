<?php

namespace App\Models;

use App\Models\barangModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kategoriModel extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama'
    ];

    public function barang()
    {
        return $this->hasMany(barangModel::class);
    }
}

