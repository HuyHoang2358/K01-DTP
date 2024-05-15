<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $item)
 * @method static find($id)
 */
class ObjectCategory extends Model
{
    use HasFactory;
    protected $table = 'object_category';
    protected $fillable = ['name', 'slug', 'description', 'parent_id'];
    protected $hidden = ['parent_id', 'created_at', 'updated_at'];
}
