<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Slider</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.slider.index')}}">Slider Görüntüle</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.slider.create')}}">Slider Ekle</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kategoriler</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.category.index')}}">Kategori Görüntüle</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.category.create')}}">Kategori Ekle</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.about.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Hakkımızda</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.contact.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Gelen Kutusu</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.setting.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Site Ayarları</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Siparişler</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.order.index')}}">Siparişler</a></li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
