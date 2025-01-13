<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ruc', 'location', 'ubigeo', 'department', 'province', 'district', 'urbanization', 'address', 'sunat_local_code', 'phone', 'user_id', 'status'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
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
