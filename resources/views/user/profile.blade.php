@extends('layouts.user')
    @section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Cart
            </div>
            <div class="card-body justify-content-center">
                <pre>
                    {{print_r($user_data)}}
                </pre>

            </div>
        </div>
    </div>
    @endsection
