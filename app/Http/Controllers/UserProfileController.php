<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use App\Models\Address;
use App\Models\PhoneNumber;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index()
    {
        $user_data = User::where('id', auth()->user()->id)->with(['address', 'phone'])->first();
        return view('user.profile', ['user_data' => $user_data]);
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
            'user.name' => 'min:1|max:512|unique:users,name,'.auth()->user()->id,
            'user.email' => 'min:8|max:512|unique:users,email,'.auth()->user()->id,
            'phone.0' => 'required'
        ];

        $feedback = [
            'user.email.unique' => 'The user email has already been taken.',
            'address.*.zipcode.required' => 'We need at least one zipcode to proceed',
            'address.*.sublocality.required' => 'We need at least one sublocality to proceed',
            'address.*.uf.required' => 'Add a UF',
            'address.*.city.required' => 'We need at least one city to proceed',
            'address.*.country.required' => 'We need at least one country to proceed',
            'address.*.house_number.required' => 'We need at least one house number to proceed',
            'phone.0.required' => 'At least one phone number must be registered'
        ];

        $request->validate($rules, $feedback);
        $user = auth()->user();


        if($user->update([
            'name' => $request->user['name'],
            'email' => $request->user['email'],
        ]))
        {

            foreach ($request->address as $address) {
                Address::updateOrCreate(
                [
                    'id' => $address['id']
                ],
                [
                    'user_id' => auth()->user()->id,
                    'zipcode' => $address['zipcode'],
                    'sublocality' => $address['sublocality'],
                    'state' => $address['uf'],
                    'city' => $address['city'],
                    'country' => $address['country'],
                    'house_number' => $address['house_number']
                ]);
            }

            foreach ($request->phone as $phone) {

                if($phone['number']){

                    PhoneNumber::updateOrCreate(
                        [
                            'id' => $phone['id']
                        ],
                        [
                            'user_id' => auth()->user()->id,
                            'phone_number' => $phone['number']
                        ]
                    );
                }
            }
            return redirect()->route('user.profile');
        }
    }

    public function changeAvatar(Request $request)
    {
        $rules = [
            'avatar' => 'file|mimes:jpg,jpeg,png|max:2048',
        ];

        $request->validate($rules);

        Storage::disk('public')->delete('avatars/'.auth()->user()->user_avatar);

        $path = $request->file('avatar')->store('avatars', ['disk' => 'public']);

        auth()->user()->user_avatar = str_replace('avatars/','',$path);
        auth()->user()->save();

        return response()->json(['avatar' => auth()->user()->user_avatar]);
    }
}
