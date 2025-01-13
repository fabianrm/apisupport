<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairProduct extends Model
{
    use HasFactory;

    protected $fillable = ['repair_id', 'purchase_detail_id', 'quantity', 'price', 'subtotal'];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }

    public function purchaseDetail()
    {
        return $this->belongsTo(PurchaseDetail::class);
    }

}
