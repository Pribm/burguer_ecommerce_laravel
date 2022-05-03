<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Authenticatable;

class UserProfileController extends Controller
{
    public function index()
    {
        $user_data = User::find(auth()->user()->id);
        return view('user.profile')->with('user_data', $user_data->toArray());
    }

    public function update(Request $request)
    {
        $rules = [
            'address.*.zipcode' => 'required',
            'address.*.sublocality' => 'required',
            'address.*.uf' => 'required',
            'address.*.city' => 'required',
            'address.*.country' => 'required',
            'address.*.house_number' => 'required',
            'user.name' => 'min:1|max:512',
            'user.email' => 'min:8|max:512|email',
            'phone.0' => 'required'
        ];

        $feedback = [
            'address.*.zipcode.required' => 'We need at least one zipcode to proceed',
            'address.*.sublocality.required' => 'We need at least one sublocality to proceed',
            'address.*.uf.required' => 'Add a UF',
            'address.*.city.required' => 'We need at least one city to proceed',
            'address.*.country.required' => 'We need at least one country to proceed',
            'address.*.house_number.required' => 'We need at least one house number to proceed',
            'phone.0' => 'At least one phone number must be registered'
        ];

        $request->validate($rules, $feedback);

        $user = auth()->user();
        dd($user);
    }
}
