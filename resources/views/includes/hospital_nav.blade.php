<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li>
                <div class="left-bg"></div>
            </li>
            <li class="time">
                <h1 class="animated fadeInLeft">00:00</h1>
            </li>
            <li class="ripple">
                <a href="{{ URL::to('hospital/dashboard') }}"><span class="fa-solid fa-house-user"></span>Bảng điều khiển
                </a>
            </li>

            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-solid fa-user-doctor"></span> Bác sĩ
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to('hospital/doctor_list') }}">Danh sách bác sĩ</a></li>
                    <li><a href="{{ URL::to('hospital/doctor_add') }}">Tạo bác sĩ</a></li>
                </ul>
            </li>

            <li class="ripple"><a href="{{ URL::to('hospital/patient') }}">
                    <span class="fa-solid fa-calendar-plus"></span> Bệnh nhân</a>
            </li>

            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-solid fa-calendar-check"></span> Lịch hẹn
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to('hospital/appointment_day') }}">Lịch hẹn trong ngày</a></li>
                    <li><a href="{{ URL::to('hospital/appointment') }}">Tất cả lịch hẹn</a></li>
                </ul>
            </li>

            <li class="ripple"><a href="{{ URL::to('hospital/slot') }}">
                    <span class="fa-solid fa-calendar-plus"></span> Khung giờ khám bệnh</a>
            </li>

            <li class="ripple"><a href="{{ URL::to('hospital/review') }}">
                    <span class="fa-solid fa-star"></span> Đánh giá</a>
            </li>

            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-solid fa-file-export"></span> Báo cáo
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to('hospital/patient_report') }}">Bệnh nhân</a></li>
                    <li><a href="{{ URL::to('hospital/appointment_report') }}">Lịch hẹn</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
