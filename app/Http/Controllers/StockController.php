<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Stock::query();
        $products = Product::all();
        $stocks = $query->paginate(5)->appends($request->all());

        // Ambil nilai pencarian
        $search = $request->input('search');

        // Query data units dengan pencarian
        $stocks = Stock::when($search, function ($query, $search) {
            return $query->where('quantity', 'LIKE', "%{$search}%")->orWhere('product_id', 'LIKE', "%{$search}%");
        })->paginate(5);

        return view('pages.stocks.index', compact('stocks', 'products'));
    }

    public function store(Request $request)
    {
        try {
            $validation = $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|numeric|min:1',
            ]);

            // Cari stok berdasarkan product_id
            $stock = Stock::where('product_id', $validation['product_id'])->first();

            if ($stock) {
                // Jika stok sudah ada, tambahkan quantity
                $stock->quantity += $validation['quantity'];
                $stock->in_stock += $validation['quantity'];
                $stock->save();
            } else {
                // Jika stok belum ada, buat stok baru
                $stock = new Stock();
                $stock->product_id = $validation['product_id'];
                $stock->quantity = $validation['quantity'];
                $stock->in_stock = $validation['quantity'];
                $stock->save();
            }

            // Update stok total di tabel products
            $product = Product::find($validation['product_id']);
            $product->stock_quantity = ($product->stock_quantity ?? 0) + $validation['quantity'];
            $product->save();

            return redirect()->back()->with('success', 'Stok berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }




    public function destroy(Stock $stock) {
        try {
            $stock = Stock::findOrFail($stock->id);
            $stock->delete();

            return redirect()->back()->with('success', 'Stok berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
