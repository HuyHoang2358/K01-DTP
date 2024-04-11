<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $item)
 */
class ObjectCategory extends Model
{
    use HasFactory;
    protected $table = 'object_category';
    protected $fillable = ['name', 'description', 'parent_id'];
}
