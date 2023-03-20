<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InUse extends Model
{
    use HasFactory;

    /**
     * A DB table name.
     *
     * @var string
     */
    protected $table = 'in_uses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'car_id',
        'date_start',
        'date_end',
    ];

    /**
     * The Brand HasMany Category.
     *
     * @return HasMany
     */
    public function category() : HasMany
    {
        return $this->hasMany(Customer::class, 'customer_id', 'id');
    }

    /**
     * The Brand HasMany Category.
     *
     * @return HasMany
     */
    public function driver() : HasMany
    {
        return $this->hasMany(Car::class, 'car_id', 'id');
    }
}
