<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::insert([
            ['Nombre' => 'Finanzas', 'Estado' => 'Activo', 'created_at' => now(), 'updated_at' => now()],
            ['Nombre' => 'Recursos Humanos', 'Estado' => 'Activo', 'created_at' => now(), 'updated_at' => now()],
            ['Nombre' => 'Operaciones', 'Estado' => 'Inactivo', 'created_at' => now(), 'updated_at' => now()],
        ]);

        if ($this->command) {
            $this->command->info('AreaSeeder: inserted 3 areas');
        }
    }
}
