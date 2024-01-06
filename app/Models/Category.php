<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @method static \App\Models\Category create(array $data)
 */
class Category extends AbstractModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
