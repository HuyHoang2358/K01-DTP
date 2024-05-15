<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Position extends Model
{
    use HasFactory;
    protected $table = 'position';
    protected $fillable = ['latitude', 'longitude', 'height'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
