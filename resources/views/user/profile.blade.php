@extends('layouts.navigation.user')
@section('content')
    <div class="container mt-4">
        <form method="POST" action="{{ route('user.update') }}" class="card">
            @csrf
            @method('PUT')
            <div
                class="card-header text-md-start text-center d-flex flex-wrap justify-content-md-start justify-content-center align-items-center bg-white">
                <div class="my-2">
                    <h5 class="m-0">Account Settings</h5>
                    <h6 class="text-secondary m-0">Here you can change your personal data to make our delivery easier</h6>
                </div>
                <button type="submit" class="btn p-0 ms-md-auto m-0 px-4 btn-primary">
                    Save
                </button>
            </div>

            <div class="d-flex align-items-center flex-wrap justify-content-center justify-content-md-start mx-3 my-4 text-md-start text-center"
                id='change_avatar_area'>
                @if (!$user_data['user_avatar'])
                    <div id='avatar_field'
                    class="bg-secondary d-flex my-2 my-md-0 align-items-center justify-content-center text-white text-uppercase fw-bold rounded-circle"
                    style="width: 45px; height: 45px;">
                        {{ $user_data['name'][0] }}
                    </div>
                @else
                    <img
                    src={{route('get.image', ['path' => 'avatars', 'image' => $user_data['user_avatar']])}}
                    alt="user avatar"
                    class='rounded-circle'
                    style="width: 45px; height: 45px; object-fit: cover;" id='user_avatar_image'>
                @endif
                <div class="h-100 ms-4 my-2 my-md-0">
                    <h6 class="m-0">Change Avatar</h6>
                    <h6 class="text-secondary m-0">Select a photo, so we can identify you</h6>
                </div>
                <button class="my-2 my-md-0 ms-3 btn btn-outline-primary py-0" id='upload_avatar_button'>
                    Upload
                </button>
                <input type="file" name="avatar" id="avatar_input" class="d-none">
            </div>

            <hr class="mx-4 my-0">

            <div class="mx-4 mt-2 mb-4">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label class="m-0">Full Name</label>
                        <input type="text" name="user[name]" class="form-control form-control-sm"
                            value={{ $user_data['name'] }} placeholder={{ $user_data['name'] }}>
                    </div>

                    <div class="col-md-6 my-2">
                        <label class="m-0">Email Adress</label>
                        <input type="text" name="user[email]" class="form-control form-control-sm"
                            value={{ $user_data['email'] }} placeholder={{ $user_data['email'] }}>
                            @error('user.email')
                                <strong class="text-danger">{{ $errors->get('user.email')[0] }}</strong>
                            @enderror
                    </div>
                </div>
            </div>

            <hr class="mx-4 my-0">

            <!--Start Adress-->
            <div class="mx-4 mt-2 mb-4" id='address-container'>
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <h5 class="mt-2 mb-2">Address List</h5>
                    </div>
                    <div class="col-md-2 text-end ">
                        <button class="mb-2 btn py-0 btn-outline-primary" id='addAddress'>+ Add Address</button>
                    </div>
                </div>
                    @if (count($user_data->address) === 0)
                        @php
                            $user_data->address = [
                                [
                                    'zipcode' => '',
                                    'sublocality' => '',
                                    'state' => '',
                                    'city' => '',
                                    'country' => '',
                                    'house_number' => '',
                                    'user_id' => '',
                                    'id' => ''
                                ]
                            ]
                        @endphp
                    @endif
                    @foreach ($user_data->address as $key => $address)

                        <div class="address_form my-2 p-2 border rounded" id='address-form-{{$key}}'>
                            <span class="fw-bold m-0">Address</span><span
                                class="fw-bold m-0 ms-1 address-number">{{intval($key)+1}}</span>
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    <label class="m-0">Zipcode</label>

                                    <input name="address[{{$key}}][zipcode]" value="{{$address['zipcode']}}" type="text" class="form-control form-control-sm zipcode" placeholder="Zipcode" />
                                    @error('address.{{ $key }}.zipcode')
                                        <strong class="text-danger">{{ $errors->get('address.0.zipcode')[intval($key)] }}</strong>
                                    @enderror
                                </div>

                                <div class="col-md-7 my-2">
                                    <label class="m-0">Sublocality</label>
                                    <input name="address[{{ $key }}][sublocality]"
                                        value="{{ $address['sublocality'] }}" type="text"
                                        class="form-control form-control-sm sublocality" placeholder="Sublocality" />
                                    @error('address.{{ $key }}.sublocality')
                                        <strong
                                            class="text-danger">{{ $errors->get('address.0.sublocality')[$key] }}</strong>
                                    @enderror
                                </div>

                                <div class="col-md-1 my-2">
                                    <label class="m-0">UF</label>
                                    <input name="address[{{$key}}][uf]" value="{{ $address['state'] }}" type="text" class="form-control form-control-sm state"
                                        placeholder="UF">
                                    @error('address.{{$key}}.uf')
                                        <strong class="text-danger">{{ $errors->get('address.0.uf')[0] }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 my-2">
                                    <label class="m-0">City</label>
                                    <input name="address[{{ $key }}][city]" value="{{ $address['city'] }}" type="text" class="form-control form-control-sm city"
                                        placeholder="City">
                                    @error('address.{{ $key }}.city')
                                        <strong class="text-danger">{{ $errors->get('address.0.city')[0] }}</strong>
                                    @enderror
                                </div>

                                <div class="col-md-4 my-2">
                                    <label class="m-0">Country</label>
                                    <input name="address[{{ $key }}][country]" value="{{ $address['country'] }}" type="text"
                                        class="form-control form-control-sm country" placeholder="Country">
                                    @error('address.{{ $key }}.country')
                                        <strong class="text-danger">{{ $errors->get('address.0.country')[0] }}</strong>
                                    @enderror
                                </div>

                                <div class="col-md-2 my-2">
                                    <label class="m-0">Number</label>
                                    <input name="address[{{ $key }}][house_number]" value="{{ $address['house_number'] }}" type="text"
                                        class="form-control form-control-sm house_number" placeholder="Nº">
                                    @error('address.{{ $key }}.house_number')
                                        <strong class="text-danger">{{ $errors->get('address.0.house_number')[0] }}</strong>
                                    @enderror

                                    <input type="hidden" name="address[{{ $key }}][id]" value={{$address['id'] ? $address['id'] : 'undefined'}}>

                                </div>
                            </div>
                        </div>

                    @endforeach
            </div>
            <!--End Adress-->

            <hr class="mx-4 my-0">

            <!--Start Phones-->
            <div class="mx-4 mt-2 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h5 class="mt-2 mb-2">Phone List</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="m-0">Phone 1</label>

                        <input type="hidden" name="phone[0][id]" value={{isset($user_data->phone[0]->id) ? $user_data->phone[0]->id : ''}}>
                        <input value="{{array_key_exists(0,$user_data->phone->toArray()) ? $user_data->phone[0]->phone_number : ''}}" name="phone[0][number]" class="form-control form-control-sm phone" type="text"
                            placeholder="+00 (00) 0 0000-0000" autocomplete="off">
                            @error('phone.0')
                                <strong class="text-danger">{{ $errors->get('phone.0')[0] }}</strong>
                            @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="m-0">Phone 2</label>
                        <input type="hidden" name="phone[1][id]" value={{isset($user_data->phone[1]->id) ? $user_data->phone[1]->id : ''}}>
                        <input value="{{array_key_exists(1,$user_data->phone->toArray()) ? $user_data->phone[1]->phone_number : ''}}"  name="phone[1][number]" class="form-control form-control-sm phone" type="text"
                            placeholder="+00 (00) 0 0000-0000" autocomplete="off">
                    </div>

                    <div class="col-md-4">
                        <label class="m-0">Phone 3</label>
                        <input type="hidden" name="phone[2][id]" value={{isset($user_data->phone[2]->id) ? $user_data->phone[2]->id : ''}}>
                        <input value="{{array_key_exists(2,$user_data->phone->toArray()) ? $user_data->phone[2]->phone_number : ''}}"  name="phone[2][number]" class="form-control form-control-sm phone" type="text"
                            placeholder="+00 (00) 0 0000-0000" autocomplete="off">
                    </div>
                </div>
            </div>
            <!--End Phones-->

            <hr class="mx-4 my-0">

            <div class="mx-4 mt-2 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h5 class="mt-2 mb-2">Change Password</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="m-0">Old Password</label>
                        <input name="user[old_password]" class="form-control form-control-sm" type="password"
                            placeholder="************">
                    </div>

                    <div class="col-md-4">
                        <label class="m-0">New Password</label>
                        <input name="user[new_password]" class="form-control form-control-sm" type="password"
                            placeholder="************">
                    </div>

                    <div class="col-md-4">
                        <label class="m-0">Confirm</label>
                        <input name="user[password_confirm]" class="form-control form-control-sm" type="password"
                            placeholder="************">
                    </div>
                </div>
            </div>

        </form>
    </div>
    <script src={{ asset('js/profile.js') }}>

    </script>
@endsection
