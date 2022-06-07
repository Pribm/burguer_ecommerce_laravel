<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Address;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function calculateDistance($address_id = null){
        
        $address_id = $address_id ? decrypt($address_id) : auth()->user()->address()->first()->id;

        $user_address = Address::where('user_id', auth()->user()->id)->where('id', $address_id)->first();
        $store_address = Address::where('user_id', 1)->first();

        $distance = Http::withOptions(
            ['verify' => false,]
        )
        ->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'origins' => $user_address->sublocality.', '.$user_address->house_number.', '.$user_address->city.' - '.$user_address->state.', '.$user_address->zipcode.', '.$user_address->country,
            'destinations' => $store_address->sublocality.', '.$store_address->house_number.', '.$store_address->city.' - '.$store_address->state.', '.$store_address->zipcode.', '.$store_address->country,
            'units' => 'km',
            'key' => env('ZIPCODE_API_KEY')
        ]);

        $base_delivery_value = 4;
        $price_per_km = 1;

        return  round(json_decode($distance)->rows[0]->elements[0]->distance->value/($price_per_km*1000) + $base_delivery_value, 2);
    }

    public function generateUniqueCode(String $model, String $uniqColName)
    {
        $model = 'App\\Models\\' . $model;

        do {
            $code = random_int(100000, 999999);
        } while ($model::where($uniqColName, "=", $code)->first());

        return $code;
    }
}
