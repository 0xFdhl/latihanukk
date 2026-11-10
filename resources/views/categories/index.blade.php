
@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">

    <div>
        <h4 class="content-title">Data Kategori</h4>
        <p class="text-muted mb-0">Kelola kategori inventaris barang.</p>
    </div>

    <a href="{{ route('categories.create') }}"
        class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>

</div>

<div class="card p-4">

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th>Nama Kategori</th>
                    <th width="20%">Jumlah Produk</th>
                    <th width="25%">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td>
                            {{ $categories->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-tags"></i>
                                {{ $category->name }}
                            </span>
                        </td>

                        <td>
                            {{ $category->products_count }} Barang
                        </td>

                        <td>

                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4"
                            class="text-center text-muted py-4">

                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                            Belum ada kategori.

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>

</div>

@endsection
