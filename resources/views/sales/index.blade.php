<x-app-layout>
    <div class="container my-5">
        <!-- Judul Halaman -->
        <h1 class="text-center mb-4 fw-bold text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
            Rekap Penjualan
        </h1>

        <!-- Tabel Rekap Penjualan -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center align-middle shadow-sm">
                <thead class="thead-dark bg-primary text-white">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Tanggal Terjual</th>
                    </tr>
                </thead>
                <tbody class="bg-light">
                    @forelse ($penjualans as $penjualan)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $penjualan->merek }}</td>
                            <td>{{ $penjualan->tahun }}</td>
                            <td class="text-success fw-bold">Rp {{ number_format($penjualan->harga, 0, ',', '.') }}</td>
                            <td>{{ $penjualan->tanggal_terjual }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                <em>Tidak ada data penjualan tersedia</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #2c3e50; /* Warna background halaman */
        }
        h1 {
            font-size: 2.5rem;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f0f8ff; /* Hover effect */
        }
    </style>
</x-app-layout>
