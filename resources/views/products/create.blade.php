
@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')

<div class="mb-4">
    <h4 class="content-title">Tambah Barang</h4>
    <p class="text-muted">Masukkan data barang inventaris baru.</p>
</div>

<div class="card p-4">

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Contoh: Laptop Asus"
                    value="{{ old('name') }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Kategori Barang</label>

                <select name="category_id"
                    class="form-select @error('category_id') is-invalid @enderror">

                    <option value="">-- Pilih Kategori --</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jumlah Stok</label>

                <input type="number"
                    name="stock"
                    min="0"
                    class="form-control @error('stock') is-invalid @enderror"
                    placeholder="Masukkan jumlah stok"
                    value="{{ old('stock') }}">

                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Harga Barang</label>

                <input type="number"
                    name="price"
                    min="0"
                    step="0.01"
                    class="form-control @error('price') is-invalid @enderror"
                    placeholder="Masukkan harga barang"
                    value="{{ old('price') }}">

                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Masuk</label>

                <input type="date"
                    name="entry_date"
                    class="form-control @error('entry_date') is-invalid @enderror"
                    value="{{ old('entry_date') }}">

                @error('entry_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <hr>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan Barang
        </button>

        <a href="{{ route('products.index') }}"
            class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection
