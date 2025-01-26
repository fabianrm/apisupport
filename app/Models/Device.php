<?php

namespace App\Models;

use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'device_type_id', 'model', 'serial_number', 'imei', 'lock_code', 'problem_description', 'store_id', 'status'];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class);
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
