<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $item)
 * @method static find(mixed $position_type_id)
 */
class PositionType extends Model
{
    use HasFactory;
    protected $table = 'position_type';
    protected $fillable = ['name', 'icon_path', 'cesium_icon', 'color'];
    protected $hidden = ['created_at', 'updated_at'];
}
