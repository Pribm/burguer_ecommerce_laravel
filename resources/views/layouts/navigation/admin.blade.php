<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ app('site_info')->site_name ? app('site_info')->site_name : 'Register your title' }}</title>
    <link rel="icon" href={{ app('site_info')->horizontal_logo ? route('get.image', ['path' => 'website', 'subpath' => 'images', 'image' => app('site_info')->favicon]) : ""}}>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/coreStyles.css') }}">
</head>

<body style="overflow-y: hidden">
    <div class="admin d-flex flex-column">
        <div class="d-flex">
                <nav class="admin__navbar d-flex flex-column">
                    <div class="d-flex align-items-center bg-white bg-danger" style="cursor: pointer; border-right: solid rgb(211, 211, 211) 1px; z-index: 2;" id='nav-dropdown'>
                        <img src={{ app('site_info')->horizontal_logo ? route('get.image', ['path' => 'website', 'subpath' => 'images', 'image' => app('site_info')->horizontal_logo]) : "../img/Logo.png"}} height='50' alt="burguerhouse">
                        <i class="bi bi-chevron-down m-2 pb-4 ms-auto" id='dropdown-arrow' style="height: 10px"></i>
                    </div>
                    <ul class="admin__navbar__vertical">
                        <h5>Services</h5>
                        <li>
                            Orders
                        </li>
                        <li>
                            Delivery
                        </li>

                        <h5>Transactions</h5>
                        <li>
                            Payments
                        </li>
                        <li>
                            Credit control
                        </li>

                        <h5>Products</h5>
                        <li onclick="showDropdown('catalog-dropdown')" class="d-flex">
                            <span>Catalog</span>
                            <i class="bi bi-chevron-down m-2 pb-4 ms-auto" style="height: 10px"></i>
                        </li>
                            <ul class="admin__navbar__vertical-dropdown" id='catalog-dropdown'>
                                <li class="ps-5" onclick="window.location='{{ url('product/') }}'">Add Product</li>
                                <li class="ps-5">Product Gallery</li>
                                <li class="ps-5">Products list</li>
                            </ul>
                        <li>
                            Prices
                        </li>
                        <li>
                            Offers
                        </li>

                        <h5>Analytics</h5>
                        <li>
                            Insights
                        </li>

                        <h5>Clients</h5>
                        <li>Customers Data</li>
                        <li>Messages</li>

                        <h5>Settings</h5>
                        <li onclick="showDropdown('main_page_settings-dropdown')" class="d-flex">
                            <span>Main Page Settings</span>
                            <i class="bi bi-chevron-down m-2 pb-4 ms-auto" style="height: 10px"></i>
                        </li>
                            <ul class="admin__navbar__vertical-dropdown" id='main_page_settings-dropdown'>
                                <li class="ps-5" onclick="window.location='{{ route('main_page_settings.website') }}'">Website Information</li>
                                <li class="ps-5" onclick="window.location='{{ url('product/') }}'">About Us</li>
                            </ul>
                    </ul>
            </nav>
            <nav class="bg-white flex-grow-1 d-flex p-2" style="height: 50px;">
                <button class="btn btn-primary ms-auto" onclick="window.location='{{ url('/') }}'">
                    Go to store
                </button>
                <button class="ms-2 btn" onclick="window.location='{{ url('logout') }}'">
                    Logout
                    <i class="bi bi-box-arrow-in-right"></i>
                </button>
            </nav>
        </div>
        <div class="container-fluid" style="height: calc(100vh - 50px); overflow-y: scroll;">
            @yield('content')
        </div>
    </div>


</body>
<script src={{asset('js/navbar.js')}}>

</script>
</html>
