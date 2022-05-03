@extends('layouts.user')
    @section('content')
    <div class="container mt-4">
        <form method="POST" action="{{route('user.update')}}" class="card">
            @csrf
            @method('PUT')
            <div class="card-header text-md-start text-center d-flex flex-wrap justify-content-md-start justify-content-center align-items-center bg-white">
                <div class="my-2">
                    <h5 class="m-0">Account Settings</h5>
                    <h6 class="text-secondary m-0">Here you can change your personal data to make our delivery easier</h6>
                </div>
                <button type="submit" class="btn p-0 ms-md-auto m-0 px-4 btn-primary">
                    Save
                </button>
            </div>

            <div class="d-flex align-items-center flex-wrap justify-content-center justify-content-md-start mx-3 my-4 text-md-start text-center" id='change_avatar_area'>
                <div id='avatar_field' class="bg-secondary d-flex my-2 my-md-0 align-items-center justify-content-center text-white text-uppercase fw-bold rounded-circle" style="width: 45px; height: 45px;">
                    {{$user_data['name'][0]}}
                </div>
                <div class="h-100 ms-4 my-2 my-md-0">
                    <h6 class="m-0">Change Avatar</h6>
                    <h6 class="text-secondary m-0">Select a photo, so we can identify you</h6>
                </div>
                <button class="my-2 my-md-0 ms-3 btn btn-outline-primary py-0">
                    Upload
                </button>
            </div>

            <hr class="mx-4 my-0">

            <div class="mx-4 mt-2 mb-4">
                <div class="row">
                    <div class="col-md-6 my-2">
                        <label class="m-0">Full Name</label>
                        <input type="text" name="user[name]" class="form-control form-control-sm" value={{$user_data['name']}} placeholder={{$user_data['name']}}>
                    </div>

                    <div class="col-md-6 my-2">
                        <label class="m-0">Email Adress</label>
                        <input type="text" name="user[email]" class="form-control form-control-sm" value={{$user_data['email']}} placeholder={{$user_data['email']}}>
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
                <div class="address_form my-2 p-2 border rounded" id='address-form-0'>
                    <span class="fw-bold m-0">Address</span><span class="fw-bold m-0 ms-1 address-number">1</span>
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label class="m-0">Zipcode</label>
                            <input name="address[0][zipcode]" type="text" class="form-control form-control-sm zipcode" placeholder="Zipcode">
                            @error('address.0.zipcode')
                                <strong class="text-danger">{{$errors->get('address.0.zipcode')[0]}}</strong>
                            @enderror
                        </div>

                        <div class="col-md-7 my-2">
                            <label class="m-0">Sublocality</label>
                            <input name="address[0][sublocality]" type="text" class="form-control form-control-sm sublocality"  placeholder="Sublocality">
                            @error('address.0.sublocality')
                                <strong class="text-danger">{{$errors->get('address.0.sublocality')[0]}}</strong>
                            @enderror
                        </div>

                        <div class="col-md-1 my-2">
                            <label class="m-0">UF</label>
                            <input name="address[0][uf]" type="text" class="form-control form-control-sm state"  placeholder="UF">
                            @error('address.0.uf')
                                <strong class="text-danger">{{$errors->get('address.0.uf')[0]}}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label class="m-0">City</label>
                            <input name="address[0][city]" type="text" class="form-control form-control-sm city"  placeholder="City">
                            @error('address.0.city')
                                <strong class="text-danger">{{$errors->get('address.0.city')[0]}}</strong>
                            @enderror
                        </div>

                        <div class="col-md-4 my-2">
                            <label class="m-0">Country</label>
                            <input name="address[0][country]" type="text" class="form-control form-control-sm country" placeholder="Country">
                            @error('address.0.country')
                                <strong class="text-danger">{{$errors->get('address.0.country')[0]}}</strong>
                            @enderror
                        </div>

                        <div class="col-md-2 my-2">
                            <label class="m-0">Number</label>
                            <input name="address[0][house_number]" type="text" class="form-control form-control-sm house_number"  placeholder="Nº">
                            @error('address.0.house_number')
                                <strong class="text-danger">{{$errors->get('address.0.house_number')[0]}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
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
                        <input name="phone[0]" class="form-control form-control-sm phone" type="text" placeholder="+00 (00) 0 0000-0000" autocomplete="off">
                    </div>

                    <div class="col-md-4">
                        <label class="m-0">Phone 2</label>
                        <input name="phone[1]" class="form-control form-control-sm phone" type="text" placeholder="+00 (00) 0 0000-0000" autocomplete="off">
                    </div>

                    <div class="col-md-4">
                        <label class="m-0">Phone 3</label>
                        <input name="phone[2]" class="form-control form-control-sm phone" type="text" placeholder="+00 (00) 0 0000-0000" autocomplete="off">
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
                        <input name="user[old_password]" class="form-control form-control-sm" type="password" placeholder="************">
                    </div>

                    <div class="col-md-4">
                        <label class="m-0">New Password</label>
                        <input name="user[new_password]" class="form-control form-control-sm" type="password" placeholder="************">
                    </div>

                    <div class="col-md-4">
                        <label class="m-0">Confirm</label>
                        <input name="user[password_confirm]" class="form-control form-control-sm" type="password" placeholder="************">
                    </div>
                </div>
            </div>

        </form>
    </div>
    <script src={{asset('js/profile.js')}}>

    </script>
    @endsection
