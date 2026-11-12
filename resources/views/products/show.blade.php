@extends('layouts.app')

@section('title', 'Detail Barang')
@section('crumb', 'products / detail')

@section('content')

<div class="page-head">
    <div>
        <div class="eyebrow">// Inventaris / Produk</div>
        <h1 class="page-title">Detail Barang</h1>
        <p class="page-desc">Informasi lengkap barang inventaris.</p>
    </div>
    <div class="row-actions">
        <a href="{{ route('products.edit', $product->id) }}" class="btn-x primary">
            <i class="bi bi-pencil"></i> Edit Barang
        </a>
        <a href="{{ route('products.index') }}" class="btn-x ghost">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="panel" style="max-width:860px;">
    <div class="panel-head">
        <span class="panel-title">
            <span class="bracket">[</span> {{ $product->name }} <span class="bracket">]</span>
        </span>
        <span class="chip"><i class="bi bi-hash"></i>ID {{ $product->id }}</span>
    </div>

    <div class="table-wrap">
        <dl class="detail-grid" style="margin:0;">
            <div class="detail-item">
                <dt>Nama Barang</dt>
                <dd>{{ $product->name }}</dd>
            </div>
            <div class="detail-item">
                <dt>Kategori</dt>
                <dd><span class="chip"><i class="bi bi-tag"></i>{{ $product->category->name }}</span></dd>
            </div>
            <div class="detail-item">
                <dt>Jumlah Stok</dt>
                <dd>
                    @if ($product->stock > 10)
                        <span class="chip ok">{{ $product->stock }} unit</span>
                    @elseif ($product->stock > 0)
                        <span class="chip low">{{ $product->stock }} unit</span>
                    @else
                        <span class="chip out">habis</span>
                    @endif
                </dd>
            </div>
            <div class="detail-item">
                <dt>Harga Barang</dt>
                <dd>Rp {{ number_format($product->price, 0, ',', '.') }}</dd>
            </div>
            <div class="detail-item">
                <dt>Tanggal Masuk</dt>
                <dd>{{ $product->entry_date->format('d-m-Y') }}</dd>
            </div>
            <div class="detail-item">
                <dt>Terakhir Diperbarui</dt>
                <dd class="dim">{{ $product->updated_at->format('d-m-Y H:i') }}</dd>
            </div>
        </dl>
    </div>
</div>

@endsection
