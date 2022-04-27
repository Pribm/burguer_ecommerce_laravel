<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class IndexController extends Controller
{
    public function index()
    {
        $main_product = Product::where('main_product', 1)->first();
        $products = Product::orderBy('id', 'desc')->paginate(8);

        //logged in
        if(auth()->user())
        {
            $total_items = auth()->user()->products()->count();
            return view('index', ['main_product' => $main_product, 'products' => $products, 'total_items' => $total_items]);
        }
        return view('index', ['main_product' => $main_product, 'products' => $products]);
    }
}
