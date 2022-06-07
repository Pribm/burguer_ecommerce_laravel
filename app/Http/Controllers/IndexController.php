<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Controllers\Settings\Admin\WebsiteController;
use App\Models\WebsiteSettings;
use App\Models\Address;

class IndexController extends Controller
{
    public function index()
    {
        $main_product = Product::where('main_product', 1)->first();
        $products = Product::orderBy('id', 'desc')->paginate(8);
        $site_info = WebsiteSettings::find(1);
        $address = Address::where('user_id', 1)->first();

        //logged in
        if(auth()->user())
        {
            $total_items = auth()->user()->products()->count();
            return view('index', ['main_product' => $main_product, 'products' => $products, 'total_items' => $total_items, 'site_info' => $site_info, 'address' => $address]);
        }
        return view('index', ['main_product' => $main_product, 'products' => $products, 'site_info' => $site_info, 'address' => $address]);
    }
}
