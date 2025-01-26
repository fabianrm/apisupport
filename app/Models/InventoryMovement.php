<?php

namespace App\Models;

use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InventoryMovement extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_detail_id', 'store_id', 'movement_type_id', 'quantity', 'unit_price', 'description'];

    public function purchaseDetail()
    {
        return $this->belongsTo(PurchaseDetail::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function movementType()
    {
        return $this->belongsTo(MovementType::class);
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
    protected static function booted()
    {
        static::addGlobalScope(new StoreScope);
    }

    // Si necesitas consultas sin el filtro global
    public static function withoutStoreScope()
    {
        return static::withoutGlobalScope(StoreScope::class);
    }


}
