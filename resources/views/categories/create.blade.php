@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('crumb', 'categories / create')

@section('content')

<div class="page-head">
    <div>
        <div class="eyebrow">// Inventaris / Kategori</div>
        <h1 class="page-title">Tambah Kategori</h1>
        <p class="page-desc">Tambahkan kategori barang baru.</p>
    </div>
    <a href="{{ route('categories.index') }}" class="btn-x ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="panel" style="max-width:620px;">
    <div class="panel-head">
        <span class="panel-title"><span class="bracket">[</span> Form Kategori Baru <span class="bracket">]</span></span>
    </div>
    <div class="panel-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="field">
                <label>Nama Kategori <span class="req">*</span></label>
                <input type="text" name="name"
                       class="input @error('name') invalid @enderror"
                       placeholder="Masukkan nama kategori"
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <hr class="sep">

            <div class="form-foot">
                <button type="submit" class="btn-x primary">
                    <i class="bi bi-save"></i> Simpan Kategori
                </button>
                <a href="{{ route('categories.index') }}" class="btn-x ghost">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
