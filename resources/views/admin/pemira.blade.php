@extends('admin.layouts.appAdmin')
@vite(['resources/css/style.css', 'resources/js/script.js'])

@section('title', 'Pemira ASSETS')
@section('content')

    <!-- Header Section -->
    <div class="-mt-16 mb-8">
        <div class="flex items-center justify-between md:flex-row flex-col">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">🗳️ Dashboard Pemira</h1>
                <p class="text-gray-600">Kelola pemilihan ketua ASSETS periode 2025-2026</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.pemira.create') }}"
                    class="p-2 text-sm bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 font-semibold">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Kandidat
                    </span>
                </a>

                <!-- Import Voters Button -->
                <form action="{{ route('admin.pemira.import') }}" method="POST" enctype="multipart/form-data"
                    id="importForm" class="inline-block">
                    @csrf
                    <input type="file" name="file" id="fileInput" accept=".xlsx,.xls" class="hidden"
                        onchange="handleFileSelect(event)">
                    <label for="fileInput"
                        class="p-2 text-sm bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 font-semibold cursor-pointer inline-block">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            Import Pemilih
                        </span>
                    </label>
                </form>

                <a href="/send-mail"
                    class="p-2 text-sm bg-white text-purple-600 border-2 border-purple-600 rounded-xl hover:bg-purple-50 transform hover:-translate-y-0.5 transition-all duration-200 font-semibold">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                        </svg>
                        Kirim Notifikasi
                    </span>
                </a>
            </div>

            <!-- Loading Modal -->
            <div id="loadingModal"
                class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                <div class="bg-white rounded-2xl p-8 max-w-sm w-full mx-4 text-center shadow-2xl">
                    <div class="mb-4">
                        <svg class="animate-spin h-16 w-16 mx-auto text-purple-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Mengimpor Data...</h3>
                    <p class="text-gray-600 text-sm">Mohon tunggu, sedang memproses file Excel</p>
                </div>
            </div>


        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Candidates -->
        <div
            class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $voteds->count() }}</span>
            </div>
            <h3 class="text-lg font-semibold opacity-90">Total Kandidat</h3>
            <p class="text-sm opacity-75 mt-1">Calon ketua</p>
        </div>

        <!-- Total Voters -->
        <div
            class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $voters->count() }}</span>
            </div>
            <h3 class="text-lg font-semibold opacity-90">Total Pemilih</h3>
            <p class="text-sm opacity-75 mt-1">Mahasiswa terdaftar</p>
        </div>

        <!-- Already Voted -->
        <div
            class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $voters->whereNotNull('voted_id')->count() }}</span>
            </div>
            <h3 class="text-lg font-semibold opacity-90">Sudah Memilih</h3>
            <p class="text-sm opacity-75 mt-1">Suara masuk</p>
        </div>

        <!-- Participation Rate -->
        <div
            class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <span
                    class="text-3xl font-bold">{{ $voters->count() > 0 ? round(($voters->whereNotNull('voted_id', true)->count() / $voters->count()) * 100, 1) : 0 }}%</span>
            </div>
            <h3 class="text-lg font-semibold opacity-90">Partisipasi</h3>
            <p class="text-sm opacity-75 mt-1">Tingkat kehadiran</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 gap-6 mb-6">
        <!-- Candidates Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6">
                <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Daftar Kandidat
                </h2>
                <p class="text-purple-100 mt-1">{{ $voteds->count() }} kandidat terdaftar</p>
            </div>

            <div class="p-6">
                @if ($voteds->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($voteds as $candidate)
                            <div
                                class="bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-xl p-6 hover:shadow-xl hover:border-purple-300 transition-all duration-200 transform hover:-translate-y-1">
                                <div class="flex flex-col items-center text-center">
                                    <div
                                        class="w-24 h-24 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-full flex items-center justify-center text-white text-3xl font-bold mb-4 shadow-lg overflow-hidden">
                                        <img src="{{ $candidate->avatar }}" alt="">
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">
                                        {{ $candidate->name ?? 'Nama Kandidat' }}</h3>
                                    <p class="text-sm text-gray-500 mb-4">{{ $candidate->nim ?? 'NIM' }}</p>

                                    <div class="w-full bg-gray-100 rounded-lg p-3 mb-3">
                                        <div class="flex items-center justify-center gap-2 text-purple-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-bold text-lg">{{ $candidate->voters->count() }}</span>
                                            <span class="text-sm">Suara</span>
                                        </div>
                                    </div>

                                    <div class="flex gap-2 w-full">
                                        <a href="/admin/pemira/{{ $candidate->id }}/edit"
                                            class="flex-1 px-4 py-2 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200 transition-colors font-medium text-sm">
                                            Edit
                                        </a>
                                        <form action="/admin/pemira/{{ $candidate->id }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="flex-1 px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors font-medium text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Kandidat</h3>
                        <p class="text-gray-500">Tambahkan kandidat untuk memulai pemilihan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Voters Section -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-cyan-600 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Daftar Pemilih
                    </h2>
                    <p class="text-blue-100 mt-1">Total {{ $voters->count() }} mahasiswa terdaftar</p>
                </div>
            </div>
        </div>

        <!-- Voters Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status Voting</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email Dikirim</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($voters as $index => $voter)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                                {{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ substr($voter->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $voter->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $voter->email ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($voter->voted_id)
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Sudah Voting
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Belum Voting
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($voter->sended)
                                    <div class="flex flex-col">
                                        <span
                                            class="text-gray-700 font-medium">{{ \Carbon\Carbon::parse($voter->sended)->format('d M Y') }}</span>
                                        <span
                                            class="text-gray-500 text-xs">{{ \Carbon\Carbon::parse($voter->sended)->format('H:i') }}
                                            WIB</span>
                                    </div>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Belum Dikirim
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-2">
                                    @if (!$voter->sended)
                                        <a href="/send-mail/{{ $voter->email }}"
                                            class="px-3 py-1.5 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-xs font-medium">
                                            Kirim Email
                                        </a>
                                    @else
                                        <a href="/send-mail/{{ $voter->email }}"
                                            class="px-3 py-1.5 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200 transition-colors text-xs font-medium">
                                            Kirim Ulang
                                        </a>
                                    @endif
                                    <button
                                        class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors text-xs font-medium">
                                        Detail
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Pemilih</h3>
                                <p class="text-gray-500">Data pemilih akan muncul di sini</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function handleFileSelect(event) {
            const file = event.target.files[0];

            if (file) {
                // Validate file type
                const validTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-excel'
                ];
                if (!validTypes.includes(file.type)) {
                    alert('❌ File harus berformat Excel (.xlsx atau .xls)');
                    event.target.value = '';
                    return;
                }

                // Validate file size (max 5MB)
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                if (file.size > maxSize) {
                    alert('❌ Ukuran file maksimal 5MB');
                    event.target.value = '';
                    return;
                }

                // Show loading modal
                document.getElementById('loadingModal').classList.remove('hidden');

                // Auto submit form
                document.getElementById('importForm').submit();
            }
        }

        // Hide loading modal if page is loaded (in case of error)
        window.addEventListener('load', function() {
            document.getElementById('loadingModal').classList.add('hidden');
        });
    </script>
@endsection
