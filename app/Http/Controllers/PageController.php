<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Tampilkan form untuk mengedit konten halaman statis (Tentang Kami & Kontak).
     */
    public function edit()
    {
        $aboutPage = Page::where('slug', 'about-us')->firstOrFail();
        $contactPage = Page::where('slug', 'contact-us')->firstOrFail();
        
        return view('admin.pages.edit', compact('aboutPage', 'contactPage'));
    }

    /**
     * Update data konten halaman statis di database.
     */
    public function update(Request $request)
    {
        $request->validate([
            'about_title' => ['required', 'string', 'max:255'],
            'about_content' => ['required', 'string'],
            
            'contact_title' => ['required', 'string', 'max:255'],
            'contact_content' => ['required', 'string'],
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:255'],
            'contact_address' => ['required', 'string', 'max:1000'],
        ], [
            'about_title.required' => 'Judul Tentang Kami wajib diisi.',
            'about_content.required' => 'Konten Tentang Kami wajib diisi.',
            'contact_title.required' => 'Judul Kontak Kami wajib diisi.',
            'contact_content.required' => 'Deskripsi Kontak Kami wajib diisi.',
            'contact_email.required' => 'Email kontak wajib diisi.',
            'contact_email.email' => 'Format email kontak tidak valid.',
            'contact_phone.required' => 'Nomor telepon kontak wajib diisi.',
            'contact_address.required' => 'Alamat kontak wajib diisi.',
        ]);

        // Update Tentang Kami
        $aboutPage = Page::where('slug', 'about-us')->firstOrFail();
        $aboutPage->update([
            'title' => $request->about_title,
            'content' => $request->about_content,
        ]);

        // Update Hubungi Kami
        $contactPage = Page::where('slug', 'contact-us')->firstOrFail();
        $contactPage->update([
            'title' => $request->contact_title,
            'content' => $request->contact_content,
            'additional_metadata' => [
                'email' => $request->contact_email,
                'phone' => $request->contact_phone,
                'address' => $request->contact_address,
            ]
        ]);

        return redirect()->route('admin.pages.edit')
            ->with('success', 'Konten halaman statis berhasil diperbarui!');
    }
}
