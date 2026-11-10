
@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="mb-4">
    <h4 class="content-title">Edit Kategori</h4>
    <p class="text-muted">Perbarui nama kategori barang.</p>
</div>

<div class="card p-4">

    <form action="{{ route('categories.update', $category->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>

            <input type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $category->name) }}">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Update Kategori
        </button>

        <a href="{{ route('categories.index') }}"
            class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection
