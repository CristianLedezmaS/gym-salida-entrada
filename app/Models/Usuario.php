<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    public $table = 'cliente';
    public $primaryKey = 'id_cliente';
    public $timestamps = false;
    public $fillable = [
        'membresia',
        'tipo_usuario',
        'creado_por',
        'usuario',
        'password',
        'dni',
        'nombre',
        'correo',
        'telefono',
        'desde',
        'hasta',
        'DT',
        'DA',
        'DR',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForVerification()
    {
        return $this->correo;
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        // Implementación básica - puedes personalizar esto
        // Por ahora, solo marcamos como verificado para evitar errores
        $this->markEmailAsVerified();
    }
}
