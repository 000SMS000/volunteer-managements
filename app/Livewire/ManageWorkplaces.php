<?php

namespace App\Livewire;

use App\Models\Workplace;
use Livewire\Component;

class ManageWorkplaces extends Component
{
    public $name;
    public $location;
    public $editingWorkplace = null;
    public $showModal = false;

    public function openModal($id = null): void
    {
        if ($id) {
            $workplace = Workplace::findOrFail($id);
            $this->editingWorkplace = $workplace;
            $this->name = $workplace->name;
            $this->location = $workplace->location;
        } else {
            $this->reset(['name', 'location', 'editingWorkplace']);
        }

        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        Workplace::updateOrCreate(
            ['id' => $this->editingWorkplace?->id],
            ['name' => $this->name, 'location' => $this->location]
        );

        $this->reset(['name', 'location', 'editingWorkplace', 'showModal']);
        session()->flash('message', 'تم حفظ مكان العمل بنجاح.');
    }

    public function delete($id): void
    {
        Workplace::destroy($id);
        session()->flash('message', 'تم حذف مكان العمل.');
    }

    public function render()
    {
        return view('livewire.manage-workplaces', [
            'workplaces' => Workplace::latest()->get(),
        ]);
    }
}
