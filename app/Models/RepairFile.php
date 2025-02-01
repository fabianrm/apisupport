<?php

namespace App\Models;

use App\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RepairFile extends Model
{
    use HasFactory;
    protected $fillable = ['repair_id', 'file_path', 'store_id'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }

    // Relación con el modelo User para el usuario que creó el dispositivo
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relación con el modelo User para el usuario que actualizó el dispositivo
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
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
