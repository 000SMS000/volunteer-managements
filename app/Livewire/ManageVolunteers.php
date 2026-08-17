<?php

namespace App\Livewire;

use App\Models\Volunteer;
use Livewire\Component;

class ManageVolunteers extends Component
{
    public $name;
    public $volunteer_num;
    public $email;
    public $editingVolunteer = null;
    public $showModal = false;

    public function openModal($id = null): void
    {
        if ($id) {
            $volunteer = Volunteer::findOrFail($id);
            $this->editingVolunteer = $volunteer;
            $this->volunteer_num = $volunteer->volunteer_num;
            $this->name = $volunteer->name;
            $this->email = $volunteer->email;
        } else {
            $this->reset(['name', 'volunteer_num', 'email', 'editingVolunteer']);
        }

        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'volunteer_num' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Volunteer::updateOrCreate(
            ['id' => $this->editingVolunteer?->id],
            [
                'name' => $this->name,
                'volunteer_num' => $this->volunteer_num,
                'email' => $this->email,
            ]
        );

        $this->reset(['name', 'volunteer_num', 'email', 'editingVolunteer', 'showModal']);
        session()->flash('message', 'تم حفظ بيانات المتطوع بنجاح.');
    }

    public function delete($id): void
    {
        Volunteer::destroy($id);
        session()->flash('message', 'تم حذف المتطوع.');
    }

    public function render()
    {
        return view('livewire.manage-volunteers', [
            'volunteers' => Volunteer::latest()->get(),
        ]);
    }
}
