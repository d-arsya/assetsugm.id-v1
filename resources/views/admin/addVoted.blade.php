@extends('admin.layouts.appAdmin')
@vite(['resources/css/style.css', 'resources/js/script.js'])

@section('title', 'Tambah Kandidat')
@section('content')
    <form onsubmit="console.log('submitted')" action="{{ route('admin.pemira.store') }}" method="post"
        enctype="multipart/form-data" novalidate>
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Avatar Upload -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Foto Kandidat
                    </h3>

                    <div class="mb-4">
                        <div id="avatarPreview"
                            class="w-full aspect-square bg-gradient-to-br from-purple-100 to-blue-100 rounded-2xl flex items-center justify-center mb-4 overflow-hidden border-4 border-white shadow-lg">
                            <svg class="w-24 h-24 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>

                        <label class="block w-full">
                            <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden"
                                onchange="previewAvatar(event)">
                            <div
                                class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 font-semibold text-center cursor-pointer">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    Pilih Foto
                                </span>
                            </div>
                        </label>
                        @error('avatar')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2 text-center">Format: JPG, PNG, JPEG (Max: 2MB)</p>
                    </div>

                    <!-- CV Upload -->
                    <div class="border-t pt-4">
                        <h4 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            CV / Portfolio (Opsional)
                        </h4>
                        <label class="block w-full">
                            <input type="file" name="cv" id="cvInput" accept=".pdf" class="hidden"
                                onchange="updateCVLabel(event)">
                            <div
                                class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium text-sm text-center cursor-pointer">
                                <span id="cvLabel" class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    Upload CV (PDF)
                                </span>
                            </div>
                        </label>
                        @error('cv')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2 text-center">Format: PDF (Max: 5MB)</p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Form Fields -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Data Kandidat
                    </h3>

                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition-colors @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap kandidat">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIM -->
                        <div>
                            <label for="nim" class="block text-sm font-semibold text-gray-700 mb-2">
                                NIM <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required
                                maxlength="18"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition-colors @error('nim') border-red-500 @enderror"
                                placeholder="Contoh: 22/493456/SV/21234">
                            @error('nim')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Vision -->
                        <div>
                            <label for="vision" class="block text-sm font-semibold text-gray-700 mb-2">
                                Visi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="vision" id="vision" rows="4" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition-colors resize-none @error('vision') border-red-500 @enderror"
                                placeholder="Tuliskan visi kandidat...">{{ old('vision') }}</textarea>
                            @error('vision')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Jelaskan visi kandidat sebagai ketua ASSETS</p>
                        </div>

                        <!-- Mission -->
                        <div>
                            <label for="mission" class="block text-sm font-semibold text-gray-700 mb-2">
                                Misi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="mission" id="mission" rows="8" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition-colors resize-none @error('mission') border-red-500 @enderror"
                                placeholder="Tuliskan misi (setiap baris akan menjadi satu poin misi)&#10;Contoh:&#10;Meningkatkan kualitas pembelajaran&#10;Membangun kolaborasi dengan industri&#10;Mengembangkan softskill mahasiswa">{{ old('mission') }}</textarea>
                            @error('mission')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                <strong>Tips:</strong> Tulis setiap misi di baris baru. Setiap baris akan menjadi satu
                                poin misi.
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 mt-8 pt-6 border-t">
                        <button type="submit"
                            class="flex-1 px-8 py-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 font-bold text-lg">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Kandidat
                            </span>
                        </button>
                        <a href="{{ route('admin.pemira') }}"
                            class="px-8 py-4 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-all duration-200 font-bold text-lg text-center">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Preview Avatar
        function previewAvatar(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('avatarPreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML =
                        `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
                }
                reader.readAsDataURL(file);
            }
        }

        // Update CV Label
        function updateCVLabel(event) {
            const file = event.target.files[0];
            const label = document.getElementById('cvLabel');

            if (file) {
                label.innerHTML = `
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-green-600">${file.name}</span>
                `;
            }
        }
    </script>
@endsection
