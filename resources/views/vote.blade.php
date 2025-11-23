@extends('layouts.app')

@section('title', 'Voting Ketua ASSETS')

@section('content')

    <div class="max-w-6xl mx-auto px-4 py-12">
        <!-- Voter Info -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 animate-scaleIn border-2 border-purple-100">
            <div class="flex items-center gap-4">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                    {{ substr($voter->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $voter->name }}</h2>
                    <p class="text-gray-600">{{ $voter->nim }} • {{ $voter->email }}</p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                        ✓ Terverifikasi
                    </span>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-blue-200 rounded-2xl p-6 mb-8 animate-fadeInUp"
            style="animation-delay: 0.1s">
            <div class="flex items-start gap-4">
                <div class="text-4xl">ℹ️</div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Petunjuk Voting</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center gap-2">
                            <span class="text-purple-600">•</span>
                            Pilih <strong>SATU</strong> kandidat dengan mengklik kartu kandidat
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-purple-600">•</span>
                            Klik <strong>"Lihat Detail"</strong> untuk melihat visi, misi, dan CV kandidat
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-purple-600">•</span>
                            Klik tombol <strong>"Vote Sekarang"</strong> untuk mengonfirmasi pilihan
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-purple-600">•</span>
                            Suara yang sudah diberikan <strong>TIDAK DAPAT</strong> diubah
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Candidates Grid -->
        <form id="votingForm" action="{{ route('vote.submit', $voter->code) }}" method="POST">
            @csrf
            <input type="hidden" name="voted_id" id="selectedCandidate" value="">

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center gradient-text">Daftar Kandidat</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($candidates as $index => $candidate)
                        <div class="card-candidate bg-white rounded-2xl shadow-xl overflow-hidden cursor-pointer border-4 border-transparent hover:border-purple-200 animate-fadeInUp"
                            style="animation-delay: {{ $index * 0.1 }}s"
                            onclick="selectCandidate({{ $candidate->id }}, this)">

                            <!-- Candidate Image -->
                            <div class="relative h-64 bg-gradient-to-br from-purple-400 to-blue-500 overflow-hidden">
                                @if ($candidate->avatar)
                                    <img src="{{ $candidate->avatar }}" alt="{{ $candidate->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-white text-6xl font-bold">
                                        {{ substr($candidate->name, 0, 1) }}
                                    </div>
                                @endif

                                <!-- Selected Indicator -->
                                <div
                                    class="selected-indicator hidden absolute inset-0 bg-purple-600 bg-opacity-90 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <svg class="w-20 h-20 mx-auto mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="text-xl font-bold">TERPILIH</p>
                                    </div>
                                </div>

                                <!-- Number Badge -->
                                <div
                                    class="absolute top-4 right-4 w-12 h-12 bg-white rounded-full flex items-center justify-center text-purple-600 font-bold text-xl shadow-lg">
                                    {{ $index + 1 }}
                                </div>
                            </div>

                            <!-- Candidate Info -->
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $candidate->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ $candidate->nim }}</p>

                                <!-- Vision Preview -->
                                <div class="mb-4">
                                    <p class="text-sm font-semibold text-purple-600 mb-1">VISI</p>
                                    <p class="text-gray-700 text-sm line-clamp-3">{{ $candidate->vision }}</p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-2">
                                    <button type="button"
                                        onclick="event.stopPropagation(); showDetail({{ $candidate->id }})"
                                        class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm">
                                        📋 Lihat Detail
                                    </button>
                                    <button type="button"
                                        class="select-btn flex-1 px-4 py-2 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200 transition-colors font-bold text-sm">
                                        ✓ Pilih
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center animate-fadeInUp" style="animation-delay: 0.5s">
                <button type="submit" id="submitBtn" disabled
                    class="px-12 py-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-full text-xl font-bold shadow-2xl hover:shadow-purple-500/50 transform hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                    🗳️ Vote Sekarang
                </button>
                <p class="text-sm text-gray-500 mt-4" id="submitHint">Silakan pilih kandidat terlebih dahulu</p>
            </div>
        </form>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4"
        onclick="closeDetail(event)">
        <div class="bg-white rounded-3xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl animate-scaleIn"
            onclick="event.stopPropagation()">
            <div id="modalContent"></div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-8 shadow-2xl animate-scaleIn text-center">
            <div class="text-6xl mb-4">⚠️</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Konfirmasi Pilihan Anda</h3>
            <p class="text-gray-600 mb-6">Anda yakin ingin memilih kandidat ini? <strong>Pilihan tidak dapat diubah
                    setelah dikonfirmasi.</strong></p>
            <div class="flex gap-3">
                <button type="button" onclick="closeConfirm()"
                    class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="button" onclick="confirmVote()"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl font-bold hover:shadow-lg transition-all">
                    Ya, Vote!
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let selectedCandidateId = null;
        const candidates = @json($candidates);

        function selectCandidate(id, element) {
            // Remove previous selection
            document.querySelectorAll('.card-candidate').forEach(card => {
                card.classList.remove('selected', 'border-purple-600');
                card.querySelector('.selected-indicator').classList.add('hidden');
            });

            // Add selection
            selectedCandidateId = id;
            element.classList.add('selected', 'border-purple-600');
            element.querySelector('.selected-indicator').classList.remove('hidden');

            // Enable submit button
            document.getElementById('selectedCandidate').value = id;
            document.getElementById('submitBtn').disabled = false;
            document.getElementById('submitHint').textContent = 'Klik tombol "Vote Sekarang" untuk mengonfirmasi';
            document.getElementById('submitHint').classList.add('text-green-600', 'font-semibold');
        }

        function showDetail(id) {
            const candidate = candidates.find(c => c.id === id);

            const content = `
                <div class="gradient-bg text-white p-8 rounded-t-3xl">
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 bg-white rounded-full overflow-hidden border-4 border-white shadow-xl">
                            ${candidate.avatar 
                                ? `<img src="${candidate.avatar}" alt="${candidate.name}" class="w-full h-full object-cover">`
                                : `<div class="w-full h-full flex items-center justify-center text-purple-600 text-3xl font-bold">${candidate.name.charAt(0)}</div>`
                            }
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold mb-1 text-black">${candidate.name}</h3>
                            <p class="text-purple-600">${candidate.nim}</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <!-- Vision -->
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-purple-600 mb-3 flex items-center gap-2">
                            <span>🎯</span> VISI
                        </h4>
                        <p class="text-gray-700 leading-relaxed bg-purple-50 p-4 rounded-xl">${candidate.vision}</p>
                    </div>

                    <!-- Mission -->
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-purple-600 mb-3 flex items-center gap-2">
                            <span>🚀</span> MISI
                        </h4>
                        <ul class="space-y-3">
                                                        <li class="flex items-start gap-3 bg-blue-50 p-4 rounded-xl">
                                                            <span class="flex-shrink-0 w-6 h-6 bg-gradient-to-br from-purple-600 to-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold"></span>
                                                            <p class="text-gray-700 whitespace-pre-line">${candidate.mission}</p>
                                                        </li>
                        </ul>
                    </div>

                    <!-- CV Download -->
                    ${candidate.cv ? `
                                                                                                                                                                                                                                                <div class="mb-6">
                                                                                                                                                                                                                                                    <a href="${candidate.cv}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl font-bold hover:shadow-lg transition-all">
                                                                                                                                                                                                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                                                                                                                                                                                                                        </svg>
                                                                                                                                                                                                                                                        Download CV / Portfolio
                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                            ` : ''}

                    <button onclick="closeDetail()" class="w-full px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition-colors">
                        Tutup
                    </button>
                </div>
            `;

            document.getElementById('modalContent').innerHTML = content;
            document.getElementById('detailModal').classList.remove('hidden');
            document.getElementById('detailModal').classList.add('flex');
        }

        function closeDetail(event) {
            if (event && event.target.id !== 'detailModal') return;
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        }

        document.getElementById('votingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('confirmModal').classList.add('flex');
        });

        function closeConfirm() {
            document.getElementById('confirmModal').classList.add('hidden');
            document.getElementById('confirmModal').classList.remove('flex');
        }

        function confirmVote() {
            document.getElementById('votingForm').submit();
        }
    </script>
@endsection
