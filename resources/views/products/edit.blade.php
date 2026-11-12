@extends('layouts.app')

@section('title', 'Edit Barang')
@section('crumb', 'products / edit')

@section('content')

<div class="page-head">
    <div>
        <div class="eyebrow">// Inventaris / Produk</div>
        <h1 class="page-title">Edit Barang</h1>
        <p class="page-desc">Perbarui informasi barang inventaris.</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn-x ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="panel" style="max-width:860px;">
    <div class="panel-head">
        <span class="panel-title">
            <span class="bracket">[</span> Form Edit &mdash; {{ $product->name }} <span class="bracket">]</span>
        </span>
        <span class="chip"><i class="bi bi-hash"></i>ID {{ $product->id }}</span>
    </div>
    <div class="panel-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="field">
                    <label>Nama Barang <span class="req">*</span></label>
                    <input type="text" name="name"
                           class="input @error('name') invalid @enderror"
                           value="{{ old('name', $product->name) }}">
                    @error('name')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Kategori Barang <span class="req">*</span></label>
                    <select name="category_id"
                            class="select @error('category_id') invalid @enderror">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(old('category_id', $product->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Jumlah Stok <span class="req">*</span></label>
                    <input type="number" name="stock" min="0"
                           class="input @error('stock') invalid @enderror"
                           value="{{ old('stock', $product->stock) }}">
                    @error('stock')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Harga Barang <span class="req">*</span></label>
                    <input type="number" name="price" min="0" step="0.01"
                           class="input @error('price') invalid @enderror"
                           value="{{ old('price', $product->price) }}">
                    @error('price')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Tanggal Masuk <span class="req">*</span></label>
                    <input type="date" name="entry_date"
                           class="input @error('entry_date') invalid @enderror"
                           value="{{ old('entry_date', $product->entry_date->format('Y-m-d')) }}">
                    @error('entry_date')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="sep">

            <div class="form-foot">
                <button type="submit" class="btn-x primary">
                    <i class="bi bi-save"></i> Update Barang
                </button>
                <a href="{{ route('products.index') }}" class="btn-x ghost">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
