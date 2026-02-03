<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'mapel' => 'required|string|max:50',
            'judul' => 'nullable|string|max:255',
            'file'  => 'required|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
        ]);

        $file = $request->file('file');

        $originalName = $file->getClientOriginalName();
        $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Simpan file dengan nama yang kita tentukan
        $file->storeAs('tugas', $namaFile, 'public');

        Tugas::create([
            'nama'       => $request->nama,
            'kelas'      => $request->kelas,
            'mapel'      => $request->mapel,
            'judul'      => $request->judul,
            'file'       => 'tugas/' . $namaFile,
            'nama_asli'  => $originalName,
        ]);

        return back()->with('success', 'Tugas berhasil dikirim');
    }

}
