<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{   
    use HasFactory, Notifiable;
    public $table = 'cliente';
    public $primaryKey = 'id_cliente';
    public $timestamps = true; // Habilitar timestamps
    public $fillable = [
        'id_membresia',
        'tipo_usuario',
        'creado_por',
        'usuario',
        'password',
        'dni',
        'nombre',
        'correo',
        'telefono',
        'direccion',
        'desde',
        'hasta',
        'DT',
        'DA',
        'DR',
        'foto',
        'pago',
        'debe',
        'codigo',
        'nfc_id'
    ];
    public function rutinas()
    {
        return $this->belongsToMany(Rutina::class, 'cliente_rutina', 'cliente_id', 'rutina_id');
    }
}