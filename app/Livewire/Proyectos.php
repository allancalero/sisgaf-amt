<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    //campos del formulario

    public $nombre;

    protected $rules = [
        'nombre' => 'required|string|max:255',
    ];  

    //resetear los campos del formulario
    public function resetForm()
    {
        $this->nombre = '';
    }

    //guardar un nuevo proyecto
    public function save()
    {
        $this->validate();  
        Proyecto::create([
            'nombre' => $this->nombre,
        ]);

        $this->resetForm();
        session()->flash('message', 'Proyecto creado exitosamente.');   
    }
    
    public function render()
    {
        $proyectos = Proyecto::latest()->paginate(10);

        return view('livewire.proyectos', compact('proyectos'));
    }
}
