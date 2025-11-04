<?php

namespace App\Exports;

use App\Models\Proyecto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProyectosExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Proyecto::select(['id', 'nombre', 'created_at'])->orderBy('id')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Creado en'];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->nombre,
            $row->created_at ? $row->created_at->toDateTimeString() : '',
        ];
    }
}
