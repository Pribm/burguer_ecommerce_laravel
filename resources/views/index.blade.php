<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{isset($site_info) ? $site_info->site_name : 'Burguer'}}</title>
    <link rel="icon" href={{route('get.image', ['path' => 'website', 'subpath' => 'images', 'image' => $site_info->favicon])}}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href={{asset('css/style.css')}}>
</head>

<body>
    <div class="all">
        <section class="vh-100 d-flex flex-column" id='hero_section'>
            <div class="d-flex justify-content-around align-items-center p-2">
                <a href="#" class="navbar__logo"><img src={{$site_info ? route('get.image', ['path' => 'website', 'subpath' => 'images', 'image' => $site_info->horizontal_logo]) : "../img/Logo.png"}} alt="burguerhouse" height='80'></a>
                <nav class="m-0 p-0 mt-auto mb-auto d-none d-md-inline-block">
                    <ul class="mt-auto m-0 p-0 ">
                        <li class="d-md-inline-block navbar__link mx-2"><a href="#hero_section">Home</a></li>
                        <li class="d-md-inline-block navbar__link mx-2"><a href="#menu_section">Menu</a></li>
                        <li class="d-md-inline-block navbar__link mx-2"><a href="#">Our Story</a></li>
                        <li class="d-md-inline-block navbar__link mx-2"><a href="#contact-us">Contact Us</a></li>
                        @if (session()->has('role') && session()->get('role') === 'admin')
                        <li class="d-md-inline-block navbar__link mx-2"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        @elseif (session()->has('role') && session()->get('role') === 'manager')
                        <li class="d-md-inline-block navbar__link mx-2"><a href="{{ route('admin.home') }}">Manager Area</a></li>
                        @elseif (session()->has('role') && session()->get('role') === 'user')
                        <li class="d-md-inline-block navbar__link mx-2 text-white position-relative">
                           <a href="{{ route('user.cart') }}" style="font-size: 1em;">
                                <span class="bg-danger position-absolute d-flex justify-content-center align-items-center" style="border-radius: 50%; right: -15px;width:1em; height: 1em; box-shadow: 0 0 0 5px red;">
                                    {{isset($total_items) ? $total_items : 0}}
                                </span>
                                <i class="fas fa-shopping-cart" style="font-size: 2em;"></i>
                           </a>
                        </li>
                        @else
                        <li class="d-md-inline-block navbar__link mx-2"><a href="{{ route('login') }}">Sign-in</a></li>
                        @endif
                    </ul>
                </nav>
            </div>

            <div class="container flex-grow-1">
                <div class="row m-4 m-md-0 h-100 align-items-center">
                    <div class="col-md-6" id='main_section_title'>
                        <h6>
                            {{isset($main_product) ? $main_product->secondary_text : 'Burguer item'}}
                        </h6>
                        <h1>
                            {{isset($main_product) ? $main_product->main_text : 'Burguer subtext'}}
                        </h1>
                    </div>

                    <div class="col-md-6 position-relative">
                        <div class="bg-danger position-absolute" id='price_tag'>
                            <h4>only</h4>
                            <h1>
                                {{isset($main_product) ? $main_product->price : '$3,95'}}
                            </h1>
                        </div>
                        <img class="w-100" src="{{isset($main_product) ? env('APP_URL').'/product/getThumbnail/'. $main_product->id .'/'. $main_product->image : url('/img/BurgerImage.png')}}" alt="a fancy hamburguer image">
                    </div>
                </div>
            </div>
        </section>

        <div class="part_two">
            <section class="gallery">
            <div class="gallery__left_side">
                <a href="#" class="gallery__left_side_container">
                    <h2>
                        TRY IT TODAY
                    </h2>
                    <h1>
                        MOST POPULAR BURGUER
                    </h1>
                </a>
            </div>

            <div class="gallery__right_side">
                <a href="#" class="gallery__right_side_container_row_1">
                    <h2>
                        TRY IT TODAY
                    </h2>
                    <h1>
                        MORE FUN
                    </h1>
                    <h1>
                        MORE TASTE
                    </h1>
                </a>
                <a href="#" class="gallery__right_side_container_row_2">
                    <h2>
                        TRY IT TODAY
                    </h2>
                    <h1>
                        FRESH & CHILI
                    </h1>
                </a>
            </div>
        </section>

        <section class="chooseBurguer" id="menu_section">
            <div class="chooseBurguer_row_1 container">
                <h4>ALWAYS TASTY BURGUER</h4>
                <h1>CHOOSE & ENJOY</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus, tempora nobis. Voluptas explicabo
                    debitis ipsam quod tenetur aliquam corrupti rem nihil nemo. Consequuntur ducimus voluptates voluptatem
                    voluptatibus, impedit ipsa dolorem.</p>
            </div>

            <div class="d-flex justify-content-center flex-wrap mx-5">
                @foreach ($products as $product)
                    <div class="d-flex p-4 flex-column align-items-center justify-content-between text-center chooseBurguer_card">
                        <div style="height: 200px; width: 100%; position: relative;">
                            <div class="bg-danger position-absolute text-white d-flex align-items-center justify-content-center"
                            style="bottom: 0px; right: 80px; width: 60px; height: 60px; border-radius: 50%; border: dashed white .5px; box-shadow: 0 0 0 2px #dc3545">
                                <h6>{{$product->price}}</h6>
                            </div>
                            <img style="height: 100%; object-fit:contain;" src="{{env('APP_URL').'/product/getThumbnail/'. $product->id .'/'. $product->image}}" alt="{{$product->secondary_text}}">
                        </div>
                        <h1>{{$product->main_text}}</h1>
                        <p>{{$product->secondary_text}}</p>
                        <a href="{{route('insert.cart', $product->id)}}">order now</a>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="carousel">
            <ul class="carousel__container">
                <li>
                    <div class="carousel__container_slide_1">
                        <div class="carousel__text_side">
                            <h2>DISCOVER</h2>
                            <h1>UPCOMING EVENTS</h1>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates laudantium minus ea
                                ratione atque aut molestias. Magnam neque placeat velit. Ut officiis illo ea, minus
                                accusamus molestiae perspiciatis rem doloribus.</p>
                        </div>
                        <div class="carousel__image_side">
                            imagem
                        </div>
                    </div>
                </li>

            </ul>
        </section>

        <section class="booking" id='contact-us'>
            <div class="booking__container">
                <div class="booking__title">
                    <h2>RESERVATION</h2>
                    <h1>BOOK YOUR TABLE</h1>
                </div>
                <form class="booking__data">
                    <input type="text" placeholder="name" name="" id="" class="booking__name">
                    <input type="text" placeholder="email" name="" id="" class="booking__email">
                    <input type="text" placeholder="date" name="" id="" class="booking__date">
                    <input type="text" placeholder="time" name="" id="" class="booking__time">
                    <input type="text" placeholder="people" name="" id="" class="booking__people">
                    <button type="submit" class="booking__findTable">Find a Table</button>
                </form>
            </div>
        </section>

        <section class="footer">
            <img src={{$site_info ? route('get.image', ['path' => 'website', 'subpath' => 'images', 'image' => $site_info->horizontal_logo]) : "../img/Logo.png"}} alt="footer_logo" height='100' class="footer__logo" style="filter: brightness(0) invert(1);">
            <div>
                <p class="footer__text m-0">
                    @if (isset($address))
                        {{$address->sublocality}} - {{$address->house_number}}, {{$address->zipcode}}
                    @else
                        Mockup Address - 255 - 68142-123
                    @endif
                </p>
                <h6>
                    @if (isset($address))
                        {{$address->city}} {{$address->state}}, {{$address->country}}
                    @else
                        Mockup Address - 255 - 68142-123
                    @endif
                </h6>
            </div>
            <p class="footer__credits">{{$site_info ? $site_info->footer_message : null}}</p>
            <div class="footer__contacts">
                <h3>Contact:</h3>
                <h3>{{$site_info->email_address  ? $site_info->email_address  : 'info@companyname.com'}}</h3>
            </div>
            <div class="footer__social_media_icons">
                <a href="#"><img src="../img/Instagram.png" alt=""></a>
                <a href="#"><img src="../img/Facebook.png" alt=""></a>
                <a href="#"><img src="../img/Twitter.png" alt=""></a>
                <a href="#"><img src="../img/Whatsapp.png" alt=""></a>
            </div>
        </section>
        </div>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/ScrollTrigger.min.js"></script>
<script src="../js/animationScripts.js"></script>


</html>
