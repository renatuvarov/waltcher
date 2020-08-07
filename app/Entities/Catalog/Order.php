<?php

namespace App\Entities\Catalog;

use App\Entities\User;
use Carbon\Carbon;
use DomainException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Entities\Catalog
 *
 * @property integer $id
 * @property integer $machine_id
 * @property string $customer_name
 * @property string $customer_company
 * @property string $customer_phone
 * @property string $customer_email
 * @property Carbon $created_at
 */
class Order extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return $this->created_at->diffInMinutes(Carbon::now()) > config('site.user.order.interval');
    }

    public function makeViewed(): void
    {
        if ($this->viewed) {
            throw new DomainException('Заказ уже просмотрен.');
        }

        $this->viewed = true;
        $this->save();
    }
}
