
@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">

    <div>
        <h4 class="content-title">Data Barang</h4>
        <p class="text-muted mb-0">Kelola inventaris barang gudang.</p>
    </div>

    <a href="{{ route('products.create') }}"
        class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Barang
    </a>

</div>

<div class="card p-4">

    <!-- SEARCH DAN FILTER -->
    <form action="{{ route('products.index') }}" method="GET"
        class="row g-2 mb-4">

        <div class="col-md-5">
            <input type="text"
                name="search"
                class="form-control"
                placeholder="Cari nama barang..."
                value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="category_id" class="form-select">

                <option value="">Semua Kategori</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-success">
                <i class="bi bi-search"></i> Cari
            </button>

            <a href="{{ route('products.index') }}"
                class="btn btn-secondary">
                Reset
            </a>
        </div>

    </form>

    <!-- TABEL BARANG -->
    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)

                    <tr>

                        <td>{{ $products->firstItem() + $loop->index }}</td>

                        <td>
                            <strong>{{ $product->name }}</strong>
                        </td>

                        <td>
                            <span class="badge bg-info">
                                {{ $product->category->name }}
                            </span>
                        </td>

                        <td>{{ $product->stock }}</td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $product->entry_date->format('d-m-Y') }}
                        </td>

                        <td>

                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-info btn-sm text-white">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus barang ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7"
                            class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Data barang belum tersedia.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-3">
        {{ $products->links() }}
    </div>

</div>

@endsection
