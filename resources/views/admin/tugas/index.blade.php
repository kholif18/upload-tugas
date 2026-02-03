<!-- resources/views/admin/tugas/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Tugas Siswa')
@section('page-title', 'Daftar Tugas Siswa')
@section('page-description', 'Kelola dan unduh semua tugas yang telah diupload siswa')

@section('content')
<style>
/* Custom styles for Tugas Siswa page */
.fade-in {
    animation: fadeInUp 0.4s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Table improvements */
.admin-card table {
    min-width: 1024px;
}

@media (max-width: 1024px) {
    .admin-card {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

/* Select dropdown improvements */
.relative > select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.relative > select:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%233b82f6' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
}

/* Modal improvements */
#preview-modal {
    backdrop-filter: blur(4px);
}

#preview-modal > div {
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Hover effects */
#tugas-table-body tr {
    transition: all 0.2s ease;
}

#tugas-table-body tr:hover {
    background-color: #f9fafb;
    transform: translateX(2px);
}

/* Button improvements */
button:active {
    transform: scale(0.98);
}

/* File icon animations */
td .w-8.h-8 {
    transition: all 0.2s ease;
}

td:hover .w-8.h-8 {
    transform: scale(1.1);
}

/* Scrollbar styling */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}

/* Stats cards hover effect */
.bg-blue-50, .bg-green-50, .bg-purple-50, .bg-yellow-50 {
    transition: all 0.3s ease;
    cursor: default;
}

.bg-blue-50:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1); }
.bg-green-50:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(34, 197, 94, 0.1); }
.bg-purple-50:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(168, 85, 247, 0.1); }
.bg-yellow-50:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(234, 179, 8, 0.1); }

/* Loading animation for preview */
.fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .flex-col.md\:flex-row {
        flex-direction: column;
    }
    
    .flex-col.md\:flex-row > div {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .grid.grid-cols-2.md\:grid-cols-4 {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
    }
    
    .admin-card table th,
    .admin-card table td {
        padding: 0.5rem 0.25rem;
        font-size: 0.75rem;
    }
    
    .text-sm {
        font-size: 0.75rem;
    }
    
    .text-xs {
        font-size: 0.7rem;
    }
}

@media (max-width: 480px) {
    .flex.gap-2 {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .inline-flex.items-center {
        width: 100%;
        justify-content: center;
    }
    
    .grid.grid-cols-2.md\:grid-cols-4 {
        grid-template-columns: 1fr;
    }
}

/* Empty state styling */
tr td[colspan="6"] {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Sort button hover effect */
th button:hover {
    color: #4b5563;
}

/* Input focus improvements */
#search-input:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Filter button active state */
#reset-filters:active {
    background-color: #f3f4f6;
}

/* Table cell truncation improvement */
.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Modal responsive */
@media (max-width: 640px) {
    #preview-modal {
        padding: 1rem;
    }
    
    #preview-modal > div {
        max-height: 80vh;
    }
}
</style>
<div class="space-y-6">
    <!-- Filters and search -->
    <div class="admin-card">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="text" 
                        id="search-input" 
                        placeholder="Cari nama siswa, kelas, atau mata pelajaran..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    >
                </div>
            </div>
            
            <div class="flex flex-wrap gap-2">
                <div class="relative">
                    <select id="filter-kelas" class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm">
                        <option value="">Semua Kelas</option>
                        <option value="VII-A">VII-A</option>
                        <option value="VII-B">VII-B</option>
                        <option value="VII-C">VII-C</option>
                        <option value="VII-D">VII-D</option>
                        <option value="VIII-A">VIII-A</option>
                        <option value="VIII-B">VIII-B</option>
                        <option value="VIII-C">VIII-C</option>
                        <option value="VIII-D">VIII-D</option>
                        <option value="IX-A">IX-A</option>
                        <option value="IX-B">IX-B</option>
                        <option value="IX-C">IX-C</option>
                        <option value="IX-D">IX-D</option>
                    </select>
                    {{-- <i class="fas fa-chevron-down absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none text-sm"></i> --}}
                </div>
                
                <div class="relative">
                    <select id="filter-mapel" class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm">
                        <option value="">Semua Mapel</option>
                        <option value="Informatika">Informatika</option>
                        <option value="Bahasa Inggris">Bahasa Inggris</option>
                    </select>
                    {{-- <i class="fas fa-chevron-down absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none text-sm"></i> --}}
                </div>
                
                <button id="reset-filters" class="px-3 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 text-sm">
                    <i class="fas fa-redo mr-1"></i> Reset
                </button>
            </div>
        </div>
        
        <!-- Stats summary -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 pt-4 border-t border-gray-200">
            <div class="text-center p-3 bg-blue-50 rounded-lg">
                <p class="text-xl font-bold text-gray-800" data-stat="total-tugas">{{ count($tugas) }}</p>
                <p class="text-xs text-gray-600">Total Tugas</p>
            </div>
            <div class="text-center p-3 bg-green-50 rounded-lg">
                <p class="text-xl font-bold text-gray-800" data-stat="total-kelas">{{ collect($tugas)->pluck('kelas')->unique()->count() }}</p>
                <p class="text-xs text-gray-600">Kelas</p>
            </div>
            <div class="text-center p-3 bg-purple-50 rounded-lg">
                <p class="text-xl font-bold text-gray-800" data-stat="total-mapel">{{ collect($tugas)->pluck('mapel')->unique()->count() }}</p>
                <p class="text-xs text-gray-600">Mata Pelajaran</p>
            </div>
            <div class="text-center p-3 bg-yellow-50 rounded-lg">
                <p class="text-xl font-bold text-gray-800" data-stat="total-siswa">{{ collect($tugas)->pluck('nama')->unique()->count() }}</p>
                <p class="text-xs text-gray-600">Siswa</p>
            </div>
        </div>
    </div>
    
    <!-- Table -->
    <div class="admin-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>Nama Siswa</span>
                                <button class="ml-1 text-gray-400 hover:text-gray-600" onclick="sortTable(0)">
                                    <i class="fas fa-sort text-xs"></i>
                                </button>
                            </div>
                        </th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>Kelas</span>
                                <button class="ml-1 text-gray-400 hover:text-gray-600" onclick="sortTable(1)">
                                    <i class="fas fa-sort text-xs"></i>
                                </button>
                            </div>
                        </th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>Mata Pelajaran</span>
                                <button class="ml-1 text-gray-400 hover:text-gray-600" onclick="sortTable(2)">
                                    <i class="fas fa-sort text-xs"></i>
                                </button>
                            </div>
                        </th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>Tanggal Upload</span>
                                <button class="ml-1 text-gray-400 hover:text-gray-600" onclick="sortTable(3)">
                                    <i class="fas fa-sort text-xs"></i>
                                </button>
                            </div>
                        </th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>Judul Tugas</span>
                                <button class="ml-1 text-gray-400 hover:text-gray-600" onclick="sortTable(4)">
                                    <i class="fas fa-sort text-xs"></i>
                                </button>
                            </div>
                        </th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            File
                        </th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" id="tugas-table-body">
                    @foreach($tugas as $index => $t)
                    <tr class="hover:bg-gray-50 transition duration-150 fade-in"
                        data-nama="{{ $t->nama }}"
                        data-kelas="{{ $t->kelas }}"
                        data-mapel="{{ $t->mapel }}"
                        data-judul="{{ $t->judul }}"
                        style="opacity: 0; transform: translateY(10px); animation-delay: {{ $index * 0.03 }}s;">

                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $t->nama }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $kelasColor = [
                                    'VII-A' => 'bg-blue-100 text-blue-800',
                                    'VII-B' => 'bg-blue-100 text-blue-800',
                                    'VII-C' => 'bg-blue-100 text-blue-800',
                                    'VII-D' => 'bg-blue-100 text-blue-800',
                                    'VIII-A' => 'bg-green-100 text-green-800',
                                    'VIII-B' => 'bg-green-100 text-green-800',
                                    'VIII-C' => 'bg-green-100 text-green-800',
                                    'VIII-D' => 'bg-green-100 text-green-800',
                                    'IX-A' => 'bg-purple-100 text-purple-800',
                                    'IX-B' => 'bg-purple-100 text-purple-800',
                                    'IX-C' => 'bg-purple-100 text-purple-800',
                                    'IX-D' => 'bg-purple-100 text-purple-800',
                                ];
                                
                                $kelasClass = $kelasColor[$t->kelas] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $kelasClass }}">
                                {{ $t->kelas }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $mapelColor = [
                                    'Informatika' => 'text-blue-600 bg-blue-50',
                                    'Bahasa Inggris' => 'text-green-600 bg-green-50',
                                ];
                                
                                $mapelClass = $mapelColor[$t->mapel] ?? 'text-gray-600';
                            @endphp
                            <div class="text-sm font-medium {{ $mapelClass }} inline-flex items-center px-2 py-1 rounded">
                                <i class="fas {{ $t->mapel == 'Informatika' ? 'fa-laptop-code' : 'fa-language' }} mr-1 text-sm"></i>
                                {{ $t->mapel }}
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="text-sm text-gray-900">
                                {{ date('d/m/Y', strtotime($t->created_at ?? now())) }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ date('H:i', strtotime($t->created_at ?? now())) }}
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            @if($t->judul)
                                <div class="text-sm font-medium text-gray-900 truncate max-w-[200px]" title="{{ $t->judul }}">
                                    {{ $t->judul }}
                                </div>
                            @else
                                <span class="text-xs text-gray-400 italic">Tanpa judul</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                @php
                                    $fileExtension = strtolower(pathinfo($t->file, PATHINFO_EXTENSION));
                                    $fileIcons = [
                                        'pdf' => ['color' => 'text-red-600', 'bg' => 'bg-red-100', 'icon' => 'fa-file-pdf'],
                                        'doc' => ['color' => 'text-blue-600', 'bg' => 'bg-blue-100', 'icon' => 'fa-file-word'],
                                        'docx' => ['color' => 'text-blue-600', 'bg' => 'bg-blue-100', 'icon' => 'fa-file-word'],
                                        'jpg' => ['color' => 'text-green-600', 'bg' => 'bg-green-100', 'icon' => 'fa-file-image'],
                                        'jpeg' => ['color' => 'text-green-600', 'bg' => 'bg-green-100', 'icon' => 'fa-file-image'],
                                        'png' => ['color' => 'text-green-600', 'bg' => 'bg-green-100', 'icon' => 'fa-file-image'],
                                        'gif' => ['color' => 'text-green-600', 'bg' => 'bg-green-100', 'icon' => 'fa-file-image'],
                                        'ppt' => ['color' => 'text-orange-600', 'bg' => 'bg-orange-100', 'icon' => 'fa-file-powerpoint'],
                                        'pptx' => ['color' => 'text-orange-600', 'bg' => 'bg-orange-100', 'icon' => 'fa-file-powerpoint'],
                                        'zip' => ['color' => 'text-yellow-600', 'bg' => 'bg-yellow-100', 'icon' => 'fa-file-archive'],
                                        'rar' => ['color' => 'text-yellow-600', 'bg' => 'bg-yellow-100', 'icon' => 'fa-file-archive'],
                                        'txt' => ['color' => 'text-gray-600', 'bg' => 'bg-gray-100', 'icon' => 'fa-file-alt'],
                                    ];
                                    
                                    $fileInfo = $fileIcons[$fileExtension] ?? ['color' => 'text-gray-600', 'bg' => 'bg-gray-100', 'icon' => 'fa-file'];
                                @endphp
                                
                                <div class="w-8 h-8 {{ $fileInfo['bg'] }} rounded flex items-center justify-center mr-2">
                                    <i class="fas {{ $fileInfo['icon'] }} {{ $fileInfo['color'] }} text-sm"></i>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-sm font-medium text-gray-900 truncate max-w-[150px]" title="{{ basename($t->file) }}">
                                        {{ basename($t->file) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ strtoupper($fileExtension) }} 
                                        @php
                                            try {
                                                $fileSize = round(filesize(storage_path('app/public/' . $t->file)) / 1024);
                                                echo "• {$fileSize} KB";
                                            } catch (Exception $e) {
                                                echo "• N/A";
                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.tugas.download', $t->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm shadow-sm">
                                        <i class="fas fa-download mr-1 text-xs"></i>
                                    </a>

                                <button onclick="previewFile(
                                    '{{ asset('storage/'.$t->file) }}',
                                    '{{ $t->nama_asli }}',
                                    '{{ route('admin.tugas.download', $t->id) }}'
                                )"
                                class="btn btn-secondary">
                                    <i class="fas fa-eye mr-1 text-xs"></i>
                                </button>
                                <form action="{{ route('admin.tugas.delete', $t->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-sm shadow-sm">
                                        <i class="fas fa-trash-alt mr-1 text-xs"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                    
                    @if(count($tugas) === 0)
                    <tr>
                        <td colspan="6" class="py-8 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-inbox text-2xl text-gray-400"></i>
                                </div>
                                <h3 class="text-base font-medium text-gray-700 mb-1">Belum ada tugas</h3>
                                <p class="text-gray-500 text-sm">Tidak ada tugas yang telah diupload oleh siswa.</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <!-- Table footer with pagination -->
        @if(count($tugas) > 0)
        <div class="pt-4 mt-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Menampilkan <span class="font-medium">{{ count($tugas) }}</span> dari <span class="font-medium">{{ count($tugas) }}</span> tugas
            </div>
            
            <div class="flex items-center space-x-1">
                <button class="px-2 py-1 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 transition duration-200 text-sm disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    <i class="fas fa-chevron-left text-xs"></i>
                </button>
                
                <span class="px-2 py-1 bg-blue-600 text-white rounded text-sm font-medium">1</span>
                
                <button class="px-2 py-1 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 transition duration-200 text-sm">
                    <i class="fas fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
        @endif
    </div>
    
    
</div>

<!-- Preview Modal -->
<div id="preview-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-lg w-[95vw] max-w-4xl max-h-[90vh] flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
            <h3 class="text-base font-semibold text-gray-800" id="preview-title">Preview File</h3>
            <button onclick="closePreview()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="flex-1 overflow-y-auto p-4" style="max-height: calc(90vh - 120px);" id="preview-content">
            <!-- Preview content will be loaded here -->
            <div class="flex items-center justify-center h-64">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-file text-2xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-500 text-sm">Memuat preview file...</p>
                </div>
            </div>
        </div>
        
        <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 flex justify-between items-center sticky bottom-0 z-10">
            <div class="text-sm text-gray-600" id="file-info">File: -</div>
            <div class="flex space-x-2">
                <button onclick="closePreview()" class="px-3 py-1 border border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition duration-200 text-sm">
                    Tutup
                </button>
                <a id="download-link" href="#" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200 text-sm">
                    <i class="fas fa-download mr-1"></i> Download
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Filter and search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const filterKelas = document.getElementById('filter-kelas');
        const filterMapel = document.getElementById('filter-mapel');
        const resetButton = document.getElementById('reset-filters');
        const tableRows = document.querySelectorAll('#tugas-table-body tr');
        
        // Apply filters
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const kelasValue = filterKelas.value;
            const mapelValue = filterMapel.value;

            tableRows.forEach(row => {
                if (!row.dataset.kelas) return;

                const nama  = row.dataset.nama.toLowerCase();
                const kelas = row.dataset.kelas;
                const mapel = row.dataset.mapel;
                const judul = (row.dataset.judul || '').toLowerCase();

                const matchesSearch =
                    searchTerm === '' ||
                    nama.includes(searchTerm) ||
                    kelas.toLowerCase().includes(searchTerm) ||
                    mapel.toLowerCase().includes(searchTerm) ||
                    judul.includes(searchTerm);

                const matchesKelas = kelasValue === '' || kelas === kelasValue;
                const matchesMapel = mapelValue === '' || mapel === mapelValue;

                row.style.display = (matchesSearch && matchesKelas && matchesMapel)
                    ? ''
                    : 'none';
            });

            updateFilteredStats();
        }
        
        // Update filtered statistics
        function updateFilteredStats() {
            const visibleRows = Array.from(tableRows).filter(row => 
                row.style.display !== 'none' && row.dataset.kelas
            );
            
            const uniqueKelas = new Set(visibleRows.map(r => r.dataset.kelas));
            const uniqueMapel = new Set(visibleRows.map(r => r.dataset.mapel));
            const uniqueNama  = new Set(visibleRows.map(r => r.dataset.nama));

            document.querySelector('[data-stat="total-tugas"]').textContent = visibleRows.length;
            document.querySelector('[data-stat="total-kelas"]').textContent = uniqueKelas.size;
            document.querySelector('[data-stat="total-mapel"]').textContent = uniqueMapel.size;
            document.querySelector('[data-stat="total-siswa"]').textContent = uniqueNama.size;
        }
        
        // Event listeners
        searchInput.addEventListener('input', applyFilters);
        filterKelas.addEventListener('change', applyFilters);
        filterMapel.addEventListener('change', applyFilters);
        
        // Reset filters
        resetButton.addEventListener('click', function() {
            searchInput.value = '';
            filterKelas.value = '';
            filterMapel.value = '';
            applyFilters();
        });
        
        // Fade in animation for table rows
        const fadeElements = document.querySelectorAll('.fade-in');
        fadeElements.forEach((el, index) => {
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100 + (index * 30));
        });
        
        // Initialize stats
        updateFilteredStats();
    });
    
    // Simple table sorting
    function sortTable(columnIndex) {
        const table = document.querySelector('tbody');
        const rows = Array.from(table.querySelectorAll('tr')).filter(row => 
            row.cells.length >= 6 && row.style.display !== 'none'
        );
        
        // Skip jika tidak ada data
        if (rows.length === 0) return;
        
        // Determine sort direction
        const currentSort = table.getAttribute('data-sort') || 'asc';
        const newSort = currentSort === 'asc' ? 'desc' : 'asc';
        table.setAttribute('data-sort', newSort);
        
        rows.sort((a, b) => {
            let aValue = a.cells[columnIndex].textContent.trim();
            let bValue = b.cells[columnIndex].textContent.trim();
            
            // For date column (format: dd/mm/yyyy)
            if (columnIndex === 3) {
                const aDateParts = aValue.split('\n')[0].split('/');
                const bDateParts = bValue.split('\n')[0].split('/');
                
                if (aDateParts.length === 3 && bDateParts.length === 3) {
                    const aDate = new Date(aDateParts[2], aDateParts[1] - 1, aDateParts[0]);
                    const bDate = new Date(bDateParts[2], bDateParts[1] - 1, bDateParts[0]);
                    aValue = aDate;
                    bValue = bDate;
                }
            }
            
            // For numeric comparison for kelas (e.g., "VII-A" vs "VIII-B")
            if (columnIndex === 1) {
                const kelasOrder = {
                    'VII-A': 1, 'VII-B': 2, 'VII-C': 3, 'VII-D': 4,
                    'VIII-A': 5, 'VIII-B': 6, 'VIII-C': 7, 'VIII-D': 8,
                    'IX-A': 9, 'IX-B': 10, 'IX-C': 11, 'IX-D': 12
                };
                
                aValue = kelasOrder[aValue] || 999;
                bValue = kelasOrder[bValue] || 999;
            }
            
            if (newSort === 'asc') {
                return aValue > bValue ? 1 : -1;
            } else {
                return aValue < bValue ? 1 : -1;
            }
        });
        
        // Reorder rows
        rows.forEach(row => table.appendChild(row));
    }
    
    // File preview
    function previewFile(fileUrl, fileName, downloadUrl) {
        const modal = document.getElementById('preview-modal');
        const previewContent = document.getElementById('preview-content');
        const previewTitle = document.getElementById('preview-title');
        const fileInfo = document.getElementById('file-info');
        const downloadLink = document.getElementById('download-link');
        
        // Set file info
        previewTitle.textContent = 'Preview: ' + fileName;
        fileInfo.textContent = 'File: ' + fileName;
        downloadLink.href = downloadUrl;
        
        // Determine file type
        const extension = fileName.split('.').pop().toLowerCase();
        
        // Clear previous content
        previewContent.innerHTML = '';
        
        // Show loading
        previewContent.innerHTML = `
            <div class="flex items-center justify-center h-64">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-500 text-sm">Memuat preview file...</p>
                </div>
            </div>
        `;
        
        // Show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Simulate loading and show appropriate preview
        setTimeout(() => {
            if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                previewContent.innerHTML = `
                    <div class="flex justify-center">
                        <img src="${fileUrl}" alt="${fileName}" class="max-w-full h-auto rounded-lg shadow">
                    </div>
                `;
            } else if (extension === 'pdf') {
                previewContent.innerHTML = `
                    <div class="h-full">
                        <iframe src="${fileUrl}" class="w-full h-full" frameborder="0"></iframe>
                    </div>
                `;
            } else if (['doc', 'docx', 'ppt', 'pptx'].includes(extension)) {
                // Use Google Docs Viewer for Office files
                const googleViewerUrl = `https://docs.google.com/gview?url=${encodeURIComponent(fileUrl)}&embedded=true`;
                previewContent.innerHTML = `
                    <div class="h-full">
                        <iframe src="${googleViewerUrl}" class="w-full h-full" frameborder="0"></iframe>
                    </div>
                `;
            } else {
                previewContent.innerHTML = `
                    <div class="flex items-center justify-center h-64">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-file text-2xl text-blue-600"></i>
                            </div>
                            <h4 class="text-base font-medium text-gray-800 mb-2">${fileName}</h4>
                            <p class="text-gray-600 text-sm mb-3">File ini tidak dapat dipreview secara langsung.</p>
                            <p class="text-gray-500 text-xs">Silakan download file untuk melihat isinya.</p>
                        </div>
                    </div>
                `;
            }
        }, 500);
    }
    
    function closePreview() {
        const modal = document.getElementById('preview-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush

@endsection
