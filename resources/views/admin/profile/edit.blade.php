@extends('layouts.admin')

@section('title', 'Edit Profil')
@section('page-title', 'Pengaturan Profil')
@section('page-description', 'Kelola informasi profil dan akun Anda')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Update Profile Information -->
    <div class="admin-card">
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-user-edit text-blue-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Informasi Profil</h2>
                <p class="text-sm text-gray-600">Perbarui informasi profil dan alamat email Anda</p>
            </div>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                <span class="text-green-800 text-sm font-medium">Profil berhasil diperbarui!</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('patch')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $user->name) }}" 
                        required 
                        autocomplete="name"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}" 
                        required 
                        autocomplete="email"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end pt-6 mt-6 border-t border-gray-200">
                <button 
                    type="submit" 
                    class="btn btn-success"
                >
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Update Password (Optional - if you have this feature) -->
    <div class="admin-card">
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-lock text-green-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Ubah Password</h2>
                <p class="text-sm text-gray-600">Pastikan akun Anda menggunakan password yang panjang dan acak</p>
            </div>
        </div>

        @if (session('status') === 'password-updated')
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                <span class="text-green-800 text-sm font-medium">Password berhasil diperbarui!</span>
            </div>
        @endif

        <!-- Note: This form requires additional routes/controller -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="space-y-4">
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password Saat Ini <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="current_password" 
                            name="current_password" 
                            required 
                            autocomplete="current-password"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 pr-10 @error('current_password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                        >
                        <button type="button" onclick="togglePassword('current_password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 pr-10 @error('password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                        >
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 pr-10"
                        >
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end pt-6 mt-6 border-t border-gray-200">
                <button 
                    type="submit" 
                    class="btn btn-secondary"
                >
                    <i class="fas fa-key mr-2"></i> Ubah Password
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="admin-card border border-red-200">
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-red-800">Hapus Akun</h2>
                <p class="text-sm text-red-600">Hapus permanen akun Anda dan semua data yang terkait</p>
            </div>
        </div>

        <div class="p-4 bg-red-50 border border-red-200 rounded-lg mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400 mt-0.5"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Peringatan</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <p>Setelah akun Anda dihapus, semua data dan resource akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Account Form -->
        <form method="POST" action="{{ route('admin.profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="space-y-4">
                <div>
                    <label for="delete_password" class="block text-sm font-medium text-red-700 mb-1">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="delete_password" 
                            name="password" 
                            required 
                            placeholder="Masukkan password Anda untuk konfirmasi"
                            class="w-full px-4 py-2.5 border border-red-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200 pr-10 bg-white"
                        >
                        <button type="button" onclick="togglePassword('delete_password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-red-400 hover:text-red-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password', 'userDeletion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end pt-6 mt-6 border-t border-red-200">
                <button 
                    type="submit" 
                    onclick="return confirmDelete()"
                    class="btn btn-danger"
                >
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Akun Permanen
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Toggle password visibility
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Confirm account deletion
    function confirmDelete() {
        return confirm('Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan dan semua data Anda akan dihapus permanen.');
    }

    // Auto-hide success message after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successMessages = document.querySelectorAll('.bg-green-50');
        successMessages.forEach(message => {
            setTimeout(() => {
                message.style.transition = 'opacity 0.5s ease';
                message.style.opacity = '0';
                setTimeout(() => {
                    if (message.parentNode) {
                        message.style.display = 'none';
                    }
                }, 500);
            }, 5000);
        });
    });

    // Form validation enhancement
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = submitButton.getAttribute('data-original-text') || submitButton.innerHTML;
                }, 3000);
            }
        });
    });

    // Store original button text
    document.addEventListener('DOMContentLoaded', function() {
        const submitButtons = document.querySelectorAll('button[type="submit"]');
        submitButtons.forEach(button => {
            button.setAttribute('data-original-text', button.innerHTML);
        });
    });
</script>

<style>
    /* Custom styles for profile page */
    .admin-card {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
        transform: translateY(10px);
    }

    .admin-card:nth-child(1) { animation-delay: 0.1s; }
    .admin-card:nth-child(2) { animation-delay: 0.2s; }
    .admin-card:nth-child(3) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Password strength indicator */
    .password-strength {
        height: 4px;
        border-radius: 2px;
        margin-top: 4px;
        transition: all 0.3s ease;
    }

    /* Focus styles for inputs */
    input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    input:focus.border-red-300 {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .grid.grid-cols-1.md\:grid-cols-2 {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .flex.items-center.mb-6 {
            flex-direction: column;
            text-align: center;
        }
        
        .flex.items-center.mb-6 > .mr-4 {
            margin-right: 0;
            margin-bottom: 1rem;
        }
    }

    /* Button loading state */
    button[disabled] {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .fa-spinner {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush

@endsection