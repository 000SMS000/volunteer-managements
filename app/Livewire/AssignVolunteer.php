<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\Task;
use App\Models\TaskWorkplace;
use App\Models\Volunteer;
use App\Models\Workplace;
use Livewire\Component;

class AssignVolunteer extends Component
{
    public $volunteerId;
    public $workplaceId;
    public $taskId;
    public $availableTasks = [];
    public $showModal = false;

    public function updatedWorkplaceId($value): void
    {
        $this->taskId = null;
        $this->availableTasks = Task::whereHas('workplaces', function ($query) use ($value) {
            $query->where('workplace_id', $value);
        })->get();
    }

    public function openModal(): void
    {
        if (! $this->volunteerId || ! $this->workplaceId) {
            session()->flash('message', 'يجب اختيار متطوع ومكان عمل أولاً.');
            return;
        }

        $this->availableTasks = Task::whereHas('workplaces', function ($query) {
            $query->where('workplace_id', $this->workplaceId);
        })->get();

        $this->showModal = true;
    }

    public function assignTask(): void
    {
        $this->validate([
            'volunteerId' => 'required|exists:volunteers,id',
            'workplaceId' => 'required|exists:workplaces,id',
            'taskId' => 'required|exists:tasks,id',
        ]);

        $link = TaskWorkplace::where('workplace_id', $this->workplaceId)
            ->where('task_id', $this->taskId)
            ->first();

        if (! $link) {
            session()->flash('message', 'المهمة غير مرتبطة بمكان العمل المحدد.');
            return;
        }

        Assignment::create([
            'volunteer_id' => $this->volunteerId,
            'task_workplace_id' => $link->id,
            'assigned_at' => now(),
        ]);

        $this->reset(['taskId', 'showModal']);
        session()->flash('message', 'تم تنسيب المتطوع بنجاح.');
    }

    public function deleteAssignment($id): void
    {
        Assignment::findOrFail($id)->delete();
        session()->flash('message', 'تم حذف التنسيب.');
    }

    public function render()
    {
        return view('livewire.assign-volunteer', [
            'volunteers' => Volunteer::all(),
            'workplaces' => Workplace::all(),
            'assignments' => Assignment::with(['volunteer', 'taskWorkplace.task', 'taskWorkplace.workplace'])->latest()->get(),
            'availableTasks' => $this->availableTasks,
        ]);
    }
}
