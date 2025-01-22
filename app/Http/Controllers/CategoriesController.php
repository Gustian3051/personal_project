<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request){
        $query = Categories::query();

        // Ambil nilai pencarian
        $search = $request->input('search');

        // Query data categories dengan pencarian
        $categories = Categories::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->paginate(5);

        return view('pages.categories.index', compact('categories'));
    }

    public function store(Request $request){
        try {
            $validation = $request->validate([
                'name' => 'required',
            ], [
                'name.required' => 'Kategori harus diisi!',
            ]);

            Categories::create([
                'name' => $validation['name'],
            ])
                ->save();

            return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Kategori gagal ditambahkan: ' . $e->getMessage());
        }
    }

    public function destroy(Categories $categories){
        $categories->delete();
        return redirect()->back();
    }
}
