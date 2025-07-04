<div x-data> {{-- Menggunakan x-data kosong atau yang relevan jika ada Alpine.js --}}
    {{-- Pesan Flash --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <section class="chart-section mt-10 p-6 bg-white rounded-lg shadow-md">
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4 text-center">Statistik Kontak Berdasarkan Status</h2>
            {{-- PENTING: wire:ignore --}}
            <div wire:ignore style="width: 60%; max-width: 500px; margin: auto;">
                <canvas id="contactPieChartLivewire"></canvas>
            </div>
        </div>
    </section>

    <div class="tabel-kontak mt-10 p-6 bg-white shadow-md rounded-lg">
        <h3 class="text-xl font-semibold mb-4">Daftar Pesan Masuk</h3>
        @if($contacts->isEmpty())
            <p class="text-gray-600">Tidak ada pesan masuk.</p>
        @else
        <div class="overflow-x-auto"> {{-- Tambahkan div untuk scroll jika tabel terlalu lebar --}}
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($contacts as $c)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $c->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $c->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $c->message }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $c->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <select wire:change="updateContactStatus({{ $c->id }}, $event.target.value)" class="border rounded p-1 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="new" {{ $c->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="pending" {{ $c->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="resolved" {{ $c->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $c->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <script>
        window.myPieChartInstance = null; // Inisialisasi instance chart global

        function renderChart(data) {
            console.log('Data yang diterima renderChart:', data); // Debugging

            var ctx = document.getElementById('contactPieChartLivewire');
            if (!ctx) {
                console.error("Canvas element 'contactPieChartLivewire' not found.");
                return;
            }

            // Hancurkan chart yang sudah ada sebelum membuat yang baru
            if (window.myPieChartInstance) {
                window.myPieChartInstance.destroy();
            }

            const totalSum = Object.values(data).reduce((sum, current) => sum + current, 0);
            if (Object.keys(data).length === 0 || totalSum === 0) {
                // Jika tidak ada data, ganti canvas dengan pesan
                ctx.parentNode.innerHTML = '<p style="text-align:center; color:gray; padding:20px;">Tidak ada data untuk menampilkan grafik statistik kontak.</p>';
                return;
            } else {
                // Jika sebelumnya ada pesan, pastikan canvas ada kembali
                if (ctx.tagName.toLowerCase() !== 'canvas') {
                    // Cek jika parentNode sudah diganti dengan <p>, kembalikan ke <canvas>
                    const parentDiv = ctx.parentNode;
                    parentDiv.innerHTML = '<canvas id="contactPieChartLivewire"></canvas>';
                    ctx = document.getElementById('contactPieChartLivewire');
                }
            }


            var labels = Object.keys(data);
            var dataValues = Object.values(data);
            var backgroundColors = [
                'rgba(255, 99, 132, 0.7)', // Merah
                'rgba(54, 162, 235, 0.7)', // Biru
                'rgba(255, 206, 86, 0.7)', // Kuning
                'rgba(75, 192, 192, 0.7)', // Hijau Teal
                'rgba(153, 102, 255, 0.7)', // Ungu
                'rgba(255, 159, 64, 0.7)', // Oranye
                'rgba(199, 199, 199, 0.7)', // Abu-abu
                'rgba(83, 102, 255, 0.7)'  // Biru terang
            ];

            window.myPieChartInstance = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataValues,
                        backgroundColor: backgroundColors.slice(0, labels.length),
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', labels: { font: { size: 14 } } },
                        title: {
                            display: true,
                            text: 'Distribusi Kontak Berdasarkan Status',
                            font: { size: 18 }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) { label += ': '; }
                                    const total = context.dataset.data.reduce((sum, current) => sum + current, 0);
                                    const percentage = (context.parsed / total * 100).toFixed(1) + '%';
                                    return label + context.parsed + ' (' + percentage + ')';
                                }
                            }
                        }
                    }
                }
            });
        }

        // Event listener untuk saat Livewire component diinisialisasi
        document.addEventListener('livewire:initialized', () => {
            // Gambar chart pertama kali saat komponen dimuat
            // Pastikan data awal dari komponen Livewire dikirim ke fungsi renderChart
            renderChart(@json($contactStatusData));

            // Dengarkan event 'chartUpdated' dari komponen Livewire
            Livewire.on('chartUpdated', (data) => {
                console.log('Event chartUpdated diterima dengan data:', data);
                // Livewire.dispatch mengirimkan argumen sebagai array,
                // jadi ambil elemen pertama jika hanya ada satu argumen
                renderChart(data[0]);
            });
        });

        // Jika Anda menggunakan Livewire v3+ dengan SPA navigation (Turbo/Alpine),
        // dan chart tidak di-refresh saat navigasi antar halaman Livewire,
        // Anda mungkin perlu event listener ini:
        // document.addEventListener('livewire:navigated', () => {
        //     renderChart(@json($contactStatusData));
        // });
    </script>
</div>