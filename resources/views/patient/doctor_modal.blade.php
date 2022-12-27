@foreach ($doctor as $doc_list)
    <div class="modal fade" id="exampleModal{{ $doc_list->doctor_id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin bác sĩ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><img src="{{ URL::to('public/' . $doc_list->doctor_avatar) }}" class="img-fluid"
                            alt="Hình bác sĩ" class="table-user-thumb" width="200"></p>
                    <p class="badge badge-pill badge-dark" style="font-size: 15px;">Bác sĩ {{ $doc_list->doctor_name }}
                    </p>
                    <p>{{ $doc_list->user['name'] }}</p>
                    <p>Chuyên khoa: {{ $doc_list->speciality_name }}</p>
                    <p>Kinh nghiệm: {{ $doc_list->doctor_experience }} năm</p>
                    <p>Giới tính: {{ $doc_list->doctor_gender }}</p>
                    <p>Số điện thoại: {{ $doc_list->doctor_contact }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
