<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'purchase_detail_id', 'unit', 'quantity', 'unit_value', 'description', 'base_igv', 'percentage_igv', 'igv', 'tax_affected_code', 'total_taxes', 'value_sale', 'unit_price'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function purchaseDetail()
    {
        return $this->belongsTo(PurchaseDetail::class);
    }
}
