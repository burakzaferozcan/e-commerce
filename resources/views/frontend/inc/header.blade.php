<header class="site-navbar" role="banner">
    <div class="site-navbar-top">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                    <form action="" class="site-block-top-search">
                        <span class="icon icon-search2"></span>
                        <input type="text" class="form-control border-0" placeholder="Ara">
                    </form>
                </div>

                <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                    <div class="site-logo">
                        <a href="{{ route('home') }}" class="js-logo-clone">Shoppers</a>
                    </div>
                </div>

                <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                    <div class="site-top-icons">
                        <ul>
                            <li><a href="#"><span class="icon icon-person"></span></a></li>
                            <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                            <li>
                                <a href="{{ route('cart') }}" class="site-cart">
                                    <span class="icon icon-shopping_cart"></span>
                                    <span class="count">{{session()->get("cart")? count(session("cart")) : 0}}</span>
                                </a>
                            </li>
                            <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                    class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
            <ul class="site-menu js-clone-nav d-none d-md-block">
                <li><a href="{{ route('home') }}">Anasayfa</a></li>
                <li class="has-children active">
                    <a href="{{ route('home') }}">Kategoriler</a>
                    <ul class="dropdown">
                        @if (!empty($categories) && $categories->count() > 0)
                            @foreach ($categories->where('cat_ust', null) as $category)
                                <li class="has-children">
                                    <a href="{{ route($category->slug . '_products') }}">{{ $category->name }}</a>
                                    <ul class="dropdown">
                                        @foreach ($category->subcategory as $subCategory)
                                            <li><a
                                                    href="{{ route($category->slug . '_products', $subCategory->slug) }}">{{ $subCategory->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{ route('about') }}">Hakkımızda</a>
                </li>
                <li><a href="{{ route('products') }}">Ürünler</a></li>
                <li><a href="{{ route('contact') }}">İletişim</a></li>
            </ul>
        </div>
    </nav>
</header>
