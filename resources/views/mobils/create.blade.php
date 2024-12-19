<x-app-layout>
    <div class="container mt-5">
        <!-- Judul Tambah Mobil -->
        <h1 class="text-center display-4 fw-bold mb-4">Tambah Mobil</h1>

        <!-- Tombol Kembali -->
        <div class="mb-3">
            <a href="{{ route('mobils.index') }}" class="btn btn-secondary">
                &larr; Kembali
            </a>
        </div>

        <!-- Form Tambah Mobil -->
        <form action="{{ route('mobils.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
            @csrf
            <!-- Input Nama Mobil -->
            <div class="mb-3">
                <label for="nama_mobil" class="form-label">Nama Mobil</label>
                <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" placeholder="Masukkan nama mobil" required>
            </div>

            <!-- Input Merek -->
            <div class="mb-3">
                <label for="merek" class="form-label">Merek</label>
                <input type="text" class="form-control" id="merek" name="merek" placeholder="Masukkan merek mobil" required>
            </div>

            <!-- Input Tahun -->
            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Masukkan tahun mobil" required>
            </div>

            <!-- Input Harga -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga mobil" required>
            </div>

            <!-- Input Gambar -->
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Mobil (Multiple)</label>
                <input type="file" class="form-control" id="gambar" name="gambar[]" multiple>
                <small class="text-muted">Pilih lebih dari satu gambar jika diperlukan.</small>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Tambah Data Mobil</button>
            </div>
        </form>
    </div>
</x-app-layout>