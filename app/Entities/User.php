<?php

namespace App\Entities;

use App\Entities\Catalog\Order;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public const ROLE_USER = 'user';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function roles()
    {
        return [self::ROLE_USER, self::ROLE_MANAGER, self::ROLE_ADMIN];
    }

    public function changeRole($role)
    {
        if (! in_array($role, self::roles())) {
            throw new \InvalidArgumentException('Неизвестная роль "' . $role . '".');
        }

        if ($this->role === $role) {
            throw new \DomainException('Роль уже назначена пользователю.');
        }

        $this->update(['role' => $role]);
    }
}
