<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;
use App\Models\Responsable;

class DashboardStats extends Component
{
    protected $listeners = [
        'dashboardRefresh' => 'refreshCounts',
    ];
    public $proyectosCount = 0;
    public $responsablesCount = 0;
    public $responsablesActive = 0;
    public $responsablesInactive = 0;

    public function mount()
    {
        $this->proyectosCount = Proyecto::count();
        $this->responsablesCount = Responsable::count();
        $this->responsablesActive = Responsable::where('Estado', 'Activo')->count();
        $this->responsablesInactive = Responsable::where('Estado', 'Inactivo')->count();
        // dispatch initial browser event so JS chart can initialize with server values
        $this->dispatch('dashboard-updated', [
            'proyectos' => $this->proyectosCount,
            'responsables' => $this->responsablesCount,
            'responsables_active' => $this->responsablesActive,
            'responsables_inactive' => $this->responsablesInactive,
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard-stats', [
            'proyectos' => $this->proyectosCount,
            'responsables' => $this->responsablesCount,
            'responsables_active' => $this->responsablesActive,
            'responsables_inactive' => $this->responsablesInactive,
        ]);
    }

    public function refreshCounts()
    {
        $this->proyectosCount = Proyecto::count();
        $this->responsablesCount = Responsable::count();

        $this->responsablesActive = Responsable::where('Estado', 'Activo')->count();
        $this->responsablesInactive = Responsable::where('Estado', 'Inactivo')->count();

        // notify browser so JS can update chart without relying on inline script re-execution
        $this->dispatch('dashboard-updated', [
            'proyectos' => $this->proyectosCount,
            'responsables' => $this->responsablesCount,
            'responsables_active' => $this->responsablesActive,
            'responsables_inactive' => $this->responsablesInactive,
        ]);
    }
}
