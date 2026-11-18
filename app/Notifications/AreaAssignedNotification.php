<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Area;

class AreaAssignedNotification extends Notification
{
    use Queueable;

    protected $areaName;

    public function __construct($areaName)
    {
        $this->areaName = $areaName;
    }

    public function via($notifiable): array
    {
        return ['database']; // Guardar directamente en la base de datos
    }

    public function toArray($notifiable): array
    {
        return [
            'mensaje' => 'Se te ha asignado formalmente acceso a la dirección: ' . $this->areaName,
            'icono' => '🏢',
            'fecha' => now()->format('d/m/Y h:i A')
        ];
    }
}