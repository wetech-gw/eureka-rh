<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    /**
     * Envoyer un message WhatsApp via Evolution API.
     */
    public function send(string $phone, string $message): Response
    {
        $url = rtrim(
            config('services.evolution.url'),
            '/'
        );

        $instance = config(
            'services.evolution.instance'
        );

        $apiKey = config(
            'services.evolution.key'
        );

        return Http::withHeaders([
            'apikey' => $apiKey,
            'Content-Type' => 'application/json',
        ])
            ->timeout(15)
            ->retry(3, 1000)
            ->post(
                "{$url}/message/sendText/{$instance}",
                [
                    'number' => $this->formatPhone($phone),
                    'text' => $message,
                ]
            )
            ->throw();
    }

    /**
     * Formater le numéro pour WhatsApp.
     */
    private function formatPhone(string $phone): string
    {
        // Supprimer espaces, +, tirets, parenthèses, etc.
        $phone = preg_replace('/\D/', '', $phone);

        // Si le numéro ne commence pas par 245,
        // ajouter l'indicatif de la Guinée-Bissau.
        if (!str_starts_with($phone, '245')) {
            $phone = '245' . $phone;
        }

        return $phone;
    }
}
