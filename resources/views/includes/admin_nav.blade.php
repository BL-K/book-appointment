<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li>
                <div class="left-bg"></div>
            </li>
            <li class="time">
                <h1 class="animated fadeInLeft">00:00</h1>
                {{-- <p class="animated fadeInRight">Mon,Junuary 1st 2022</p> --}}
            </li>
            <li class="ripple">
                <a href="{{ URL::to('admin/dashboard') }}"><span class="fa-solid fa-house-user"></span>Bảng điều khiển
                </a>
            </li>

            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-solid fa-hospital"></span>Bệnh viện
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to('admin/hospital_list') }}">Danh sách bệnh viện</a></li>
                    <li><a href="{{ URL::to('admin/hospital_add') }}">Tạo bệnh viện</a></li>
                </ul>
            </li>

            <li class="ripple"><a href="{{ URL::to('admin/speciality') }}">
                    <span class="fa-solid fa-book-medical"></span> Chuyên khoa </a>
            </li>

            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-solid fa-user-doctor"></span> Bác sĩ
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to('admin/doctor_list') }}"> Danh sách bác sĩ</a></li>
                    <li><a href="{{ URL::to('admin/doctor_add') }}">Tạo bác sĩ</a></li>
                </ul>
            </li>

            <li class="ripple"><a href="{{ URL::to('admin/patient') }}">
                    <span class="fa-solid fa-hospital-user"></span>Bệnh nhân</a>
            </li>

            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-solid fa-calendar-check"></span> Lịch hẹn
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to('admin/appointment_day') }}">Lịch hẹn trong ngày</a></li>
                    <li><a href="{{ URL::to('admin/appointment') }}"> Tất cả lịch hẹn</a></li>
                </ul>
            </li>

            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-solid fa-blog"></span> Blog
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to('admin/blog_list') }}"> Danh sách blog</a></li>
                    <li><a href="{{ URL::to('admin/blog_add') }}">Tạo blog</a></li>
                </ul>
            </li>

            <li class="ripple"><a href="{{ URL::to('admin/cooperation_list') }}">
              <span class="fa-solid fa-code-pull-request"></span> Hợp tác </a>
            </li>
        </ul>
    </div>
</div>
