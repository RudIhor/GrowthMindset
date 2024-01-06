<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Roles
 *
 * @property int $id
 * @property string $name
 */
class Role extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
