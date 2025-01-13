<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index()
    {
        $contactPage = ContactPage::first(); // Ambil data pertama (hanya satu halaman kontak)
        return view('back.contact.edit', compact('contactPage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $contactPage = ContactPage::first(); // Ambil data pertama

        // Update data kontak
        $contactPage->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('back.contact.index')->with('success', 'Halaman kontak berhasil diperbarui');
    }

    public function show()
    {
        // Mengambil data halaman kontak dari database
        $contactPage = ContactPage::first();

        // Menampilkan halaman kontak di view
        return view('front.contact.contact', compact('contactPage'));
    }
}

