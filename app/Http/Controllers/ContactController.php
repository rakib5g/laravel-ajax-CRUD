<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(8);
        return view('contact', compact('contacts'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
           'name' => 'required'
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->save();
        return 'DOne';
//        return $request->all();
    }

    public function update(Request $request)
    {
        $contact = Contact::findOrFail($request->id);
        $contact->name = $request->name;
        $contact->save();
    }

    public function destroy(Request $request)
    {
        $contact = Contact::where('id', $request->id);
        $contact->delete();
    }
}
