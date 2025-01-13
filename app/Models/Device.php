<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'device_type_id', 'model', 'serial_number', 'imei', 'lock_code', 'problem_description', 'status'];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class);
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
