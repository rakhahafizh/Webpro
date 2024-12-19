<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center display-4 fw-bold mb-4">Edit Mobil</h1>

        <!-- Tombol Kembali -->
        <div class="mb-3">
            <a href="{{ route('mobils.index') }}" class="btn btn-secondary">&larr; Kembali</a>
        </div>

        <!-- Form Edit -->
        <form action="{{ route('mobils.update', $mobil->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
            @csrf
            @method('PUT')

            <!-- Input Nama Mobil -->
            <div class="mb-3">
                <label for="nama_mobil" class="form-label">Nama Mobil</label>
                <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="{{ $mobil->nama_mobil }}" required>
            </div>

            <!-- Input Merek -->
            <div class="mb-3">
                <label for="merek" class="form-label">Merek</label>
                <input type="text" class="form-control" id="merek" name="merek" value="{{ $mobil->merek }}" required>
            </div>

            <!-- Input Tahun -->
            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $mobil->tahun }}" required>
            </div>

            <!-- Input Harga -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ $mobil->harga }}" required>
            </div>

            <!-- Input Gambar Baru -->
            <div class="mb-3">
                <label for="gambar" class="form-label">Tambah Gambar Baru (Multiple)</label>
                <input type="file" class="form-control" id="gambar" name="gambar[]" multiple>
                <small class="text-muted">Pilih lebih dari satu gambar jika diperlukan.</small>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-app-layout>