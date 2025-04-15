@php
use Darryldecode\Cart\Facades\CartFacade as Cart;


@endphp
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biolife - Organic Food</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/nice-select.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main-color.css">

</head>
<body class="biolife-body">

    <!-- Preloader -->
    <div id="biof-loading">
        <div class="biof-loading-center">
            <div class="biof-loading-center-absolute">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    @include('layouts.header')


        <!--Hero Section-->
        <div class="hero-section hero-background">
        <h1 class="page-title">Organic Fruits</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">ShoppingCart</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain shopping-cart">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">

                <!--Top banner-->
                <div class="top-banner background-top-banner-for-shopping min-height-346px">
                    <h3 class="title">Save $50!*</h3>
                    <p class="subtitle">Save $50 when you open an account online & spen $50 on your first online purchase to day</p>
                    <ul class="list">
                        <li>
                            <div class="price-less">
                                <span class="desc">Purchase amount</span>
                                <span class="cost">$0.00</span>
                            </div>
                        </li>
                        <li>
                            <div class="price-less">
                                <span class="desc">Credit on billing statement</span>
                                <span class="cost">$0.00</span>
                            </div>
                        </li>
                        <li>
                            <div class="price-less sum">
                                <span class="desc">Cost affter statemen credit</span>
                                <span class="cost">$0.00</span>
                            </div>
                        </li>
                    </ul>
                    <p class="btns">
                        <a href="#" class="btn">Open Account</a>
                        <a href="#" class="btn">Learn more</a>
                    </p>
                </div>

                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">Your cart items</h3>
                            <form class="shopping-cart-form" action="#" method="post">
                                <table class="shop_table cart-form">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product Name</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cartList as $cartItem)
                                    <tr class="cart_item">
                                        <td class="product-thumbnail" data-title="Product Name">
                                            <a class="prd-thumb" href="#">
                                                <figure><img width="113" height="113" src="assets/images/shippingcart/pr-01.jpg" alt="shipping cart"></figure>
                                            </a>
                                            <a class="prd-name" href="#">{{ $cartItem->name }}</a>
                                            <div class="action">
                                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="remove"></a>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                                </button>
                                            </form>
                                            </div>
                                        </td>
                                        <td class="product-price" data-title="Price">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol"></span>{{ $cartItem->price . ' DH' }}</span> </ins>
                                            </div>
                                        </td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity-box type1">
                                                <div class="qty-input">
                                                    <input type="text" name="qty12554" value="{{ $cartItem->quantity }}" data-max_value="20" data-min_value="1" data-step="1" disabled>
                                                    <!-- <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a> -->
                                                    <!-- <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a> -->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol"></span> {{ $cartItem->quantity * $cartItem->price . ' DH' }} </span></ins>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="cart_item wrap-buttons">
                                        <td class="wrap-btn-control " colspan="4">
                                            <a class="btn back-to-shop">Back to Shop</a>
                                            <div class="" style="display:flex; flex-direction:row;justify-content:flex-end">
                                                <!-- <button class="btn btn-update" type="submit" disabled>update</button> -->
                                                <form action="{{ route('cart.destroy') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-clear">
                                                        <i class="fas fa-trash-alt"></i> Clear Cart
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="shpcart-subtotal-block">
                                <div class="subtotal-line">
                                    <b class="stt-name">Subtotal <span class="sub">{{$cartCount}}</span></b>
                                    <span class="stt-price">{{ $total }} DH</span>
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name">Shipping</b>
                                    <span class="stt-price">30 DH</span>
                                </div>
                                <div class="btn-checkout">
                                    <a href="#" class="btn checkout">Check out</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- FOOTER -->
    @include('layouts.footer')

<!--Footer For Mobile-->
<div class="mobile-footer">
    <div class="mobile-footer-inner">
        <div class="mobile-block block-menu-main">
            <a class="menu-bar menu-toggle btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                <span class="fa fa-bars"></span>
                <span class="text">Menu</span>
            </a>
        </div>
        <div class="mobile-block block-sidebar">
            <a class="menu-bar filter-toggle btn-toggle" data-object="open-mobile-filter" href="javascript:void(0)">
                <i class="fa fa-sliders" aria-hidden="true"></i>
                <span class="text">Sidebar</span>
            </a>
        </div>
        <div class="mobile-block block-minicart">
            <a class="link-to-cart" href="#">
                <span class="fa fa-shopping-bag" aria-hidden="true"></span>
                <span class="text">Cart</span>
            </a>
        </div>
        <div class="mobile-block block-global">
            <a class="menu-bar myaccount-toggle btn-toggle" data-object="global-panel-opened" href="javascript:void(0)">
                <span class="fa fa-globe"></span>
                <span class="text">Global</span>
            </a>
        </div>
    </div>
</div>

<!--Mobile Global Menu-->
<div class="mobile-block-global">
    <div class="biolife-mobile-panels">
        <span class="biolife-current-panel-title">Global</span>
        <a class="biolife-close-btn" data-object="global-panel-opened" href="#">&times;</a>
    </div>
    <div class="block-global-contain">
        <div class="glb-item my-account">
            <b class="title">My Account</b>
            <ul class="list">
                <li class="list-item"><a href="#">Login/register</a></li>
                <li class="list-item"><a href="#">Wishlist <span class="index">(8)</span></a></li>
                <li class="list-item"><a href="#">Checkout</a></li>
            </ul>
        </div>
        <div class="glb-item currency">
            <b class="title">Currency</b>
            <ul class="list">
                <li class="list-item"><a href="#">€ EUR (Euro)</a></li>
                <li class="list-item"><a href="#">$ USD (Dollar)</a></li>
                <li class="list-item"><a href="#">£ GBP (Pound)</a></li>
                <li class="list-item"><a href="#">¥ JPY (Yen)</a></li>
            </ul>
        </div>
        <div class="glb-item languages">
            <b class="title">Language</b>
            <ul class="list inline">
                <li class="list-item"><a href="#"><img src="assets/images/languages/us.jpg" alt="flag" width="24" height="18"></a></li>
                <li class="list-item"><a href="#"><img src="assets/images/languages/fr.jpg" alt="flag" width="24" height="18"></a></li>
                <li class="list-item"><a href="#"><img src="assets/images/languages/ger.jpg" alt="flag" width="24" height="18"></a></li>
                <li class="list-item"><a href="#"><img src="assets/images/languages/jap.jpg" alt="flag" width="24" height="18"></a></li>
            </ul>
        </div>
    </div>
</div>

<!--Quickview Popup-->
<div id="biolife-quickview-block" class="biolife-quickview-block">
    <div class="quickview-container">
        <a href="#" class="btn-close-quickview" data-object="open-quickview-block"><span class="biolife-icon icon-close-menu"></span></a>
        <div class="biolife-quickview-inner">
            <div class="media">
                <ul class="biolife-carousel quickview-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".quickview-nav"}'>
                    <li><img src="assets/images/details-product/detail_01.jpg" alt="" width="500" height="500"></li>
                    <li><img src="assets/images/details-product/detail_02.jpg" alt="" width="500" height="500"></li>
                    <li><img src="assets/images/details-product/detail_03.jpg" alt="" width="500" height="500"></li>
                    <li><img src="assets/images/details-product/detail_04.jpg" alt="" width="500" height="500"></li>
                    <li><img src="assets/images/details-product/detail_05.jpg" alt="" width="500" height="500"></li>
                    <li><img src="assets/images/details-product/detail_06.jpg" alt="" width="500" height="500"></li>
                    <li><img src="assets/images/details-product/detail_07.jpg" alt="" width="500" height="500"></li>
                </ul>
                <ul class="biolife-carousel quickview-nav" data-slick='{"arrows":true,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":3,"slidesToScroll":1,"asNavFor":".quickview-for"}'>
                    <li><img src="assets/images/details-product/thumb_01.jpg" alt="" width="88" height="88"></li>
                    <li><img src="assets/images/details-product/thumb_02.jpg" alt="" width="88" height="88"></li>
                    <li><img src="assets/images/details-product/thumb_03.jpg" alt="" width="88" height="88"></li>
                    <li><img src="assets/images/details-product/thumb_04.jpg" alt="" width="88" height="88"></li>
                    <li><img src="assets/images/details-product/thumb_05.jpg" alt="" width="88" height="88"></li>
                    <li><img src="assets/images/details-product/thumb_06.jpg" alt="" width="88" height="88"></li>
                    <li><img src="assets/images/details-product/thumb_07.jpg" alt="" width="88" height="88"></li>
                </ul>
            </div>
            <div class="product-attribute">
                <h4 class="title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                <div class="rating">
                    <p class="star-rating"><span class="width-80percent"></span></p>
                </div>

                <div class="price price-contain">
                    <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                    <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                </div>
                <p class="excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel maximus lacus. Duis ut mauris eget justo dictum tempus sed vel tellus.</p>
                <div class="from-cart">
                    <div class="qty-input">
                        <input type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1" data-step="1">
                        <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                        <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                    </div>
                    <div class="buttons">
                        <a href="#" class="btn add-to-cart-btn btn-bold">add to cart</a>
                    </div>
                </div>

                <div class="product-meta">
                    <div class="product-atts">
                        <div class="product-atts-item">
                            <b class="meta-title">Categories:</b>
                            <ul class="meta-list">
                                <li><a href="#" class="meta-link">Milk & Cream</a></li>
                                <li><a href="#" class="meta-link">Fresh Meat</a></li>
                                <li><a href="#" class="meta-link">Fresh Fruit</a></li>
                            </ul>
                        </div>
                        <div class="product-atts-item">
                            <b class="meta-title">Tags:</b>
                            <ul class="meta-list">
                                <li><a href="#" class="meta-link">food theme</a></li>
                                <li><a href="#" class="meta-link">organic food</a></li>
                                <li><a href="#" class="meta-link">organic theme</a></li>
                            </ul>
                        </div>
                        <div class="product-atts-item">
                            <b class="meta-title">Brand:</b>
                            <ul class="meta-list">
                                <li><a href="#" class="meta-link">Fresh Fruit</a></li>
                            </ul>
                        </div>
                    </div>
                    <span class="sku">SKU: N/A</span>
                    <div class="biolife-social inline add-title">
                        <span class="fr-title">Share:</span>
                        <ul class="socials">
                            <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                            <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scroll Top Button -->
<a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/jquery.nicescroll.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/biolife.framework.js"></script>
<script src="assets/js/functions.js"></script>
</body>

</html>