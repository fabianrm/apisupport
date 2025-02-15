<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatSerial extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'code',
        'document',
        'serial',
        'correlative',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


}



