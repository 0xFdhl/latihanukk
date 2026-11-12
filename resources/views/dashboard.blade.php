@extends('layouts.app')

@section('title', 'Dashboard')
@section('crumb', 'dashboard')

@section('content')

<div class="page-head">
    <div>
        <div class="eyebrow">// Selamat datang kembali</div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-desc">Ringkasan inventaris barang gudang &mdash; {{ date('d M Y') }}.</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn-x primary">
        <i class="bi bi-plus-lg"></i> Tambah Barang
    </a>
</div>

<!-- STATISTIK -->
<div class="stats-grid">
    <div class="stat">
        <span class="stat-idx">01</span>
        <div class="stat-label">Total Barang</div>
        <div class="stat-value">{{ $totalProducts }}</div>
        <div class="stat-foot"><i class="bi bi-box-seam"></i> item terdaftar</div>
    </div>
    <div class="stat">
        <span class="stat-idx">02</span>
        <div class="stat-label">Total Kategori</div>
        <div class="stat-value">{{ $totalCategories }}</div>
        <div class="stat-foot"><i class="bi bi-tags"></i> kategori aktif</div>
    </div>
    <div class="stat">
        <span class="stat-idx">03</span>
        <div class="stat-label">Total Stok</div>
        <div class="stat-value">{{ number_format($totalStock) }}</div>
        <div class="stat-foot"><i class="bi bi-archive"></i> unit tersimpan</div>
    </div>
    <div class="stat">
        <span class="stat-idx">04</span>
        <div class="stat-label">Nilai Inventaris</div>
        <div class="stat-value" style="font-size:19px;">
            Rp {{ number_format($totalValue, 0, ',', '.') }}
        </div>
        <div class="stat-foot"><i class="bi bi-cash-stack"></i> estimasi aset</div>
    </div>
</div>

<!-- PRODUK TERBARU -->
<div class="panel">
    <div class="panel-head">
        <span class="panel-title"><span class="bracket">[</span> Barang Terbaru <span class="bracket">]</span></span>
        <a href="{{ route('products.index') }}" class="btn-x ghost sm">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="panel-body flush">
        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestProducts as $product)
                        <tr>
                            <td class="mono-dim">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="strong">{{ $product->name }}</td>
                            <td><span class="chip"><i class="bi bi-tag"></i>{{ $product->category->name }}</span></td>
                            <td class="num">{{ $product->stock }}</td>
                            <td class="num">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding:0;">
                                <div class="empty">
                                    <i class="bi bi-inbox"></i>
                                    <div class="cmd"><span class="prompt">$</span> data barang &mdash; belum ada data.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- STATISTIK KATEGORI -->
<div class="panel">
    <div class="panel-head">
        <span class="panel-title"><span class="bracket">[</span> Jumlah Barang per Kategori <span class="bracket">]</span></span>
    </div>
    <div class="panel-body">
        @forelse($categoryStats as $category)
            <div class="bar-row">
                <div class="bar-meta">
                    <span>{{ $category->name }}</span>
                    <span class="val">{{ $category->products_count }} barang</span>
                </div>
                <div class="bar">
                    <span style="width: {{ $totalProducts > 0 ? round(($category->products_count / $totalProducts) * 100, 1) : 0 }}%;"></span>
                </div>
            </div>
        @empty
            <div class="empty" style="padding:24px;">
                <div class="cmd"><span class="prompt">$</span> belum ada kategori barang.</div>
            </div>
        @endforelse
    </div>
</div>

@endsection
