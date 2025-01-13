<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'store_id',
        'user_id',
        'ubl_version',
        'sunat_operation_type',
        'sunat_document_type',
        'sunat_payment_method',
        'series',
        'correlative',
        'sunat_currency',
        'mto_oper_gravadas',
        'mto_igv',
        'total_taxes',
        'valor_venta',
        'subtotal',
        'total',
        'issued_at',
        'xml_path',
        'cdr_path',
        'status',
        'hash',
        'created_by',
        'updated_by',
    ];

    // Relaciones
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function operationType()
    {
        return $this->belongsTo(SunatOperationType::class, 'sunat_operation_type', 'code');
    }

    public function documentType()
    {
        return $this->belongsTo(SunatDocumentType::class, 'sunat_document_type', 'code');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(SunatPaymentMethod::class, 'sunat_payment_method', 'code');
    }

    public function currency()
    {
        return $this->belongsTo(SunatCurrency::class, 'sunat_currency', 'code');
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
