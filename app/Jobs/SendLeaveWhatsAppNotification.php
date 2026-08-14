<?php

namespace App\Jobs;

use App\Models\Feria;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendLeaveWhatsAppNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
     public function __construct(
             public int $feriaId
         ) {}

         public function handle(
             WhatsAppService $whatsapp
         ): void {

             // Récupérer la demande + son fonctionnaire
             $feria = Feria::with('funcionario')
                 ->findOrFail($this->feriaId);

             $funcionario = $feria->funcionario;

             // Vérifier l'existence du fonctionnaire
             if (!$funcionario) {
                 return;
             }

             // Vérifier son numéro WhatsApp
             if (empty($funcionario->contacto)) {
                 return;
             }

             // Construire le message
             $message = view('whatsapp.feria-approved', [
                 'funcionario' => $funcionario,
                 'feria' => $feria,
             ])->render();

             // Envoyer le WhatsApp
             $whatsapp->send(
                 $funcionario->telefone,
                 $message
             );
         }
}
