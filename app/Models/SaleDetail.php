<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Scopes\StoreScope;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'purchase_detail_id', 'cantidad', 'mto_valor_unit', 'mto_base_igv', 'porcentaje_igv', 'igv', 'tip_afe_igv', 'total_impuestos', 'mto_valor_venta', 'mto_precio_unit', 'discount', 'store_id',];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function purchaseDetail()
    {
        return $this->belongsTo(PurchaseDetail::class);
    }


    public function store()
    {
        return $this->belongsTo(Store::class);
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
