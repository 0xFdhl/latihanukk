@extends('layouts.app')

@section('title', 'Data Barang')
@section('crumb', 'products')

@section('content')

<div class="page-head">
    <div>
        <div class="eyebrow">// Inventaris</div>
        <h1 class="page-title">Data Barang</h1>
        <p class="page-desc">Kelola inventaris barang gudang.</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn-x primary">
        <i class="bi bi-plus-lg"></i> Tambah Barang
    </a>
</div>

<div class="panel">
    <!-- FILTER -->
    <form action="{{ route('products.index') }}" method="GET" class="filter-bar">
        <div class="search-wrap" style="flex:1; min-width:200px;">
            <i class="bi bi-search"></i>
            <input type="text" name="search" class="input"
                   placeholder="Cari nama barang...  ( / )"
                   value="{{ request('search') }}">
        </div>
        <select name="category_id" class="select">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(request('category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn-x">
            <i class="bi bi-funnel"></i> Filter
        </button>
        <a href="{{ route('products.index') }}" class="btn-x ghost">Reset</a>
    </form>

    <!-- TABEL -->
    <div class="table-wrap">
        <table class="data">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Tgl Masuk</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="mono-dim">{{ str_pad($products->firstItem() + $loop->index - $products->perPage() * ($products->currentPage() - 1), 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="strong">{{ $product->name }}</td>
                        <td><span class="chip"><i class="bi bi-tag"></i>{{ $product->category->name }}</span></td>
                        <td class="num">
                            @if ($product->stock > 10)
                                <span class="chip ok">{{ $product->stock }} unit</span>
                            @elseif ($product->stock > 0)
                                <span class="chip low">{{ $product->stock }} unit</span>
                            @else
                                <span class="chip out">habis</span>
                            @endif
                        </td>
                        <td class="num">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="mono-dim num">{{ $product->entry_date->format('d-m-Y') }}</td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="btn-x ghost icon sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="btn-x ghost icon sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-x danger icon sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:0;">
                            <div class="empty">
                                <i class="bi bi-inbox"></i>
                                <div class="cmd"><span class="prompt">$</span> data barang tidak ditemukan.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="panel-body">
        {{ $products->links('pagination.opencode') }}
    </div>
</div>

@endsection
