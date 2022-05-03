<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebServicesController extends Controller
{
    public function getLocation(Request $request)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get('https://maps.googleapis.com/maps/api/geocode/json?address='.$request->code.'&key='.env('ZIPCODE_API_KEY'));

        return $response;
    }
}
