<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatDocumentType extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'description'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
