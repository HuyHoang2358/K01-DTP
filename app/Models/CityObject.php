<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static where(string $string, string $string1, $city_id)
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
    protected $hidden = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
        'position_id',
        'address_id',
        'city_model_id',
    ];
    public function address(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Address::class, 'id', 'address_id')->select('id', 'name');
    }
    public function position(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
    public function cityModel(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CityModel::class, 'id', 'city_model_id');
    }
}
