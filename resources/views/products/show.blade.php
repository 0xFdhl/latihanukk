
@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')

<div class="mb-4">
    <h4 class="content-title">Detail Barang</h4>
    <p class="text-muted">Informasi lengkap barang inventaris.</p>
</div>

<div class="card p-4">

    <h5 class="mb-4">Informasi Barang</h5>

    <div class="row mb-3">

        <div class="col-md-6 mb-3">
            <label class="text-muted">ID Barang</label>
            <h6>{{ $product->id }}</h6>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Nama Barang</label>
            <h6>{{ $product->name }}</h6>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Kategori</label>
            <h6>{{ $product->category->name }}</h6>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Jumlah Stok</label>
            <h6>{{ $product->stock }}</h6>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Harga Barang</label>
            <h6>
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </h6>
        </div>

        <div class="col-md-6 mb-3">
            <label class="text-muted">Tanggal Masuk</label>
            <h6>{{ $product->entry_date->format('d-m-Y') }}</h6>
        </div>

    </div>

    <hr>

    <div>
        <a href="{{ route('products.edit', $product->id) }}"
            class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit Barang
        </a>

        <a href="{{ route('products.index') }}"
            class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>

@endsection
