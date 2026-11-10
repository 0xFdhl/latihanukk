
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h4 class="content-title">Dashboard</h4>
    <p class="text-muted">
        Selamat datang di Sistem Manajemen Inventaris Barang.
    </p>
</div>

<!-- STATISTIK -->
<div class="row g-4">

    <div class="col-xl-3 col-md-6">
        <div class="card p-4">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-2">Total Barang</p>
                    <h3>{{ $totalProducts }}</h3>
                </div>
                <i class="bi bi-box-seam fs-1 text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card p-4">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-2">Total Kategori</p>
                    <h3>{{ $totalCategories }}</h3>
                </div>
                <i class="bi bi-tags fs-1 text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card p-4">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-2">Total Stok</p>
                    <h3>{{ number_format($totalStock) }}</h3>
                </div>
                <i class="bi bi-archive fs-1 text-warning"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card p-4">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-2">Nilai Inventaris</p>
                    <h5>Rp {{ number_format($totalValue, 0, ',', '.') }}</h5>
                </div>
                <i class="bi bi-cash-stack fs-1 text-danger"></i>
            </div>
        </div>
    </div>

</div>


<!-- PRODUK TERBARU -->
<div class="card p-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="mb-0">Barang Terbaru</h5>

        <a href="{{ route('products.index') }}"
           class="btn btn-primary btn-sm">
            Lihat Semua
            <i class="bi bi-arrow-right"></i>
        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-hover">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                </tr>
            </thead>

            <tbody>

                @forelse($latestProducts as $product)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Belum ada data barang.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- STATISTIK KATEGORI -->
<div class="card p-4 mt-4">

    <h5 class="mb-4">Jumlah Barang per Kategori</h5>

    @forelse($categoryStats as $category)

        <div class="mb-3">

            <div class="d-flex justify-content-between mb-2">
                <span>{{ $category->name }}</span>
                <strong>{{ $category->products_count }} Barang</strong>
            </div>

            <div class="progress" style="height: 10px;">

                <div class="progress-bar bg-primary"
                     style="width: {{ $totalProducts > 0 ? ($category->products_count / $totalProducts) * 100 : 0 }}%">
                </div>

            </div>

        </div>

    @empty

        <p class="text-muted">
            Belum ada kategori barang.
        </p>

    @endforelse

</div>

@endsection
