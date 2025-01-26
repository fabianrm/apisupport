<?php

namespace App\Models;

use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RepairHistory extends Model
{
    use HasFactory;
    protected $fillable = ['repair_id', 'status', 'changed_by','comment', 'store_id'];

    public function repairs()
    {
        return $this->hasMany(Repair::class);
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
