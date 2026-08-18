<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Envia SMS via Africa's Talking API.
     */
    public static function enviar(string $numero, string $mensagem): bool
    {
        $apiKey    = config('services.africastalking.api_key');
        $username  = config('services.africastalking.username');
        $senderId  = config('services.africastalking.sender_id');
        $url       = config('services.africastalking.url', 'https://api.africastalking.com/version1/messaging');

        if (!$apiKey || !$username) {
            Log::warning('SMS não enviado — credenciais Africa\'s Talking não configuradas.');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'apikey'        => $apiKey,
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ])->asForm()->post($url, [
                'username'  => $username,
                'to'        => $numero,
                'message'   => $mensagem,
                'from'      => $senderId,
            ]);

            if ($response->successful()) {
                return true;
            }

            Log::error('SMS falhou:', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return false;
        } catch (\Exception $e) {
            Log::error('SMS exception:', ['message' => $e->getMessage()]);
            return false;
        }
    }
}
