@extends('layouts.navigation.app')

@section('content')
    <div class="container bg-white shadow-1 p-4">
        <h1>Your Order is confirmed!</h1>

        <h4>Hello {{ $order->users->name }},</h4>
        <h5 class="text-secondary">
            Your order has been confirmed, and will be prepared soon. We'll send you a message when it is going out for
            delivery!
        </h5>

        <hr class="m-0">

        <section id='order-data' class="d-flex justify-content-between align-items-center py-4 flex-wrap">
            <article class="w-100 w-md-auto my-2 my-md-0">
                <h6 class="m-0 fw-bold">Order date</h6>
                <h5 class="m-0">{{ $order->created_at->format('M d Y') }}</h5>
            </article>

            <article class="w-100 w-md-auto my-2 my-md-0">
                <h6 class="m-0 fw-bold">Order code</h6>
                <h5 class="m-0">{{ $order->order_code }}</h5>
            </article>

            <article class="w-100 w-md-auto my-2 my-md-0">
                <h6 class="m-0 fw-bold">Payment method</h6>
                <h5 class="m-0">{{ $order->payment_method }}</h5>
            </article>

            <article class="w-100 w-md-auto my-2 my-md-0">
                <h6 class="m-0 fw-bold">Delivery Address</h6>
                <h5 class="m-0">{{ $order->address->sublocality }} - {{ $order->address->zipcode }}</h5>
            </article>
        </section>
        <hr class="m-0">

        <section id='order-products'>
            @foreach ($order->products as $key => $product)
                <article id="order-product-{{$key}}"  class="d-flex align-items-center" style="height: 80px;">
                    <img class="me-2" style="height: 100%; width: 80px; object-fit:contain;" src="{{ env('APP_URL') . 'product/getThumbnail/' . $product->id . '/' . $product->image }}" alt={{ $product->main_text }}>
                    <div>
                        <h6 class="fw-bold">
                            {{ $product->main_text }}
                        </h6>

                        <h6>
                            Qty: {{ $product->pivot->quantity }}x
                        </h6>
                    </div>

                    <h5 class="ms-auto fw-bold">
                        {{ $product->price }}
                    </h5>
                </article>
            @endforeach
        </section>


        <section id="order_values" class="row p-4">
            <div class="col-md-6 d-none d-md-flex justify-content-center">
                <div class="mb-3">{!! DNS2D::getBarcodeHTML($order->order_code, 'QRCODE') !!}</div>
            </div>
            <div class="col-md-6">
                <div class="d-flex my-2">
                    <span class="fw-bold me-auto">Subtotal</span>
                    <span>{{ $order->delivery_value }}</span>
                </div>

                <div class="d-flex my-2">
                    <span class="fw-bold me-auto">Delivery</span>
                    <span>{{ $order->order_value }}</span>
                </div>

                <hr>

                <div class="d-flex my-2">
                    <span class="fw-bold me-auto text-success">Total</span>
                    <span class="text-success"> {{ (float) $order->delivery_value + (float) $order->order_value }}</span>
                </div>

            </div>
        </section>
        <hr>
        <footer>
            <h6 class="fw-bold">We appreciate the preference!</h6>
            <h6>{{ app('site_info')->site_name ? app('site_info')->site_name : 'Register your title' }} team</h6>
        </footer>

    </div>
@endsection
