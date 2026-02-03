<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', 'Laravel')) - Admin</title>
    
    <!-- Vite untuk asset Laravel -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <!-- Load Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-graduation-cap text-white"></i>
                </div>
                <div class="sidebar-title">{{ config('app.name', 'EduAdmin') }}</div>
            </div>
            
            <!-- Sidebar Navigation -->
            <nav class="sidebar-nav">
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ route('admin.tugas.index') }}" class="{{ request()->routeIs('admin.tugas.*') ? 'active' : '' }}">
                            <i class="fas fa-tasks"></i>
                            <span>Tugas Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.edit') ? 'active' : '' }}">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="user-info">
                        <h4>{{ Auth::user()->name ?? 'Admin' }}</h4>
                        <p>Administrator</p>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <header class="main-header">
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="page-title">
                    <h1>@yield('page-title', 'Dashboard Admin')</h1>
                    <p>@yield('page-description', '')</p>
                </div>
                
                <div class="header-actions">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="btn btn-secondary">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </header>
            
            <!-- Content -->
            <div class="admin-content">
                @if(session('success'))
                    <div class="admin-card mb-6" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); border-left: 4px solid #10b981;">
                        <div class="flex-between">
                            <div>
                                <h4 class="mb-2" style="color: #065f46;">
                                    <i class="fas fa-check-circle mr-2"></i>Success
                                </h4>
                                <p style="color: #065f46;">{{ session('success') }}</p>
                            </div>
                            <button onclick="this.parentElement.parentElement.style.display='none'" 
                                    style="background: none; border: none; color: #065f46; cursor: pointer;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="admin-card mb-6" style="background: linear-gradient(135deg, #fee2e2, #fecaca); border-left: 4px solid #ef4444;">
                        <div class="flex-between">
                            <div>
                                <h4 class="mb-2" style="color: #7f1d1d;">
                                    <i class="fas fa-exclamation-circle mr-2"></i>Error
                                </h4>
                                <p style="color: #7f1d1d;">{{ session('error') }}</p>
                            </div>
                            <button onclick="this.parentElement.parentElement.style.display='none'" 
                                    style="background: none; border: none; color: #7f1d1d; cursor: pointer;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            if (mobileMenuBtn && sidebar) {
                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    if (sidebarOverlay) sidebarOverlay.classList.toggle('active');
                });
                
                if (sidebarOverlay) {
                    sidebarOverlay.addEventListener('click', function() {
                        sidebar.classList.remove('active');
                        sidebarOverlay.classList.remove('active');
                    });
                }
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 1024) {
                    if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                        sidebar.classList.remove('active');
                        if (sidebarOverlay) sidebarOverlay.classList.remove('active');
                    }
                }
            });
            
            // Fade in animation for elements
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
        
        // Window resize handler
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('active');
                if (sidebarOverlay) sidebarOverlay.classList.remove('active');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>