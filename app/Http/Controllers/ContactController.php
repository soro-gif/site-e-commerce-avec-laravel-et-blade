<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(5);
        return view('contacts/index', ['contacts' => $contacts]);
    }

    public function show($id): View
    {
        $contact = Contact::findOrFail($id);

        return view('contacts/show',['contact' => $contact]);
    }
    public function create(): View
    {
        return view('contacts/create');
    }

    public function edit($id): View
    {
        $contact = Contact::findOrFail($id);
        return view('contacts/edit', ['contact' => $contact]);
    }

    public function store(ContactFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        

        $contact = Contact::create($data);
        return redirect()->route('admin.contact.show', ['id' => $contact->id]);
    }

    public function update(Contact $contact, ContactFormRequest $req)
    {
        $data = $req->validated();

        

        $contact->update($data);

        return redirect()->route('admin.contact.show', ['id' => $contact->id]);
    }

    public function updateSpeed(Contact $contact, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $contact->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Contact $contact)
    {
        
        $contact->delete();

        return [
            'isSuccess' => true
        ];
    }

    
}