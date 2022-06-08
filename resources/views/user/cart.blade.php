@extends('layouts.navigation.user')
    @section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Cart
            </div>
            <form class="card-body justify-content-center" method="GET" action="{{ route('user.checkout') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6 bg-white shadow order-2 order-md-1">
                        <h6 class="text-secondary mt-2 fw-bold">Order</h6>

                        @php
                        $subtotal_items = array()
                        @endphp


                        @foreach ($cart_items as $index => $cart_item)
                            <div class="row my-2 align-items-center">
                                <div class="col-md-2">
                                    <img style="width: 100%; object-fit:contain;" src="{{env('APP_URL').'product/getThumbnail/'. $cart_item['product_id'] .'/'. $cart_item['image']}}" alt={{$cart_item['main_text']}}>
                                </div>
                                <div class="col-md-5 d-flex flex-md-column">
                                    <h6>{{$cart_item['main_text']}}</h6>
                                    <h6 class="ms-auto m-md-0 text-danger">{{$cart_item['price']}}</h6>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-grow-0">
                                            <a
                                            href={{route('remove.cart',['product_id' => $cart_item['product_id']])}}
                                            class="btn btn-sm btn-primary d-flex align-items-center"
                                            style="width:25px; height: 25px;">
                                                -
                                            </a>

                                        </div>
                                        <div class="flex-grow-1 mx-2">
                                            <input disabled readonly type="text" class="form-control disabled text-center" style="width: 100%; height: 25px;" value="{{$cart_item['count']}}">
                                        </div>
                                        <div class="flex-grow-0">
                                            <a
                                            href={{route('insert.cart',['product_id' => $cart_item['product_id'], 'page' => 'checkout'])}}
                                            class="btn btn-sm btn-primary d-flex align-items-center"
                                            style="width:25px; height: 25px;">
                                                +
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 mt-md-0">
                                    @if (preg_match('/\w(.*)/', $cart_item['price'], $price_number))
                                        $ {{$price_number[0] * $cart_item['count']}}
                                        @php
                                        $subtotal_items[] = $price_number[0] * $cart_item['count']
                                        @endphp

                                    @endif
                                </div>
                            </div>
                            <hr class="m-0 p-0">
                        @endforeach

                        <div class="d-flex mt-2">
                            <strong class="me-auto">Subtotal</strong>
                            @php
                                $subtotal = 0;
                            @endphp
                            @for ($i = 0; $i < count($subtotal_items); $i++)
                                @php
                                    $subtotal = $subtotal + $subtotal_items[$i]
                                @endphp
                            @endfor
                            <h6 id='subtotal'>$ {{$subtotal}}</h6>
                        </div>

                        <div class="d-flex mt-2">
                            <strong class="me-auto">Delivery</strong>
                            <h6 id='delivery_value'>$ {{$delivery_value}}</h6>
                        </div>

                        <div class="d-flex mt-2">
                            <strong class="me-auto">Total</strong>
                            <h6 id='delivery_total'>$ {{$subtotal + $delivery_value}}</h6>
                        </div>
                        <div class="d-flex my-4">
                            <button class="btn btn-primary flex-grow-1" type="submit">Proceed to checkout</button>
                        </div>
                    </div>

                    <div class="col-md-5 order-1 order-md-2">
                        <h5>Select your address</h5>
                        <div id="select_address">
                            @foreach ($address as $key => $addr)
                                <div class="form-check card d-flex flex-row align-items-center py-2 mb-2">
                                    <input class="form-check-input p-0 m-0" type="radio" name="address_id" value="{{encrypt($addr->id)}}" {{$key === 0 ? 'checked' : ''}}/>
                                    <label class="form-check-label p-0 ms-2" for="exampleRadios{{$key}}">
                                    {{$addr->sublocality}}, {{$addr->house_number}} - {{$addr->zipcode}} , {{$addr->city}} - {{$addr->state}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/cart.js')}}"></script>
    @endsection
