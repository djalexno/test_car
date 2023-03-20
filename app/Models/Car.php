<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    /**
     * A DB table name.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'category_id',
        'driver_id',
    ];

    /**
     * The Brand HasMany Category.
     *
     * @return HasMany
     */
    public function category() : HasMany
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    /**
     * The Brand HasMany Car.
     *
     * @return HasMany
     */
    public function in_use() : HasMany
    {
        return $this->hasMany(InUse::class, 'car_id', 'id');
    }

    /**
     * The Brand HasMany Category.
     *
     * @return HasMany
     */
    public function driver() : HasMany
    {
        return $this->hasMany(Driver::class, 'driver_id', 'id');
    }
}
