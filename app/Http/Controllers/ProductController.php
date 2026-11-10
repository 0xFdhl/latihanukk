<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Pencarian nama barang
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        $categories = Category::all();

        return view('products.index', compact(
            'products',
            'categories'
        ));
    }

    // Form tambah produk
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    // Menyimpan produk
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'entry_date' => 'required|date',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'name.required' => 'Nama barang wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'price.required' => 'Harga wajib diisi.',
            'price.min' => 'Harga tidak boleh negatif.',
            'entry_date.required' => 'Tanggal masuk wajib diisi.',
        ]);

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'entry_date' => $request->entry_date,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    // Detail produk
    public function show(Product $product)
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    // Form edit produk
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact(
            'product',
            'categories'
        ));
    }

    // Update produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'entry_date' => 'required|date',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'entry_date' => $request->entry_date,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}
