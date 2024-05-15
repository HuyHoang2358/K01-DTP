<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class CityModel extends Model
{
    use HasFactory;
    protected $table = 'city_model';
    protected $fillable = [
        'name',
        'model_code',
        'texture_model_url',
        'no_texture_model_url',
        'object_category_id',
        'scale',
        'pitch',
        'heading',
        'roll',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
