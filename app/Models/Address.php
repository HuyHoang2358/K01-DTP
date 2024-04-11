<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validate)
 * @method static find($id)
 */
class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $fillable = ['name'];
}
