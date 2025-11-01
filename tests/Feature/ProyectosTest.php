<?php

use App\Models\Proyecto;

it('creates a proyecto when save is called on the component', function () {
    // Arrange: ensure DB is empty
    Proyecto::query()->delete();

    // Act: call the component method directly
    $component = new \App\Livewire\Proyectos();
    $component->nombre = 'Prueba Automatica';
    $component->save();

    // Assert: the proyecto exists in the database
    $this->assertDatabaseHas('proyectos', [
        'nombre' => 'Prueba Automatica',
    ]);
});
