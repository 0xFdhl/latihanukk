<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total barang
        $totalProducts = Product::count();

        // Menghitung total kategori
        $totalCategories = Category::count();

        // Menghitung total seluruh stok barang
        $totalStock = Product::sum('stock');

        // Menghitung total nilai inventaris
        $totalValue = Product::selectRaw(
            'COALESCE(SUM(stock * price), 0) as total'
        )->value('total');

        // Mengambil 5 produk terbaru
        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Menghitung jumlah produk setiap kategori
        $categoryStats = Category::withCount('products')
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'totalValue',
            'latestProducts',
            'categoryStats'
        ));
    }
}