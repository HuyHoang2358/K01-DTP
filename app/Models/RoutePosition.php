<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class RoutePosition extends Model
{
    use HasFactory;
    protected $table = 'route_position';
    protected $fillable = ['route_id', 'position_id', 'index'];
    protected $hidden = ['route_id', 'position_id'];
}
