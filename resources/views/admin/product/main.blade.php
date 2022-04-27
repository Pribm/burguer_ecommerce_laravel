@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Catalog') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
                            @csrf
                            <h5 class="card-title">Insert Main Page Product</h5>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Main Text</span>
                                <input type="text" class="form-control" name='main_text'>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Secondary Text</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name='secondary_text'></textarea>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Price</span>
                                            <input type="text" class="form-control" placeholder="00,00" id='price'
                                                name='price'>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id='files' type="file" class="form-control" name='image'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <button class="btn btn-primary" type="submit">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-4">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            Products
                        </div>
                        <div class="card-body">
                            <div class="container">
                                    <div class="row d-md-flex d-none">
                                        <div class="col-md-2">
                                            <strong>Name</strong>
                                        </div>
                                        <div class="col-md-2">
                                            <strong>Main text</strong>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Secondary text</strong>
                                        </div>
                                        <div class="col-md-1">
                                            <strong>Price</strong>
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Image</strong>
                                        </div>
                                        <div class="col-md-1">

                                        </div>
                                    </div>
                                    <hr>
                                        @foreach ($products as $product)
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    Mockup Name
                                                </div>
                                                <div class="col-md-2">
                                                    {{$product->main_text}}
                                                </div>
                                                <div class="col-md-3">
                                                    {{$product->secondary_text}}
                                                </div>
                                                <div class="col-md-1">
                                                    {{$product->price}}
                                                </div>
                                                <div class="col-md-2">
                                                    <img class="w-100" src={{env('APP_URL').'/product/getThumbnail/'. $product->id .'/'. $product->image}} alt=""/>
                                                </div>
                                                <div class="col-md-2">
                                                    <a
                                                    href={{route('product.update', ['id' => $product->id, 'set_main' => true])}}
                                                    class="btn w-100 {{ $product->main_product == 0 ? "btn-secondary" : "btn-success"}} my-2">
                                                        {{$product->main_product == 0 ? "Set Main product" : "main product"}}
                                                    </a>
                                                    <a
                                                    href={{route('product.delete', ['id' => $product->id ])}}
                                                    class="btn w-100 btn-danger my-2">
                                                        delete
                                                    </a>
                                                    <button class="btn w-100 btn-primary my-2">update</button>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
