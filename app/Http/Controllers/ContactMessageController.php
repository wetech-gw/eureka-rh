<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class ContactMessageController extends Controller
{
    use LogsActivity;
    public function index()
    {
        $mensagens = ContactMessage::orderByDesc('created_at')->get();

        $naoLidas = $mensagens->whereNull('read_at')->count();

        return view('contact-messages.index', compact('mensagens', 'naoLidas'));
    }

    public function marcarLida(ContactMessage $mensagem)
    {
        if (is_null($mensagem->read_at)) {
            $mensagem->update(['read_at' => now()]);
        }

        return redirect()->route('contact-messages.index')
            ->with('success', 'Mensagem marcada como lida.');
    }

    public function destroy(ContactMessage $mensagem)
    {
        $this->logActivity('delete', 'Mensagem de Contacto', $mensagem->id, 'Eliminou mensagem de ' . ($mensagem->name ?? 'desconhecido'));
        $mensagem->delete();

        return redirect()->route('contact-messages.index')
            ->with('success', 'Mensagem eliminada.');
    }
}
