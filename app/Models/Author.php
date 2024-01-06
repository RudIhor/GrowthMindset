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
 * @property string|null $full_name
 * @method static \App\Models\Author create(array $data)
 */
class Author extends AbstractModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . ' ' . $this->last_name,
        );
    }
}
