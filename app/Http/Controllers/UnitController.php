<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $query = Unit::query();
        $units = $query->paginate(5)->appends($request->all());

        // Ambil nilai pencarian
        $search = $request->input('search');

        // Query data units dengan pencarian
        $units = Unit::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->paginate(5);

        return view('pages.units.index', compact('units'));
    }



    public function store(Request $request)
    {

        try {
            $validation = $request->validate([
                'name' => 'required',
            ], [
                'name.required' => 'Satuan harus diisi!',
            ]);

            Unit::create([
                'name' => $validation['name'],
            ])
                ->save();

            return redirect()->back()->with('success', 'Satuan berhasil ditambahkan');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Satuan gagal ditambahkan: ' . $e->getMessage());
        }
    }


    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->back();
    }
}
