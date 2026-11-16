<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $activeExercise->nama ?? 'Exercise' }} - HIDUP SEHAT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FFFFFF; }
    </style>
</head>
<body class="text-slate-800 flex flex-col min-h-screen" data-durasi="{{ $activeExercise->durasi_detik ?? 60 }}">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-100 sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('exercise.index') }}" class="font-extrabold text-[#1B8736] tracking-wide text-base">
                HIDUP SEHAT
            </a>

            <div class="hidden md:flex items-center gap-8 text-xs font-medium text-slate-500">
                <a href="#" class="hover:text-[#1B8736] transition">Dashboard</a>
                <a href="#" class="hover:text-[#1B8736] transition">Activities</a>
                <a href="{{ route('exercise.index') }}" class="text-[#1B8736] font-bold border-b-2 border-[#1B8736] py-5">Exercise</a>
                <a href="#" class="hover:text-[#1B8736] transition">Weather</a>
                <a href="{{ route('kegiatan.index') }}" class="hover:text-[#1B8736] transition">Schedule</a>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" onclick="openCreateModal()"
                    class="bg-[#1B8736] hover:bg-[#156d2b] text-white text-xs font-bold px-3.5 py-2 rounded-lg transition">
                    + Tambah Exercise
                </button>
                <div class="w-8 h-8 rounded-full bg-slate-800 text-white flex items-center justify-center text-xs font-bold">
                    MQ
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-6xl w-full mx-auto px-6 py-8 flex-grow">

        @if(session('success'))
            <div class="mb-6 bg-[#E8F5E9] border border-[#A5D6A7] text-[#1B8736] px-4 py-3 rounded-xl text-xs font-semibold flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="font-bold text-base">&times;</button>
            </div>
        @endif

        @if($activeExercise)
            <!-- Top Bar: Breadcrumb + Edit/Delete Action -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
                <a href="{{ route('kegiatan.index') }}" class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-500 hover:text-[#1B8736] transition">
                    <span>&larr;</span>
                    <span>{{ $activeExercise->kategori }}</span>
                </a>

                <div class="flex items-center gap-2">
                    <button type="button" onclick="openEditModal()"
                        class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50 transition">
                        Edit Exercise
                    </button>
                    <form action="{{ route('exercise.destroy', $activeExercise->id) }}" method="POST" onsubmit="return confirm('Hapus gerakan ini?')">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-100 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

            <!-- Two Column Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Left Column (7 cols) -->
                <div class="lg:col-span-7 space-y-5">
                    <div class="w-full h-72 sm:h-80 rounded-xl overflow-hidden border border-slate-200 bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=1000&q=80"
                             alt="{{ $activeExercise->nama }}"
                             class="w-full h-full object-cover">
                    </div>

                    <div class="space-y-2.5">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $activeExercise->nama }}</h1>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-2xl">
                            {{ $activeExercise->deskripsi }}
                        </p>
                    </div>

                    <!-- Badges -->
                    <div class="flex flex-wrap items-center gap-2.5 pt-1">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-600 border border-blue-200">
                            ⚡ {{ $activeExercise->intensitas }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-red-50 text-red-600 border border-red-200">
                            ⏱ {{ $activeExercise->durasi_detik }} Seconds
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-sky-50 text-sky-700 border border-sky-200">
                            🏋 {{ $activeExercise->tipe }}
                        </span>
                    </div>
                </div>

                <!-- Right Column (5 cols) -->
                <div class="lg:col-span-5 space-y-5">
                    <!-- Metrics Card -->
                    <div class="bg-[#F2FBF5] border border-[#D3EEDB] rounded-xl p-5 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">EST. BURN</p>
                                <p class="text-2xl font-extrabold text-slate-900">{{ $activeExercise->est_burn }} <span class="text-xs font-medium text-slate-500">kcal/min</span></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">HEART RATE</p>
                                <p class="text-2xl font-extrabold text-slate-900">{{ $activeExercise->heart_rate }} <span class="text-xs font-medium text-slate-500">bpm</span></p>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <div class="flex justify-between items-center text-[10px] font-bold">
                                <span class="text-slate-600 uppercase tracking-wider">CARDIO LOAD</span>
                                <span class="text-slate-900">{{ $activeExercise->cardio_load }}%</span>
                            </div>
                            <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                <div id="cardioBar" data-load="{{ $activeExercise->cardio_load }}" class="h-full bg-[#1B8736] rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Movement Logic -->
                    <div class="space-y-2.5">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">MOVEMENT LOGIC</p>

                        <div class="border border-slate-200 rounded-lg p-3.5 flex items-start gap-3.5 bg-white">
                            <span class="text-xs font-extrabold text-slate-400 mt-0.5">01</span>
                            <div>
                                <h3 class="text-xs font-bold text-slate-900">The Neutral Stance</h3>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">Stand with feet together and arms at your sides, core engaged.</p>
                            </div>
                        </div>

                        <div class="border border-slate-200 rounded-lg p-3.5 flex items-start gap-3.5 bg-white">
                            <span class="text-xs font-extrabold text-slate-400 mt-0.5">02</span>
                            <div>
                                <h3 class="text-xs font-bold text-slate-900">The Expansion</h3>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">Jump up and spread your feet beyond shoulder-width apart while bringing your arms above your head.</p>
                            </div>
                        </div>

                        <div class="border border-slate-200 rounded-lg p-3.5 flex items-start gap-3.5 bg-white">
                            <span class="text-xs font-extrabold text-slate-400 mt-0.5">03</span>
                            <div>
                                <h3 class="text-xs font-bold text-slate-900">The Return</h3>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">Jump again and return your feet to the center and your arms back down to your sides.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Start Button -->
                    <div class="space-y-2 pt-1">
                        <button type="button" id="startExerciseBtn" onclick="toggleExerciseTimer()"
                            class="w-full bg-[#1B8736] hover:bg-[#156d2b] text-white font-bold text-xs tracking-wider uppercase py-3.5 px-6 rounded-lg shadow-sm transition flex items-center justify-center gap-2">
                            <span id="btnText">START EXERCISE</span>
                            <span>&#9654;</span>
                        </button>
                        <p class="text-center text-[11px] text-slate-500">Ensure you have 2 meters of clearance space.</p>
                    </div>
                </div>
            </div>

            <hr class="border-slate-100 my-10">

            <!-- Target Muscle Groups -->
            <section class="space-y-4">
                <h2 class="text-sm font-extrabold text-slate-900">Target Muscle Groups</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-[#82D694] border border-[#1B8736] rounded-lg py-4 px-5 text-center">
                        <p class="text-[9px] font-bold uppercase tracking-widest text-slate-800">PRIMARY</p>
                        <p class="text-xs font-extrabold text-slate-900 mt-1">{{ $activeExercise->primary_muscle }}</p>
                    </div>

                    @foreach(explode(',', $activeExercise->secondary_muscles) as $muscle)
                        <div class="bg-white border border-slate-300 rounded-lg py-4 px-5 text-center">
                            <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400">SECONDARY</p>
                            <p class="text-xs font-extrabold text-slate-900 mt-1">{{ trim($muscle) }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Daftar Semua Gerakan Exercise (Read List) -->
        <section class="mt-12 pt-8 border-t border-slate-100 space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-sm font-extrabold text-slate-900">Daftar Gerakan Exercise Tersimpan</h2>
                <span class="text-xs text-slate-400">Klik kartu untuk melihat detail gerakan</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($exercises as $item)
                    <a href="{{ route('exercise.index', ['id' => $item->id]) }}"
                       class="block p-4 rounded-xl border transition {{ $activeExercise && $activeExercise->id === $item->id ? 'bg-[#F2FBF5] border-[#1B8736]' : 'bg-white border-slate-200 hover:border-slate-300' }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">{{ $item->kategori }}</p>
                                <h3 class="text-sm font-extrabold text-slate-900 mt-0.5">{{ $item->nama }}</h3>
                            </div>
                            <span class="text-[11px] font-bold text-[#1B8736] bg-[#E8F5E9] px-2.5 py-0.5 rounded-full">
                                {{ $item->durasi_detik }}s
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-2">
                            Burn: <strong>{{ $item->est_burn }} kcal/min</strong> • Primary: <strong>{{ $item->primary_muscle }}</strong>
                        </p>
                    </a>
                @endforeach
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-200 mt-12">
        <div class="max-w-6xl mx-auto px-6 py-6 flex flex-col sm:flex-row justify-between items-center text-[11px] text-slate-500 gap-3">
            <div class="font-extrabold text-slate-900 tracking-wide">HIDUP SEHAT</div>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-slate-800">Privacy Policy</a>
                <a href="#" class="hover:text-slate-800">Terms of Service</a>
                <a href="#" class="hover:text-slate-800">Contact Us</a>
            </div>
            <div>© 2024 HIDUP SEHAT. All rights reserved.</div>
        </div>
    </footer>

    <!-- Modal Tambah Exercise (CREATE - Simpel) -->
    <div id="createModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl space-y-4">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="font-bold text-sm text-slate-900">Tambah Gerakan Baru</h3>
                <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-slate-700 font-bold text-lg">&times;</button>
            </div>
            <form action="{{ route('exercise.store') }}" method="POST" class="space-y-3 text-xs">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div>
                    <label class="font-bold text-slate-600">Nama Gerakan</label>
                    <input type="text" name="nama" placeholder="Contoh: Squat Jump" required class="w-full mt-1 border rounded-lg px-3 py-2">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="font-bold text-slate-600">Kategori</label>
                        <input type="text" name="kategori" value="CARDIO" required class="w-full mt-1 border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="font-bold text-slate-600">Durasi (Detik)</label>
                        <input type="number" name="durasi_detik" value="60" required class="w-full mt-1 border rounded-lg px-3 py-2">
                    </div>
                </div>
                <div>
                    <label class="font-bold text-slate-600">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" required placeholder="Jelaskan cara gerakannya..." class="w-full mt-1 border rounded-lg px-3 py-2"></textarea>
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-lg border text-slate-600 font-semibold">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-[#1B8736] text-white font-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Exercise (UPDATE - Simpel) -->
    @if($activeExercise)
    <div id="editModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl space-y-4">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="font-bold text-sm text-slate-900">Edit Gerakan</h3>
                <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-700 font-bold text-lg">&times;</button>
            </div>
            <form action="{{ route('exercise.update', $activeExercise->id) }}" method="POST" class="space-y-3 text-xs">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <div>
                    <label class="font-bold text-slate-600">Nama Gerakan</label>
                    <input type="text" name="nama" value="{{ $activeExercise->nama }}" required class="w-full mt-1 border rounded-lg px-3 py-2">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="font-bold text-slate-600">Kategori</label>
                        <input type="text" name="kategori" value="{{ $activeExercise->kategori }}" required class="w-full mt-1 border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="font-bold text-slate-600">Durasi (Detik)</label>
                        <input type="number" name="durasi_detik" value="{{ $activeExercise->durasi_detik }}" required class="w-full mt-1 border rounded-lg px-3 py-2">
                    </div>
                </div>
                <div>
                    <label class="font-bold text-slate-600">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" required class="w-full mt-1 border rounded-lg px-3 py-2">{{ $activeExercise->deskripsi }}</textarea>
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-lg border text-slate-600 font-semibold">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-[#1B8736] text-white font-bold">Update</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <script>
        const defaultDurasi = Number(document.body.dataset.durasi || 60);
        let timerInterval = null;
        let secondsLeft = defaultDurasi;
        let isRunning = false;

        const cardioBar = document.getElementById('cardioBar');
        if (cardioBar) {
            cardioBar.style.width = (cardioBar.dataset.load || 0) + '%';
        }

        function toggleExerciseTimer() {
            const btn = document.getElementById('startExerciseBtn');
            const btnText = document.getElementById('btnText');

            if (!isRunning) {
                isRunning = true;
                btn.classList.replace('bg-[#1B8736]', 'bg-amber-600');
                btnText.innerText = `IN PROGRESS (${secondsLeft}s) - PAUSE`;

                timerInterval = setInterval(() => {
                    secondsLeft--;
                    if (secondsLeft > 0) {
                        btnText.innerText = `IN PROGRESS (${secondsLeft}s) - PAUSE`;
                    } else {
                        clearInterval(timerInterval);
                        isRunning = false;
                        secondsLeft = defaultDurasi;
                        btn.classList.replace('bg-amber-600', 'bg-[#1B8736]');
                        btnText.innerText = 'COMPLETED! START AGAIN';
                    }
                }, 1000);
            } else {
                clearInterval(timerInterval);
                isRunning = false;
                btn.classList.replace('bg-amber-600', 'bg-[#1B8736]');
                btnText.innerText = `RESUME EXERCISE (${secondsLeft}s)`;
            }
        }

        function openCreateModal() { document.getElementById('createModal').classList.remove('hidden'); }
        function closeCreateModal() { document.getElementById('createModal').classList.add('hidden'); }
        function openEditModal() { document.getElementById('editModal').classList.remove('hidden'); }
        function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }
    </script>
</body>
</html>