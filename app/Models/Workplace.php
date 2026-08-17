<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Workplace extends Model
{
    protected $fillable = ['name', 'location'];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_workplace');
    }

    public function assignments(): HasManyThrough
    {
        return $this->hasManyThrough(Assignment::class, TaskWorkplace::class);
    }
}
