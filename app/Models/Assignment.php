<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    protected $fillable = ['volunteer_id', 'task_workplace_id', 'assigned_at', 'notes'];

    protected $casts = [
        'assigned_at' => 'date',
    ];

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function taskWorkplace(): BelongsTo
    {
        return $this->belongsTo(TaskWorkplace::class);
    }
}
