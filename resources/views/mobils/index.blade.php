<x-app-layout>
    <!-- Background full-page -->
    <div style="background: url('{{ asset('storage/images/background.jpg') }}') no-repeat center center fixed; 
                background-size: cover; min-height: 100vh;">
        
        <!-- Container utama -->
        <div class="container py-5">
            <!-- Judul Halaman -->
            <h1 class="text-center display-3 fw-bold text-white mb-5" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
                Daftar Mobil
            </h1>

            <!-- Search Bar -->
            <div class="row mb-4 justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('mobils.index') }}" method="GET" class="position-relative">
                        <div class="input-group">
                            <!-- Input Box -->
                            <input type="text" name="search" class="form-control rounded-start-pill ps-4" 
                                placeholder="Cari mobil berdasarkan nama atau merek..." 
                                value="{{ request('search') }}"
                                style="height: 50px; font-size: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
                                       border: none; color: #495057;">
                            <!-- Tombol Search -->
                            <button type="submit" 
                                    class="btn btn-success rounded-end-pill px-4" 
                                    style="height: 50px;">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tombol Tambah Mobil -->
            <div class="text-center mb-4">
                <a href="{{ route('mobils.create') }}" class="btn btn-success btn-lg rounded-pill">Tambah Mobil</a>
            </div>

            <!-- Grid Card Mobil -->
            <div class="row g-4 justify-content-center">
                @forelse($mobils as $mobil)
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="card shadow-lg border-0 hover-card" style="width: 24rem; background: rgba(255, 255, 255, 0.9);">
                            <!-- Carousel Gambar -->
                                <div id="carousel-{{ $mobil->id }}" class="carousel slide" data-ride="carousel">
                                    <!-- Indicator -->
                                    <ol class="carousel-indicators">
                                        @php
                                            $gambar = $mobil->gambar ? json_decode($mobil->gambar) : [];
                                        @endphp
                                        @foreach($gambar as $index => $img)
                                            <li data-target="#carousel-{{ $mobil->id }}" 
                                                data-slide-to="{{ $index }}" 
                                                class="{{ $index == 0 ? 'active' : '' }}"></li>
                                        @endforeach
                                    </ol>

                                    <!-- Gambar -->
                                    <div class="carousel-inner">
                                        @if (!empty($gambar) && is_array($gambar))
                                            @foreach($gambar as $index => $img)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $img) }}" 
                                                        class="d-block w-100 rounded-top" 
                                                        style="height: 250px; object-fit: cover;" 
                                                        alt="Gambar {{ $mobil->nama_mobil }}">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="carousel-item active">
                                                <img src="https://via.placeholder.com/400x250" 
                                                    class="d-block w-100 rounded-top" alt="Placeholder">
                                            </div>
                                        @endif
                                    </div>

                                <!-- Tombol Next dan Prev -->
                                <a class="carousel-control-prev" href="#carousel-{{ $mobil->id }}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-{{ $mobil->id }}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>


                            <!-- Informasi Mobil -->
                            <div class="card-body text-center">
                                <h4 class="card-title fw-bold">{{ $mobil->nama_mobil }}</h4>
                                <p class="card-text mb-2">
                                    <strong>Merek:</strong> {{ $mobil->merek }}<br>
                                    <strong>Tahun:</strong> {{ $mobil->tahun }}<br>
                                    <strong class="text-danger">Harga: Rp {{ number_format($mobil->harga, 0, ',', '.') }}</strong>
                                </p>
                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    <form action="{{ route('mobils.beli', $mobil->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">Beli Sekarang</button>
                                    </form>
                                    <a href="{{ route('mobils.edit', $mobil->id) }}" class="btn btn-warning btn-sm rounded-pill px-3">Edit</a>
                                    <form action="{{ route('mobils.destroy', $mobil->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted fs-4">Tidak ada data mobil tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .hover-card {   
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
</x-app-layout>
