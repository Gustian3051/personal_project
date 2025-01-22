<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request){
        $query = Supplier::query();
        $suppliers = $query->paginate(5)->appends($request->all());

        // Ambil nilai pencarian
        $search = $request->input('search');

        // Query data categories dengan pencarian
        $suppliers = Supplier::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->paginate(10);

        return view('pages.suppliers.index', compact('suppliers'));
    }

    public function store(Request $request){
        try {
            $validation = $request->validate([
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required',
                'address' => 'required',
                'shop_name' => 'required',
            ], [
                'name.required' => 'Nama Supplier harus diisi!',
                'phone_number.required' => 'Nomor Telepon Supplier harus diisi!',
                'email.required' => 'Email Supplier harus diisi!',
                'address.required' => 'Alamat Supplier harus diisi!',
                'shop_name.required' => 'Nama Toko Supplier harus diisi!',
            ]);

            Supplier::create([
                'name' => $validation['name'],
                'phone_number' => $validation['phone_number'],
                'email' => $validation['email'],
                'address' => $validation['address'],
                'shop_name' => $validation['shop_name'],
            ])
                ->save();

            return redirect()->back()->with('success', 'Supplier berhasil ditambahkan');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Supplier gagal ditambahkan: ' . $e->getMessage());
        }
    }

    public function destroy(Supplier $supplier){
        try {
            $supplier->delete();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Kategori gagal dihapus: ' . $e->getMessage());
        }
    }
}
