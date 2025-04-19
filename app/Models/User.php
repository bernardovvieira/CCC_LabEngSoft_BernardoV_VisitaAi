<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table        = 'users';
    protected $primaryKey   = 'use_id';
    public    $incrementing = true;
    public    $timestamps   = false;      // usamos datas custom

    /**
     * Atributos em massa.
     */
    protected $fillable = [
        'use_cpf',
        'use_email',
        'use_senha',
        'use_perfil',
        'use_data_criacao',
        'use_data_anonimizacao',
        'fk_gestor_id',
        'use_aprovado',          // <- novo campo
    ];

    /**
     * Casts de tipo.
     */
    protected $casts = [
        'use_aprovado' => 'boolean',
        'use_data_criacao'     => 'date',
        'use_data_anonimizacao'=> 'date',
    ];

    /**
     * Coluna que contém o hash da senha.
     */
    public function getAuthPassword()
    {
        return $this->use_senha;
    }

    /**
     * Para o Password Broker usar `use_email`.
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->use_email;
    }

    /**
     * Define o e‑mail de destino para todas as notificações.
     */
    public function routeNotificationForMail($notification)
    {
        return $this->use_email;
    }

    /**
     * Envia notificação de verificação de e‑mail.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }

    /* -----------------------------------------------------------------
     |  RELACIONAMENTOS
     |-----------------------------------------------------------------*/

    public function gestor()
    {
        return $this->belongsTo(self::class, 'fk_gestor_id', 'use_id');
    }

    public function agentes()
    {
        return $this->hasMany(self::class, 'fk_gestor_id', 'use_id');
    }

    /* -----------------------------------------------------------------
     |  HELPERS
     |-----------------------------------------------------------------*/

    public function isAgente(): bool
    {
        return $this->use_perfil === 'agente';
    }

    public function isGestor(): bool
    {
        return $this->use_perfil === 'gestor';
    }

    public function isAprovado(): bool
    {
        return (bool) $this->use_aprovado;
    }
}
