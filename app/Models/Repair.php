<?php

namespace App\Models;

use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'device_id',
        'technician_id',
        'store_id',
        'priority',
        'status',
        'total_cost',
        'assigned_at',
        'resolved_at',
        'closed_at',
        'delivery_date'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function history()
    {
        return $this->hasMany(RepairHistory::class);

    }

    public function file()
    {
        return $this->hasMany(RepairFile::class);
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
