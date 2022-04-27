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
}
