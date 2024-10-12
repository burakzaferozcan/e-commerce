<footer class="site-footer border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-6">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="footer-heading mb-4">Menü</h3>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}">Anasayfa</a></li>
                            <li><a href="{{ route('about') }}">Hakkımızda</a></li>
                            <li><a href="{{ route('products') }}">Ürüler</a></li>
                            <li><a href="{{ route('contact') }}">İletişim</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">İletişim</h3>
                    <ul class="list-unstyled">
                        <li class="address">Kocaeli Türkiye</li>
                        <li class="phone"><a href="tel://0262 262 62 62">0262 262 62 62</a></li>
                        <li class="email">test@domain.com</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <p>
                    Copyright &copy;
                    {{ date('Y') }} Tüm hakları saklıdır. <i class="icon-heart" aria-hidden="true"></i>
                </p>
            </div>

        </div>
    </div>
</footer>
