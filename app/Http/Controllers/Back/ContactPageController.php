<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index()
    {
        $contactPage = ContactPage::first();
        return view('back.contact.edit', compact('contactPage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $contactPage = ContactPage::first();
        
        $contactPage->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        return redirect()->back()->with('success', 'Kontak berhasil diperbarui!');
    }

    public function show()
    {
        $contactPage = ContactPage::first();

        return view('front.contact.contact', compact('contactPage'));
    }
}

