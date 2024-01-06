<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @method static \App\Models\Tag create(array $data)
 */
class Tag extends AbstractModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
