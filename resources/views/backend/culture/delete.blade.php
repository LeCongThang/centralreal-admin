<div class="modal fade" id="modal_DeleteCulture">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận xóa lãnh đạo</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{asset('images/prople')}}/{{$culture->avatar}}" style="width: 300px">
                            </td>
                            <td>{{$culture->title_vi}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                {{ Form::open(['url' => url('culture/destroy/'.$culture->id), 'method' => 'DELETE']) }}
                    <button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                {{ Form::close() }}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>