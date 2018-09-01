<div class="modal fade" id="modal_DeleteRecruitment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận xóa tuyển dụng</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Ngày hết hạn</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$recruitment->title_vi}}</td>
                            <td><img src="{{asset('images/recruitment')}}/{{$recruitment->image}}" style="width: 300px"></td>
                            <td>{{\Carbon\Carbon::parse($recruitment->date)->format('d-m-Y')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                {{ Form::open(['url' => url('recruitment/destroy/'.$recruitment->id), 'method' => 'DELETE']) }}
                    <button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                {{ Form::close() }}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>