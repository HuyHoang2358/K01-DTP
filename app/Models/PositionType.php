<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $item)
 */
class PositionType extends Model
{
    use HasFactory;
    protected $table = 'position_type';
    protected $fillable = ['name', 'icon_path'];
}
