<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerCategory extends Model
{
    use HasFactory;

    /**
     * A DB table name.
     *
     * @var string
     */
    protected $table = 'post_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * Primary Key
     *
     * @var integer
     */
    protected $primaryKey = 'post_id';

    /**
     * Indicates if the IDs are auto-incrementing
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'post_id',
        'category_id',
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

    /**
     * The Brand HasMany Category.
     *
     * @return HasMany
     */
    public function category() : HasMany
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
}
