<?php

namespace App\Models;

use App\Scopes\StoreScope;
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

    /**
     * Scopes para filtro por tienda de usuario
     */
    // protected static function booted()
    // {
    //     static::addGlobalScope(new StoreScope);
    // }

    // // Si necesitas consultas sin el filtro global
    // public static function withoutStoreScope()
    // {
    //     return static::withoutGlobalScope(StoreScope::class);
    // }


}
