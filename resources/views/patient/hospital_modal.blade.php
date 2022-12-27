@foreach ($user as $user_list)
    <div class="modal fade" id="exampleModal{{ $user_list->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin bệnh viện</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><img src="{{ URL::to('public/' . $user_list->hospital->hospital_image) }}" class="img-fluid"
                            alt="Hình bệnh viện" class="table-user-thumb" width="200"></p>
                    <p class="badge badge-pill badge-dark" style="font-size: 15px;">{{ $user_list->name }}</p>
                    <p>Số điện thoại: {{ $user_list->hospital->hospital_contact }}</p>
                    <p>Địa chỉ Email: {{ $user_list->email }}</p>
                    <p>Địa chỉ: {{ $user_list->hospital->hospital_address }}, {{ $user_list->hospital->hospital_city }}
                    </p>
                    <p>Thời gian làm việc:
                        <br>
                        <br class="col-xs-2"><span class="badge badge-info px-3 py-1">Thứ hai - Thứ sáu</span>
                        <br>
                        {{ date('H:i', strtotime($user_list->hospital->open_week)) }} --
                        {{ date('H:i', strtotime($user_list->hospital->close_week)) }}
                        <br>
                        <br class="col-xs-2"><span class="badge badge-info px-3 py-1">Thứ bảy</span>
                        <br>
                        {{ date('H:i', strtotime($user_list->hospital->open_sat)) }} --
                        {{ date('H:i', strtotime($user_list->hospital->close_sat)) }}
                        <br>
                        <br class="col-xs-2"><span class="badge badge-info px-3 py-1">Chủ nhật</span>
                        <br>
                        {{ date('H:i', strtotime($user_list->hospital->open_sun)) }} --
                        {{ date('H:i', strtotime($user_list->hospital->close_sun)) }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
