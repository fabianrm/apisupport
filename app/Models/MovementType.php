<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
}
