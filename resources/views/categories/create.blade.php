
@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="container-fluid">

    <h4>Tambah Kategori Barang</h4>

    <div class="card p-4 mt-3">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>

                <input type="text"
                    name="name"
                    class="form-control"
                    placeholder="Masukkan nama kategori"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('categories.index') }}"
                class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection
