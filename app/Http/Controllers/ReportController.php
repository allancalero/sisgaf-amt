<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Exports\ProyectosExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController
{
    /**
     * Export proyectos as CSV or XLSX. Use ?format=xlsx for Excel.
     */
    public function exportProyectos(Request $request)
    {
        $format = $request->query('format', 'csv');

        if ($format === 'xlsx') {
            $filename = 'proyectos-'.now()->format('Ymd_His').'.xlsx';

            return Excel::download(new ProyectosExport(), $filename);
        }

        // Fallback to CSV streaming
        $filename = 'proyectos-'.now()->format('Ymd_His').'.csv';

        $callback = function () {
            // Write UTF-8 BOM for Excel compatibility
            echo "\xEF\xBB\xBF";

            $handle = fopen('php://output', 'w');

            // Header row
            fputcsv($handle, ['ID', 'Nombre', 'Creado en']);

            Proyecto::orderBy('id')->chunk(200, function ($items) use ($handle) {
                foreach ($items as $item) {
                    fputcsv($handle, [
                        $item->id,
                        $item->nombre,
                        $item->created_at ? $item->created_at->toDateTimeString() : '',
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
