<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Http;


class CartController extends Controller
{
    public function index()
    {
        $cart_items = $this->getItems();

        $cart_items->transform(function($cart_item){
            return $cart_item->getAttributes();
        });

        $user_address = auth()->user()->address;

        if(count($user_address) !== 0){
            return view('user.cart', ['address' => $user_address, 'cart_items' => $cart_items, 'delivery_value' => $this->calculateDistance()]);
        }
        return redirect()->route('user.profile');
    }



    public function create(Request $request, $product_id)
    {

        $cart_item = Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product_id
        ]);
        if($cart_item->id){
            if($request->page == 'checkout'){
                return redirect()->route('user.cart');
            }
            return redirect()->route('index');
        }
    }



    public function delete($product_id)
    {
        $cart_item = Cart::where(['user_id' => auth()->user()->id, 'product_id' => $product_id])->orderBy('created_at', 'desc')->first();
        $cart_item->delete();
        return redirect()->route('user.cart');
    }

    public static function getItems()
    {
        $cart_items = auth()
                    ->user()
                    ->products()
                    ->selectRaw('products.main_text, products.price, products.image, cart.product_id, count(*) AS count')
                    ->orderBy('pivot_created_at', 'desc')
                    ->groupBy('pivot_product_id')
                    ->get();

        return $cart_items;
    }
}
