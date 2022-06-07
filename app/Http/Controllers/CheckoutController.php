<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Http;
use MercadoPago;
use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class CheckoutController extends Controller
{

    public function index(Request $request)
    {
        $card_payment_methods = Http::withOptions([
            'verify' => false,
        ])
        ->withHeaders([
            'accept'=>'application/json',
            'content-type'=>'application/json',
            'Authorization' => 'Bearer '.env('PAYMENT_GATEWAY_ACCESS_TOKEN')
        ])
        ->get('https://api.mercadopago.com/v1/payment_methods');


        $card_payment_methods = array_filter(json_decode($card_payment_methods), function($payment_method){
                return $payment_method->payment_type_id == 'credit_card';
        });

        try {
            $address_id = decrypt($request->address_id);
        } catch (\Throwable $th) {
            return redirect()->route('user.cart');
        }

        $address = Address::find($address_id);

        $cart_items = CartController::getItems();

        $cart_items->transform(function($cart_item){
            return $cart_item->getAttributes();
        });


        return view('user.checkout', [
            'items' => $cart_items,
            'address' => $address,
            'delivery_value' => $this->calculateDistance($request->address_id),
            'payment_methods' => [
                'money' => 'cash on delivery',
                'card' => $card_payment_methods,
                ]
            ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $cart_items =  CartController::getItems();
        $price = 0;
        foreach ($cart_items as $cart_item) {
            $price += (float)explode(' ',$cart_item->price)[1] * $cart_item->count;
        }

        if($request->transaction_amount['delivery'] !== $this->calculateDistance(encrypt($request->address['id']))){
            return 'You can\'t change the the delivery value, please try again';
        }

        MercadoPago\SDK::setAccessToken(env('PAYMENT_GATEWAY_ACCESS_TOKEN'));
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount =  (float)$price + (float)$request->transaction_amount['delivery'];
        $payment->token = $request->token;
        $payment->description = $request->description;
        $payment->installments = $request->installments;
        $payment->payment_method_id = $request->paymentMethodId;
        $payment->issuer_id = $request->issuer;

        $payer = new MercadoPago\Payer();
        $payer->email = auth()->user()->email;
        $payer->identification = array(
            "type" => $request->payer['identification']['type'],
            "number" => $request->payer['identification']['number']
        );
        $payer->first_name = explode(' ',auth()->user()->name)[0];
        $payment->payer = $payer;

        $payment->save();

        if($payment->status === 'approved'){
            //DELETE FROM CART AND CREATE A UNIQUE CODE AND REGISTER INTO A ORDER TABLE,AFTER ORDER TABLE CREATED
            //RELATE IT TO A PRODUCT_ORDER TABLE WITH ORDER_ID AND PRODUCT ID

            $orderCode = Str::random(12);

            $order = DB::table('orders')->insertGetId([
                'order_code' => $orderCode,
                'user_id' => auth()->user()->id,
                'delivery_value' => $request->transaction_amount['delivery'],
                'order_value' => $request->transaction_amount['subtotal'],
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);


            if($order){
                foreach ($cart_items as $cart_item) {
                   $product_order = DB::table('product_order')->insert([
                    'product_id' => $cart_item->product_id,
                    'order_id' => $order,
                    'quantity' => $cart_item->count,
                    "created_at" =>  Carbon::now(),
                    "updated_at" => Carbon::now(),
                   ]);

                   if($product_order){
                        Cart::where('user_id', auth()->user()->id)->where('product_id', $cart_item->product_id)->delete();
                   }
                }
            }

            

            //Send email with receipt and redirect to approved screen
            $generated_payment = route('checkout.success', ['payment_status' => $payment->status, 'order_code' => $orderCode]);
            return response()->json(['generated_payment' => $generated_payment]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
