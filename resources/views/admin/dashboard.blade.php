<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan dan statistik tugas siswa')

@section('content')
<div class="grid-4 mb-6">
    <!-- Stat Cards -->
    <div class="admin-card fade-in" style="opacity: 0; transform: translateY(10px);">
        <div class="flex-between mb-4">
            <div>
                <h3 class="mb-2 text-muted">Total Tugas</h3>
                <p class="text-3xl font-bold">142</p>
            </div>
            <div class="p-3 rounded-lg" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                <i class="fas fa-tasks text-blue-600 text-xl"></i>
            </div>
        </div>
        <p class="text-sm text-success">
            <i class="fas fa-arrow-up mr-1"></i> 12% dari bulan lalu
        </p>
    </div>
    
    <div class="admin-card fade-in" style="opacity: 0; transform: translateY(10px); animation-delay: 0.1s;">
        <div class="flex-between mb-4">
            <div>
                <h3 class="mb-2 text-muted">Tugas Baru</h3>
                <p class="text-3xl font-bold">24</p>
            </div>
            <div class="p-3 rounded-lg" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                <i class="fas fa-file-upload text-green-600 text-xl"></i>
            </div>
        </div>
        <p class="text-sm text-success">
            <i class="fas fa-arrow-up mr-1"></i> 8% dari minggu lalu
        </p>
    </div>
    
    <div class="admin-card fade-in" style="opacity: 0; transform: translateY(10px); animation-delay: 0.2s;">
        <div class="flex-between mb-4">
            <div>
                <h3 class="mb-2 text-muted">Siswa Aktif</h3>
                <p class="text-3xl font-bold">312</p>
            </div>
            <div class="p-3 rounded-lg" style="background: linear-gradient(135deg, #f3e8ff, #e9d5ff);">
                <i class="fas fa-user-graduate text-purple-600 text-xl"></i>
            </div>
        </div>
        <p class="text-sm text-muted">12 kelas aktif</p>
    </div>
    
    <div class="admin-card fade-in" style="opacity: 0; transform: translateY(10px); animation-delay: 0.3s;">
        <div class="flex-between mb-4">
            <div>
                <h3 class="mb-2 text-muted">Mata Pelajaran</h3>
                <p class="text-3xl font-bold">15</p>
            </div>
            <div class="p-3 rounded-lg" style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                <i class="fas fa-book-open text-yellow-600 text-xl"></i>
            </div>
        </div>
        <p class="text-sm text-muted">5 terbanyak tugas</p>
    </div>
</div>

<div class="grid-2 mb-6">
    <!-- Chart Section -->
    <div class="admin-card">
        <div class="card-header">
            <h3>Statistik Tugas per Bulan</h3>
            <div>
                <button class="btn btn-secondary btn-sm">Bulan Ini</button>
                <button class="btn btn-secondary btn-sm">Tahun Ini</button>
            </div>
        </div>
        
        <div class="h-64 flex items-end space-x-2 mt-8">
            @php
                $monthlyData = [65, 59, 80, 81, 56, 55, 70, 75, 82, 78, 85, 90];
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            @endphp
            
            @foreach($monthlyData as $index => $value)
                <div class="flex-1 flex flex-col items-center">
                    <div class="w-full flex justify-center">
                        <div class="w-8 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" 
                             style="height: {{ $value * 2 }}px;"
                             title="{{ $months[$index] }}: {{ $value }} tugas">
                        </div>
                    </div>
                    <span class="text-xs text-muted mt-2">{{ $months[$index] }}</span>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="admin-card">
        <div class="card-header">
            <h3>Aktivitas Terbaru</h3>
            <a href="{{ route('admin.tugas.index') }}" class="btn btn-primary btn-sm">
                Lihat Semua
            </a>
        </div>
        
        <div class="space-y-4">
            @php
                $activities = [
                    ['user' => 'Andi Wijaya', 'action' => 'mengumpulkan tugas Matematika', 'time' => '10 menit lalu', 'icon' => 'fa-user', 'color' => 'blue'],
                    ['user' => 'Sari Dewi', 'action' => 'mengumpulkan tugas Fisika', 'time' => '30 menit lalu', 'icon' => 'fa-user', 'color' => 'green'],
                    ['user' => 'Budi Santoso', 'action' => 'mengumpulkan tugas Bahasa Inggris', 'time' => '1 jam lalu', 'icon' => 'fa-user', 'color' => 'purple'],
                    ['user' => 'Dewi Lestari', 'action' => 'mengumpulkan tugas Kimia', 'time' => '2 jam lalu', 'icon' => 'fa-user', 'color' => 'indigo'],
                ];
            @endphp
            
            @foreach($activities as $activity)
                <div class="flex items-start">
                    <div class="p-2 rounded-lg mr-3" 
                         style="background: linear-gradient(135deg, var(--{{ $activity['color'] }}-100), var(--{{ $activity['color'] }}-200));">
                        <i class="fas {{ $activity['icon'] }} text-{{ $activity['color'] }}-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium">{{ $activity['user'] }}</p>
                        <p class="text-sm text-muted">{{ $activity['action'] }}</p>
                        <p class="text-xs text-muted mt-1">{{ $activity['time'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="admin-card">
    <div class="card-header">
        <h3>Aksi Cepat</h3>
    </div>
    
    <div class="grid-3">
        <a href="{{ route('admin.tugas.index') }}" class="admin-card text-center hover:transform hover:-translate-y-1 transition-transform">
            <div class="p-4 rounded-lg mb-3" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                <i class="fas fa-tasks text-blue-600 text-2xl"></i>
            </div>
            <h4 class="font-semibold mb-2">Kelola Tugas</h4>
            <p class="text-sm text-muted">Lihat dan unduh tugas siswa</p>
        </a>
        
        <a href="#" class="admin-card text-center hover:transform hover:-translate-y-1 transition-transform">
            <div class="p-4 rounded-lg mb-3" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                <i class="fas fa-chart-pie text-green-600 text-2xl"></i>
            </div>
            <h4 class="font-semibold mb-2">Analisis Data</h4>
            <p class="text-sm text-muted">Lihat statistik lengkap</p>
        </a>
        
        <a href="#" class="admin-card text-center hover:transform hover:-translate-y-1 transition-transform">
            <div class="p-4 rounded-lg mb-3" style="background: linear-gradient(135deg, #f3e8ff, #e9d5ff);">
                <i class="fas fa-file-export text-purple-600 text-2xl"></i>
            </div>
            <h4 class="font-semibold mb-2">Export Data</h4>
            <p class="text-sm text-muted">Ekspor data ke Excel/PDF</p>
        </a>
    </div>
</div>
@endsection