<?php

namespace App\Models;

use App\Scopes\StoreScope;
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
        'tipo_operacion',
        'tipo_documento',
        'forma_pago',
        'serie',
        'correlativo',
        'tipo_moneda',
        'mto_oper_gravadas',
        'mto_igv',
        'total_impuestos',
        'valor_venta',
        'subtotal',
        'mto_imp_venta',
        'fecha_emision',
        'xml_path',
        'cdr_path',
        'code_legend',
        'value_legend',
        'status',
        'active',

    ];

    // Relaciones

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }

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
        return $this->belongsTo(SunatOperationType::class, 'tipo_operacion', 'code');
    }

    public function documentType()
    {
        return $this->belongsTo(SunatDocumentType::class, 'tipo_documento', 'code');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(SunatPaymentMethod::class, 'forma_pago', 'code');
    }

    public function currency()
    {
        return $this->belongsTo(SunatCurrency::class, 'tipo_moneda', 'code');
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
