<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dni',
        'name',
        'email',
        'password',
        'address',
        'phone',
        'status'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withPivot('store_id')->withTimestamps();;
    }

    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, Role::class, 'id', 'role_id');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'role_user', 'user_id', 'store_id');
    }

    public function roleUser()
    {
        return $this->hasOne(RoleUser::class);
    }


    // Relación inversa para los dispositivos creados por el usuario
    public function createdDevices()
    {
        return $this->hasMany(Device::class, 'created_by');
    }

    // Relación inversa para los dispositivos actualizados por el usuario
    public function updatedDevices()
    {
        return $this->hasMany(Device::class, 'updated_by');
    }

}
