<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'route',
        'parent_id',
        'order',
        'status'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    // Relación para los permisos hijos
    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id')->orderBy('order');
    }

    // Relación para el permiso padre
    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }

}
