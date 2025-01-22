<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Ambil nilai pencarian
        $search = $request->input('search');

        // Query data units dengan pencarian
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->orWhere('username', 'LIKE', "%{$search}%");
        })->paginate(5);

        return view('pages.users.index', compact('users'));
    }

    public function store() {}

    public function destroy() {}
}
