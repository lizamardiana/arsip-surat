<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;

class SuratKeluarController extends Controller
{
    public function index()
    {
        // Ambil data terbaru duluan
        $surat = SuratKeluar::latest()->get();
        return view('suratkeluar', compact('surat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required|string|max:255',
            'no_surat' => 'required|string|max:255|unique:surat_keluar,no_surat',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_keluar' => 'required|date',
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
        SuratKeluar::create([
            'tujuan' => $request->tujuan,
            'no_surat' => $request->no_surat,
            'perihal' => $request->perihal,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_keluar' => $request->tanggal_keluar,
            'file_upload' => $fileName,
        ]);

        return redirect()->route('suratkeluar.index')->with('success', 'Surat keluar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('suratkeluar_edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tujuan' => 'required|string|max:255',
            'no_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_keluar' => 'required|date',
            'file' => 'nullable|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        $surat = SuratKeluar::findOrFail($id);

        $fileName = $surat->file_upload;
        if ($request->hasFile('file')) {
            if ($fileName && file_exists(public_path('uploads/' . $fileName))) {
                unlink(public_path('uploads/' . $fileName));
            }
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploads'), $fileName);
        }

        $surat->update([
            'tujuan' => $request->tujuan,
            'no_surat' => $request->no_surat,
            'perihal' => $request->perihal,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_keluar' => $request->tanggal_keluar,
            'file_upload' => $fileName,
        ]);

        return redirect()->route('suratkeluar.index')->with('success', 'Surat keluar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);

        if ($surat->file_upload && file_exists(public_path('uploads/' . $surat->file_upload))) {
            unlink(public_path('uploads/' . $surat->file_upload));
        }

        $surat->delete();

        return redirect()->route('suratkeluar.index')->with('success', 'Surat keluar berhasil dihapus!');
    }
}
