<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    public $table = 'rutina';
    public $primaryKey = 'id_rutina';
    public $timestamps = false; // Si usas timestamps

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_rutina', 'rutina_id', 'cliente_id');
    }
}
