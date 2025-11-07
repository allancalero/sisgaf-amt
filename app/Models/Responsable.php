<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class Responsable extends Model
{
    /** @use HasFactory<\Database\Factories\ResponsableFactory> */
    use HasFactory;
    protected $table = 'responsables';
    protected $fillable = ['Nombres', 'Apellidos', 'Correo', 'Estado', 'area_id'];

    /**
     * Belongs to Area
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
