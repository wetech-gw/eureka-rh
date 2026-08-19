<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class ContactInfoController extends Controller
{
    use LogsActivity;
    public function index()
    {
        $contact = ContactInfo::first();

        return view('admin.contactos.index', compact('contact'));
    }

    public function create()
    {
        return view('admin.contactos.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        ContactInfo::create($validated);
        $this->logActivity('create', 'Contactos do Site', null, 'Criou contactos do site');

        return redirect()->route('admin.contactos.index')->with('success', 'Contactos criados com sucesso!');
    }

    public function edit(ContactInfo $contacto)
    {
        return view('admin.contactos.edit', compact('contacto'));
    }

    public function update(Request $request, ContactInfo $contacto)
    {
        $validated = $this->validateData($request);

        $contacto->update($validated);
        $this->logActivity('update', 'Contactos do Site', $contacto->id, 'Atualizou contactos do site');

        return redirect()->route('admin.contactos.index')->with('success', 'Contactos atualizados com sucesso!');
    }

    public function destroy(ContactInfo $contacto)
    {
        $contacto->delete();
        $this->logActivity('delete', 'Contactos do Site', $contacto->id, 'Eliminou contactos do site');

        return redirect()->route('admin.contactos.index')->with('success', 'Contactos eliminados!');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'address'   => 'nullable|string|max:255',
            'phones'    => 'nullable|string|max:255',
            'email'     => 'nullable|email|max:255',
            'schedule'  => 'nullable|string|max:255',
            'whatsapp'  => 'nullable|string|max:255',
            'linkedin'  => 'nullable|string|max:255',
            'facebook'  => 'nullable|string|max:255',
        ]);
    }
}
