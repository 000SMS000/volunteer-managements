<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Workplace;
use Livewire\Component;

class ManageTasks extends Component
{
    public $name;
    public $description;
    public $selectedWorkplaces = [];
    public $allWorkplaces;
    public $editingTask = null;
    public $showModal = false;

    public function mount(): void
    {
        $this->allWorkplaces = Workplace::all();
    }

    public function openModal($id = null): void
    {
        $this->allWorkplaces = Workplace::all();

        if ($id) {
            $task = Task::findOrFail($id);
            $this->editingTask = $task;
            $this->name = $task->name;
            $this->description = $task->description;
            $this->selectedWorkplaces = $task->workplaces->pluck('id')->toArray();
        } else {
            $this->reset(['name', 'description', 'editingTask', 'selectedWorkplaces']);
        }

        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'selectedWorkplaces' => 'required|array|min:1',
            'selectedWorkplaces.*' => 'exists:workplaces,id',
        ]);

        $task = Task::updateOrCreate(
            ['id' => $this->editingTask?->id],
            ['name' => $this->name, 'description' => $this->description]
        );

        $task->workplaces()->sync($this->selectedWorkplaces);

        $this->reset(['name', 'description', 'editingTask', 'showModal', 'selectedWorkplaces']);
        session()->flash('message', 'تم حفظ المهمة بنجاح.');
    }

    public function delete($id): void
    {
        Task::destroy($id);
        session()->flash('message', 'تم حذف المهمة.');
    }

    public function render()
    {
        return view('livewire.manage-tasks', [
            'tasks' => Task::with('workplaces')->latest()->get(),
        ]);
    }
}
