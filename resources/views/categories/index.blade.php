@extends('layouts.app')

@section('title', 'Data Kategori')
@section('crumb', 'categories')

@section('content')

<div class="page-head">
    <div>
        <div class="eyebrow">// Inventaris</div>
        <h1 class="page-title">Kategori Barang</h1>
        <p class="page-desc">Kelola kategori inventaris barang.</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn-x primary">
        <i class="bi bi-plus-lg"></i> Tambah Kategori
    </a>
</div>

<div class="panel">
    <div class="table-wrap">
        <table class="data">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Produk</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td class="mono-dim">{{ str_pad($categories->firstItem() + $loop->index - $categories->perPage() * ($categories->currentPage() - 1), 2, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <span class="chip"><i class="bi bi-tag"></i>{{ $category->name }}</span>
                        </td>
                        <td class="num">{{ $category->products_count }} Barang</td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                   class="btn-x ghost sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-x danger sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:0;">
                            <div class="empty">
                                <i class="bi bi-inbox"></i>
                                <div class="cmd"><span class="prompt">$</span> belum ada kategori.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="panel-body">
        {{ $categories->links('pagination.opencode') }}
    </div>
</div>

@endsection
