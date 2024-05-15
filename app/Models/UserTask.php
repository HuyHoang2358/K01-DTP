<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $task_id)
 */
class UserTask extends Model
{
    use HasFactory;
    protected $table = 'user_task';
    protected $fillable = ['user_id', 'task_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
