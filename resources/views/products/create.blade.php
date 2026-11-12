@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('crumb', 'products / create')

@section('content')

<div class="page-head">
    <div>
        <div class="eyebrow">// Inventaris / Produk</div>
        <h1 class="page-title">Tambah Barang</h1>
        <p class="page-desc">Masukkan data barang inventaris baru.</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn-x ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="panel" style="max-width:860px;">
    <div class="panel-head">
        <span class="panel-title"><span class="bracket">[</span> Form Barang Baru <span class="bracket">]</span></span>
    </div>
    <div class="panel-body">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="field">
                    <label>Nama Barang <span class="req">*</span></label>
                    <input type="text" name="name"
                           class="input @error('name') invalid @enderror"
                           placeholder="Contoh: Laptop Asus"
                           value="{{ old('name') }}">
                    @error('name')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Kategori Barang <span class="req">*</span></label>
                    <select name="category_id"
                            class="select @error('category_id') invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(old('category_id') == $category->id)>
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
                           placeholder="Masukkan jumlah stok"
                           value="{{ old('stock') }}">
                    @error('stock')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Harga Barang <span class="req">*</span></label>
                    <input type="number" name="price" min="0" step="0.01"
                           class="input @error('price') invalid @enderror"
                           placeholder="Masukkan harga barang"
                           value="{{ old('price') }}">
                    @error('price')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Tanggal Masuk <span class="req">*</span></label>
                    <input type="date" name="entry_date"
                           class="input @error('entry_date') invalid @enderror"
                           value="{{ old('entry_date') }}">
                    @error('entry_date')
                        <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="sep">

            <div class="form-foot">
                <button type="submit" class="btn-x primary">
                    <i class="bi bi-save"></i> Simpan Barang
                </button>
                <a href="{{ route('products.index') }}" class="btn-x ghost">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
