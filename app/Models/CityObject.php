<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 */
class CityObject extends Model
{
    use HasFactory;
    protected $table = 'city_object';
    protected $fillable = [
        'description',
        'name',
        'city_id',
        'city_model_id',
        'address_id',
        'position_id',
        'start_date',
        'end_date',
        'is_show_name',
        'name_height',
    ];
}
