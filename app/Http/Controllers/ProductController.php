<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categories::all();
        $units = Unit::all();
        $suppliers = Supplier::all();
        $stocks = Stock::all();

        // Ambil nilai pencarian
        $search = $request->input('search');
        $query = Product::with(['stock', 'category', 'unit']);
        $products = $query->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%")
                ->orWhere('category_id', 'LIKE', "%{$search}%")
                ->orWhere('unit_id', 'LIKE', "%{$search}%")
                ->orWhereHas('stock', function ($q) use ($search) {
                    $q->where('quantity', 'LIKE', "%{$search}%");
                });
        })->paginate(5);

        return view('pages.products.index', compact('products', 'categories', 'units', 'suppliers', 'stocks'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi
            $validation = $request->validate([
                'name' => 'required',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'unit_id' => 'required|exists:units,id',
                'supplier_id' => 'required|exists:suppliers,id',
                'quantity' => 'required|integer|min:1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'name.required' => 'Nama produk harus diisi.',
                'price.required' => 'Harga produk harus diisi.',
                'category_id.required' => 'Kategori produk harus diisi.',
                'unit_id.required' => 'Satuan produk harus diisi.',
                'supplier_id.required' => 'Supplier produk harus diisi.',
                'quantity.required' => 'Stok produk harus diisi.',
                'image.image' => 'File harus berupa gambar.',
            ]);

            // Proses unggah gambar
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);
                $validation['image'] = $imageName;
            }

            // Simpan produk
            $product = Product::create($validation);

            // Simpan stok
            Stock::create([
                'product_id' => $product->id,
                'quantity' => $request->input('quantity'),
                'in_stock' => null,
                'out_stock' => null,
            ]);

            return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Produk gagal ditambahkan: ' . $th->getMessage());
        }
    }


    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Produk gagal dihapus: ' . $th->getMessage());
        }
    }
}
