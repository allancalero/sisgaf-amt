<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Area;

class Areas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $Nombre;
    public $Estado = 'Activo';
    public $showCreate = false;
    public $editingId = null;

    protected $rules = [
        'Nombre' => 'required|string|max:100',
        'Estado' => 'required|in:Activo,Inactivo',
    ];

    public function resetForm()
    {
        $this->Nombre = '';
        $this->Estado = 'Activo';
    }

    public function toggleCreate()
    {
        $this->showCreate = ! $this->showCreate;
        if (! $this->showCreate) {
            $this->cancelEdit();
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $area = Area::find($this->editingId);
            if ($area) {
                $area->update([
                    'Nombre' => $this->Nombre,
                    'Estado' => $this->Estado,
                ]);

                session()->flash('message', 'Área actualizada exitosamente.');
                $this->dispatch('notify', ['message' => 'Área actualizada exitosamente.']);
                $this->dispatch('dashboard-refresh');
            }
        } else {
            Area::create([
                'Nombre' => $this->Nombre,
                'Estado' => $this->Estado,
            ]);

            session()->flash('message', 'Área creada exitosamente.');
            $this->dispatch('notify', ['message' => 'Área creada exitosamente.']);
            $this->dispatch('dashboard-refresh');
        }

        $this->resetForm();
        $this->showCreate = false;
        $this->editingId = null;
    }

    public function edit($id)
    {
        $area = Area::find($id);
        if (! $area) return;

        $this->editingId = $area->id;
        $this->Nombre = $area->Nombre;
        $this->Estado = $area->Estado;
        $this->showCreate = true;
    }

    public function cancelEdit()
    {
        $this->editingId = null;
        $this->resetForm();
        $this->showCreate = false;
    }

    public function toggleStatus($id)
    {
        $area = Area::find($id);
        if (! $area) return;

        $area->Estado = $area->Estado === 'Activo' ? 'Inactivo' : 'Activo';
        $area->save();

        $this->dispatch('notify', ['message' => 'Estado actualizado.']);
        $this->dispatch('dashboard-refresh');
    }

    public function render()
    {
        $areas = Area::latest()->paginate(10);

        return view('livewire.areas', compact('areas'));
    }
}
