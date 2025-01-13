<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatUnit extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['code', 'description', 'status'];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sunat_unit', 'code');
    }

    /**
     * Relación con el modelo Product.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'sunat_unit', 'code');
    }
}
