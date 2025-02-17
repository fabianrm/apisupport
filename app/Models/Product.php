<?php

namespace App\Models;

use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['code','name', 'description', 'type', 'category_id', 'brand_id', 'sunat_unit', 'current_stock', 'min_stock', 'image', 'store_id', 'status',];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function sunatUnit()
    {
        return $this->belongsTo(SunatUnit::class, "sunat_unit","code");
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
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
