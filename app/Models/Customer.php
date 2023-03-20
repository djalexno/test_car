<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * A DB table name.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'post_id',
    ];

    /**
     * The Brand HasMany Post.
     *
     * @return HasMany
     */
    public function post() : HasMany
    {
        return $this->hasMany(Post::class, 'post_id', 'id');
    }

    public function in_use() : HasMany
    {
        return $this->hasMany(InUse::class, 'customer_id', 'id');
    }

}
