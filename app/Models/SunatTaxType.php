<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatTaxType extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['code', 'description', 'status'];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sunat_tax_type', 'code');
    }

}
