<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Tugas; // Asumsi model Tugas sudah ada

class AdminController extends Controller
{    
    /**
     * Menampilkan daftar tugas siswa
     */
    public function tugas()
    {
        $tugas = Tugas::latest()->paginate(20);
        return view('admin.tugas.index', compact('tugas'));
    }
    
    /**
     * Download file tugas
     */
    public function downloadTugas($id)
    {
        $tugas = Tugas::findOrFail($id);

        $path = storage_path('app/public/' . $tugas->file);

        if (!file_exists($path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download(
            $path,
            $tugas->nama_asli
        );
    }

    
    /**
     * Hapus tugas (opsional)
     */
    public function deleteTugas($id)
    {
        $tugas = Tugas::findOrFail($id);

        if (Storage::disk('public')->exists($tugas->file)) {
            Storage::disk('public')->delete($tugas->file);
        }

        $tugas->delete();

        return redirect()
            ->route('admin.tugas.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }

}