<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Responsable;
use App\Models\Area;

class Responsables extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'confirmToggle' => 'toggleStatus',
    ];

    public $Nombres;
    public $Apellidos;
    public $Correo;
    public $area_id;
    public $Estado = 'Activo';
    public $showCreate = false;
    public $editingId = null;

    protected $rules = [
        'Nombres' => 'required|string|max:50',
        'Apellidos' => 'required|string|max:50',
        'Correo' => 'required|email|max:100',
        'Estado' => 'required|in:Activo,Inactivo',
        'area_id' => 'nullable|exists:areas,id',
    ];

    public function resetForm()
    {
        $this->Nombres = '';
        $this->Apellidos = '';
        $this->Correo = '';
        $this->Estado = 'Activo';
        $this->area_id = null;
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
            $responsable = Responsable::find($this->editingId);
            if ($responsable) {
                $responsable->update([
                    'Nombres' => $this->Nombres,
                    'Apellidos' => $this->Apellidos,
                    'Correo' => $this->Correo,
                    'Estado' => $this->Estado,
                    'area_id' => $this->area_id,
                ]);

                session()->flash('message', 'Responsable actualizado exitosamente.');
                $this->dispatch('notify', ['message' => 'Responsable actualizado exitosamente.']);
                // notify dashboard to refresh counts (browser event -> will trigger Livewire emit in client)
                $this->dispatch('dashboard-refresh');
            }
        } else {
            Responsable::create([
                'Nombres' => $this->Nombres,
                'Apellidos' => $this->Apellidos,
                'Correo' => $this->Correo,
                'Estado' => $this->Estado,
                'area_id' => $this->area_id,
            ]);

            session()->flash('message', 'Responsable creado exitosamente.');
            $this->dispatch('notify', ['message' => 'Responsable creado exitosamente.']);
            // notify dashboard to refresh counts (browser event -> will trigger Livewire emit in client)
            $this->dispatch('dashboard-refresh');
        }

        $this->resetForm();
        $this->showCreate = false;
        $this->editingId = null;
    }

    public function edit($id)
    {
        $responsable = Responsable::find($id);
        if (! $responsable) return;

        $this->editingId = $responsable->id;
        $this->Nombres = $responsable->Nombres;
        $this->Apellidos = $responsable->Apellidos;
        $this->Correo = $responsable->Correo;
        $this->Estado = $responsable->Estado;
        $this->area_id = $responsable->area_id;
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
        $responsable = Responsable::find($id);
        if (! $responsable) return;

        $responsable->Estado = $responsable->Estado === 'Activo' ? 'Inactivo' : 'Activo';
        $responsable->save();

        $this->dispatch('notify', ['message' => 'Estado actualizado.']);
    // notify dashboard to refresh counts (browser event -> will trigger Livewire emit in client)
    $this->dispatch('dashboard-refresh');
    }

    public function render()
    {
        $responsables = Responsable::latest()->paginate(10);
        $areas = Area::orderBy('Nombre')->get();
        return view('livewire.responsables', compact('responsables','areas'));
    }
}
