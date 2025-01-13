<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['ruc','name', 'email', 'phone', 'address', 'store_id', 'status'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
