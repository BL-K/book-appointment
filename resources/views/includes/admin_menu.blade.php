<nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-12 nav-wrapper">
      <div class="navbar-header" style="width:100%;">
        <div class="opener-left-menu is-open">
          <span class="top"></span>
          <span class="middle"></span>
          <span class="bottom"></span>
        </div>
          <a href="{{URL::to('admin/dashboard')}}" class="navbar-brand"> 
           <b>MEDICAL REGISTER - TRANG QUẢN TRỊ</b>
          </a>
        <ul class="nav navbar-nav navbar-right user-nav">
          <li class="user-name"><span>{{ Auth::user()->name }}</span></li>
          <li class="dropdown avatar-dropdown">
            <a class="fa-solid fa-user-tie" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></a>
            <ul class="dropdown-menu user-dropdown">
               <li><a href="{{URL::to('admin/admin_account')}}"><span class="fa fa-user"></span> Tài khoản</a></li>
               <li role="separator" class="divider"></li>
                  <li><a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                  <span class="fa fa-power-off "></span> {{ __('Đăng xuất') }} </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </li>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>