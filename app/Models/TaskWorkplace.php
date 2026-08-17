<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskWorkplace extends Model
{
    protected $table = 'task_workplace';
    protected $primaryKey = 'id';

    protected $fillable = ['task_id', 'workplace_id'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function workplace(): BelongsTo
    {
        return $this->belongsTo(Workplace::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }
}
