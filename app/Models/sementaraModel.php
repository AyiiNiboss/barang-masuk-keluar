<?php

namespace App\Models;

use App\Models\barangModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sementaraModel extends Model
{
    protected $table = 'sementara';
    protected $primarykey = 'id';
    protected $fillable = [
        'barang_id','user_id','jumlah','tgl_permintaan','status'
    ];

    public function barangRelasi(): HasOne
    {
        return $this->hasOne(barangModel::class, 'id', 'barang_id');
    }
    
    public function userRelasi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
