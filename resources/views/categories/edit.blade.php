@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('crumb', 'categories / edit')

@section('content')

<div class="page-head">
    <div>
        <div class="eyebrow">// Inventaris / Kategori</div>
        <h1 class="page-title">Edit Kategori</h1>
        <p class="page-desc">Perbarui nama kategori barang.</p>
    </div>
    <a href="{{ route('categories.index') }}" class="btn-x ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="panel" style="max-width:620px;">
    <div class="panel-head">
        <span class="panel-title"><span class="bracket">[</span> Form Edit Kategori <span class="bracket">]</span></span>
        <span class="chip"><i class="bi bi-hash"></i>ID {{ $category->id }}</span>
    </div>
    <div class="panel-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field">
                <label>Nama Kategori <span class="req">*</span></label>
                <input type="text" name="name"
                       class="input @error('name') invalid @enderror"
                       value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="field-error"><i class="bi bi-x-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <hr class="sep">

            <div class="form-foot">
                <button type="submit" class="btn-x primary">
                    <i class="bi bi-save"></i> Update Kategori
                </button>
                <a href="{{ route('categories.index') }}" class="btn-x ghost">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
