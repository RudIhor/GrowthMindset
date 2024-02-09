<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Author
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereLastName($value)
 * @mixin \Eloquent
 */
class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    /**
     * Get Author's full name
     *
     * @return Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . ' ' . $this->last_name,
        );
    }
}
