<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //* Modificar el asunto del correo de verificacion
        VerifyEmail::toMailUsing(function($notifiable, $url) {
            return (new MailMessage)
                ->subject("Verificar Cuenta") //* Titulo
                ->line("Tu Cuenta ya esta casi lista, solo debes presionar el enlace a continuación") //* Linea de Texto
                ->action("Confirmar Cuenta", $url) //* Boton de accion
                ->line("Si no creaste esta cuenta, puedes ignorar este mensaje");
        });
    }
}
