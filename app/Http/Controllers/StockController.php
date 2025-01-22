<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request){
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

    public function store(){

    }

    public function destroy(){

    }
}
