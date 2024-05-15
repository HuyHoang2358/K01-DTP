<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $task)
 * @method static where(string $string, string $string1, string $string2)
 * @method static find(mixed $task_id)
 */
class Task extends Model
{
    use HasFactory;
    protected $table = 'task';
    protected $fillable = ['name', 'description', 'type', 'start_date', 'end_date', 'status'];
    protected $hidden = ['created_at', 'updated_at'];


    public function route(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Route::class, 'task_id',"id")->with(['start_position','end_position','points']);
    }

    public function targetReconnaissances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TargetReconnaissance::class, 'task_id', 'id')
            ->with(['locationCategory', 'position', 'user']);

    }
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_task', 'task_id', 'user_id');
    }
}
