<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    protected $fillable = ['name', 'description'];

    public function workplaces(): BelongsToMany
    {
        return $this->belongsToMany(Workplace::class, 'task_workplace');
    }
}
