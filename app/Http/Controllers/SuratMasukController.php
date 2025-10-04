<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;

class SuratMasukController extends Controller
{
    public function index()
    {
        // ambil data terbaru duluan berdasarkan tanggal_masuk
        $surat = SuratMasuk::latest()->get();

        return view('suratmasuk', compact('surat'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pengirim' => 'required|string|max:255',
            'no_surat' => 'required|string|max:255|unique:surat_masuk,no_surat',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'file' => 'nullable|mimes:pdf,jpg,png,doc,docx|max:2048',
        ], [
            'no_surat.unique' => 'Nomor surat sudah terdaftar, silakan gunakan nomor lain.',
        ]);

        // Simpan file jika ada
        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploads'), $fileName);
        }

        // Simpan ke database
        SuratMasuk::create([
            'pengirim' => $request->pengirim,
            'no_surat' => $request->no_surat,
            'perihal' => $request->perihal,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'file_upload' => $fileName,
        ]);

        return redirect()->route('suratmasuk')->with('success', 'Surat berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('suratmasuk_edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pengirim' => 'required',
            'no_surat' => 'required',
            'perihal' => 'required',
            'tanggal_surat' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'file' => 'nullable|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        $surat = SuratMasuk::findOrFail($id);

        $fileName = $surat->file_upload;
        if ($request->hasFile('file')) {
            // hapus file lama kalau ada
            if ($fileName && file_exists(public_path('uploads/' . $fileName))) {
                unlink(public_path('uploads/' . $fileName));
            }
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploads'), $fileName);
        }

        $surat->update([
            'pengirim' => $request->pengirim,
            'no_surat' => $request->no_surat,
            'perihal' => $request->perihal,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'file_upload' => $fileName,
        ]);

        return redirect()->route('suratmasuk')->with('success', 'Surat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $surat = SuratMasuk::findOrFail($id);

        if ($surat->file_upload && file_exists(public_path('uploads/' . $surat->file_upload))) {
            unlink(public_path('uploads/' . $surat->file_upload));
        }

        $surat->delete();

        return redirect()->route('suratmasuk')->with('success', 'Surat berhasil dihapus!');
    }
}
