<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        
        //* Recibir las notificaciones sin leer (cada reclutador tiene sus propias notificaciones)
        $notificaciones = auth()->user()->unreadNotifications;

        //* Limpiar notificaciones (marcar como leido)
        auth()->user()->unreadNotifications->markAsRead();

        return view("notificaciones.index", [
            "notificaciones" => $notificaciones
        ]);

    }
}
