<?php

namespace App\Models;

use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'document_id', 'document_number', 'email', 'phone', 'address', 'store_id', 'status'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function documentId()
    {
        return $this->belongsTo(SunatDocumentId::class, 'document_id', 'code');
    }


    /**
     * Capturar usuario
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    /**
     * Scopes para filtro por tienda de usuario
     */
    // protected static function booted()
    // {
    //     static::addGlobalScope(new StoreScope);
    // }

     // Si necesitas consultas sin el filtro global
    // public static function withoutStoreScope()
    // {
    //     return static::withoutGlobalScope(StoreScope::class);
    // }

}
