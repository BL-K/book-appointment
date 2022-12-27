<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <a href="{{ URL::to('home') }}" class="navbar-brand logo">
                <h4 style="color:rgb(45, 114, 182);">Medical Register</h4>
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="{{ URL::to('home') }}" class="menu-logo">
                    <h6 style="color:rgb(45, 114, 182);">Medical Register</h6>
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                <li class="has-submenu">
                    <a href="{{ URL::to('home') }}">Trang chủ</a>
                </li>
                <li class="has-submenu">
                    <a href="#">Đặt lịch <i class="fas fa-chevron-down"></i></a>
                    <ul class="submenu">
                        <li><a href="{{URL::to ('hospital')}}">Theo bệnh viện</a></li>
                        <li><a href="{{URL::to ('speciality')}}">Theo chuyên khoa</a></li>
                        <li><a href="{{URL::to ('doctor')}}">Theo bác sĩ</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="{{ URL::to('blog') }}">Blog</a>
                </li>
                <li class="has-submenu">
                    <a href="{{ URL::to('history') }}">Lịch sử đặt lịch</a>
                </li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            <li class="nav-item contact-item">
                <div class="header-contact-detail">
                    <a href="{{ URL::to('support') }}">Hỗ trợ</a>
                    <i class="fa-solid fa-question"></i>
                </div>
                <div class="header-contact-detail">
                    <a href="{{ URL::to('auth/login') }}" class="nav-link header-login">Đăng nhập</a>
                </div>
            </li>
        </ul>
    </nav>
</header>
