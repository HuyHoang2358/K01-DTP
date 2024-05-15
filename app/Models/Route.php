<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Route extends Model
{
    use HasFactory;
    protected $table = 'route';
    protected $fillable = ['name', 'description', 'start_position_id', 'end_position_id', 'start_address', 'end_address', "status", "task_id"];
    protected $hidden = ['created_at', 'updated_at','task_id', 'start_position_id', 'end_position_id'];

    public function start_position(){
        return $this->hasOne(Position::class, 'id', 'start_position_id');
    }
    public function end_position(){
        return $this->hasOne(Position::class, 'id', 'end_position_id');
    }
    public function points(){
        $points = $this->belongsToMany(Position::class, 'route_position', 'route_id', 'position_id')
            ->orderBy('route_position.index')->select('position.*', 'route_position.index');
        return $points;
    }
}
