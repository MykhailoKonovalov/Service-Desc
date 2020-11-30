<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        $user = Auth::user();
        return view('home', ['products' => $products, 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $problem = User::find($id);
        $problem->specialization = $request->input('specialization');
        $problem->role = 2;
        $problem->save();

        return redirect("/home");
    }
}
