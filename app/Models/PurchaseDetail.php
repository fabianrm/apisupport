<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_id', 'product_id', 'store_id', 'purchase_price', 'sale_price', 'quantity', 'remaining_quantity','model', 'serial', 'imei','color', 'capacity', 'ubication_detail'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function repairProducts()
    {
        return $this->hasMany(RepairProduct::class);
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

}
