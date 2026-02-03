<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Tugas Siswa</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen font-poppins">
    <div class="container mx-auto px-4 py-8">
        <!-- Header dengan logo sekolah -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-full mb-4">
                <i class="fas fa-cloud-upload-alt text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Upload Tugas Sekolah</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Kirim tugas Anda dengan mudah. Pastikan file sesuai dengan format yang ditentukan.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Form upload -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Header form -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Form Upload Tugas</h2>
                        <p class="text-blue-100 text-sm">Isi data dengan benar dan lengkap</p>
                    </div>

                    <!-- Form content -->
                    <div class="p-6 md:p-8">

                        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" id="upload-form" class="space-y-6">
                            @csrf

                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama" class="block text-gray-700 font-medium mb-2">
                                    <i class="fas fa-user text-blue-600 mr-2"></i>Nama Lengkap
                                </label>
                                <div class="relative">
                                    <input id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" 
                                           class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                           required>
                                    <i class="fas fa-user text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                                </div>
                            </div>

                            <!-- Kelas -->
                            <div>
                                <label for="kelas" class="block text-gray-700 font-medium mb-2">
                                    <i class="fas fa-users text-blue-600 mr-2"></i>Kelas
                                </label>
                                <div class="relative">
                                    <select id="kelas" name="kelas" 
                                            class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 appearance-none"
                                            required>
                                        <option value="" disabled selected>Pilih kelas Anda</option>
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
                                    <i class="fas fa-users text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                                    <i class="fas fa-chevron-down text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"></i>
                                </div>
                            </div>

                            <!-- Mata Pelajaran -->
                            <div>
                                <label for="mapel" class="block text-gray-700 font-medium mb-2">
                                    <i class="fas fa-book text-blue-600 mr-2"></i>Mata Pelajaran
                                </label>
                                <div class="relative">
                                    <select id="mapel" name="mapel" 
                                            class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 appearance-none"
                                            required>
                                        <option value="" disabled selected>Pilih mata pelajaran</option>
                                        <option value="Informatika">Informatika</option>
                                        <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    </select>
                                    <i class="fas fa-book text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                                    <i class="fas fa-chevron-down text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"></i>
                                </div>
                            </div>

                            <div>
                                <label for="judul" class="block text-gray-700 font-medium mb-2">
                                    <i class="fas fa-heading text-blue-600 mr-2"></i>Judul Tugas (Opsional)
                                </label>
                                <div class="relative">
                                    <input id="judul" name="judul" placeholder="Masukkan judul tugas Anda" 
                                           class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                    <i class="fas fa-heading text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                                </div>
                            </div>
                            <!-- File Upload -->
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    <i class="fas fa-file-upload text-blue-600 mr-2"></i>File Tugas
                                </label>
                                
                                <!-- Area drag & drop -->
                                <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center transition duration-300 hover:border-blue-400 hover:bg-blue-50">
                                    <div class="mb-4">
                                        <i class="fas fa-cloud-upload-alt text-5xl text-blue-400 mb-3"></i>
                                        <p class="text-gray-700 font-medium">Drag & drop file Anda di sini</p>
                                        <p class="text-gray-500 text-sm mt-1">atau klik untuk memilih file</p>
                                    </div>
                                    <input type="file" name="file" id="file-input" class="hidden" required>
                                    <label for="file-input" class="inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium py-3 px-6 rounded-xl cursor-pointer transition duration-300 shadow-md hover:shadow-lg">
                                        <i class="fas fa-folder-open mr-2"></i> Pilih File
                                    </label>
                                    <p class="text-gray-500 text-sm mt-4">Format yang didukung: PDF, DOC, DOCX, PPT, PPTX, JPG, PNG (Maks. 10MB)</p>
                                </div>
                                
                                <!-- File info preview -->
                                <div id="file-info" class="hidden mt-4 bg-gray-50 border border-gray-200 rounded-xl p-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                            <i class="fas fa-file text-blue-600 text-xl"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <h4 id="file-name" class="font-medium text-gray-800 truncate">nama-file.pdf</h4>
                                            <p id="file-size" class="text-gray-600 text-sm">0 KB</p>
                                        </div>
                                        <button type="button" id="remove-file" class="text-red-500 hover:text-red-700 ml-2">
                                            <i class="fas fa-times text-xl"></i>
                                        </button>
                                    </div>
                                    <div class="mt-3">
                                        <div id="progress-bar" class="hidden h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div id="progress" class="h-full bg-gradient-to-r from-green-400 to-green-500 w-0 transition-all duration-300"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="pt-4">
                                <button type="submit" id="submit-btn" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Tugas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar informasi -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-3"></i> Panduan Upload
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 mt-1">
                                <span class="font-bold">1</span>
                            </div>
                            <p class="text-gray-700">Isi data diri dengan lengkap dan benar sesuai identitas Anda.</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 mt-1">
                                <span class="font-bold">2</span>
                            </div>
                            <p class="text-gray-700">Pilih mata pelajaran dan kelas sesuai dengan tugas yang dikumpulkan.</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 mt-1">
                                <span class="font-bold">3</span>
                            </div>
                            <p class="text-gray-700">Upload file tugas dengan format yang telah ditentukan (PDF, DOC, dll).</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 mt-1">
                                <span class="font-bold">4</span>
                            </div>
                            <p class="text-gray-700">Pastikan file tidak melebihi ukuran maksimal 10MB.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center text-gray-500 text-sm">
            <p>© 2026 Sistem Upload Tugas Sekolah. Semua hak dilindungi.</p>
            <p class="mt-1">Jika mengalami kendala, hubungi guru mata pelajaran terkait.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil 🎉',
                text: @json(session('success')),
                confirmButtonColor: '#10b981'
            });
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Upload ❌',
                html: `
                    <ul style="text-align:left">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#ef4444'
            });
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elemen DOM
            const dropArea = document.getElementById('drop-area');
            const fileInput = document.getElementById('file-input');
            const fileInfo = document.getElementById('file-info');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            const removeFileBtn = document.getElementById('remove-file');
            const progressBar = document.getElementById('progress-bar');
            const progress = document.getElementById('progress');
            const submitBtn = document.getElementById('submit-btn');
            const uploadForm = document.getElementById('upload-form');
            
            // Mencegah perilaku default untuk drag & drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            // Highlight drop area saat file di-drag
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropArea.classList.add('border-blue-500', 'bg-blue-100');
            }
            
            function unhighlight() {
                dropArea.classList.remove('border-blue-500', 'bg-blue-100');
            }
            
            // Handle dropped files
            dropArea.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }
            
            // Handle file input change
            fileInput.addEventListener('change', function() {
                handleFiles(this.files);
            });
            
            // Fungsi untuk menangani file yang dipilih/di-drop
            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    
                    // Validasi ukuran file (max 10MB)
                    if (file.size > 10 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran file maksimal 10MB',
                            confirmButtonColor: '#f59e0b'
                        });
                        return;
                    }
                    
                    // Validasi tipe file
                    const allowedTypes = ['application/pdf', 'application/msword', 
                                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        'application/vnd.ms-powerpoint', 
                                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                        'image/jpeg', 'image/png'];
                    
                    if (!allowedTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format File Tidak Didukung', 
                            text: 'Silakan upload file dengan format PDF, DOC, DOCX, PPT, PPTX, JPG, atau PNG.',
                            confirmButtonColor: '#f59e0b'
                        });
                        return;
                    }
                    
                    // Tampilkan info file
                    fileName.textContent = file.name;
                    fileSize.textContent = `${fileSizeMB} MB`;
                    fileInfo.classList.remove('hidden');
                    
                    // Simpan file di data transfer untuk form submission
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                }
            }
            
            // Remove file button
            removeFileBtn.addEventListener('click', function() {
                fileInput.value = '';
                fileInfo.classList.add('hidden');
            });
            
            // Form submission dengan simulasi progress bar
            uploadForm.addEventListener('submit', function(e) {
                if (!fileInput.files || fileInput.files.length === 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'info',
                        title: 'File Belum Dipilih',
                        text: 'Silakan pilih file tugas terlebih dahulu',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Mengunggah Tugas...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
            
            // Animasi untuk form elements saat halaman dimuat
            const formElements = document.querySelectorAll('input, select, button');
            formElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #2563eb, #7c3aed);
        }
        
        /* Animasi untuk file info */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        #file-info {
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Efek hover untuk card */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</body>
</html>