<div class="modal fade" id="modal_Deletegallery">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Xác nhận xóa gallery</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{asset('images/gallery')}}/{{$gallery->gallery_images[0]->image}}" style="width: 300px">
                            </td>
                            <td>{{$gallery->title_vi}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                {{ Form::open(['url' => url('gallery/destroy/'.$gallery->id), 'method' => 'DELETE']) }}
                    <button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                {{ Form::close() }}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>