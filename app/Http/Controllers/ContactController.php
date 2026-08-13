<?php

namespace App\Http\Controllers;

use App\Mail\NovaMensagemContacto;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'      => 'required|string|max:255',
            'empresa'   => 'nullable|string|max:255',
            'email'     => 'required|email|max:255',
            'telefone'  => 'nullable|string|max:50',
            'assunto'   => 'nullable|string|max:255',
            'servico'   => 'nullable|string|max:255',
            'mensagem'  => 'required|string|max:5000',
        ]);

        $mensagem = ContactMessage::create($validated);

        $destinatario = ContactInfo::first()->email ?? config('mail.from.address');

        try {
            Mail::to($destinatario)->send(new NovaMensagemContacto($validated));
        } catch (\Throwable $e) {
            // A mensagem já ficou guardada na base de dados;
            // o email é apenas uma notificação adicional.
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Mensagem enviada com sucesso! Entraremos em contacto brevemente.',
            ]);
        }

        return redirect()->route('site.inicio')
            ->with('success', 'Mensagem enviada com sucesso! Entraremos em contacto brevemente.');
    }
}
