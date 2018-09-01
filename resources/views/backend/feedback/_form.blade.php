<section class="content-header">
    <h1>
        Trang chủ
        <small>{{$isEdit ? 'Thông tin feedback': 'Thêm mới feedback'}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>  Trang chủ</a></li>
        <li class="active">feedback</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
                {{ Form::open(['url' => $isEdit ? "feedback/update/$feedback->id": 'feedback/storage', 'method' => 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
                <div class="box">
                    <div class="box-header">
                        <a href="{{url('feedback')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-8">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#vietnam" data-toggle="tab">Tiếng Viêt</a></li>
                                    <li><a href="#english" data-toggle="tab">English</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="active tab-pane" id="vietnam">
                                    <div class="form-group">
                                        <label>Giới thiệu</label>
                                        <textarea class="form-control editors" name="content_vi" id="content_vi">{{$isEdit ? $feedback->content_vi : old("description_vi")}}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane" id="english">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control editors" name="content_en" id="content_en">{{$isEdit ? $feedback->content_en : old("description_en")}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" name="client_name" value="{{$isEdit ? $feedback->client_name : old("client_name")}}">
                            </div>
                            <div class="form-group">
                                <label>Số sao</label>
                                <input type="number" class="form-control" name="star" value="{{$isEdit ? $feedback->star : old("star")}}">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label><br>
                                <label for="show">
                                    <input type="radio" value="1" name="is_active" {{$isEdit ? $feedback->is_active ? 'checked':'' :'checked'}} id="show">Hiển thị
                                </label>
                                <label for="hide" style="margin-left: 20px">
                                    <input type="radio" value="0" name="is_active" {{$isEdit ? $feedback->is_active ? '':'checked' :''}} id="hide">Ẩn
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh (90 x 90px)</label>
                                <img id="imgSmall" src="{{$isEdit ? asset('images/feedback/'.$feedback->image) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">
                                <div class="input-group image-preview" style="margin-top: 10px">
                                    <input placeholder="" id="text-image1" type="text" value="{{$isEdit? $feedback->image:''}}" class="form-control image-preview-filename" disabled="disabled">
                                    <!-- don't give a name === doesn't send on POST/GET -->
                                    <span class="input-group-btn">
                                            <div class="btn btn-success image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="image" onchange="readURL(this);"/>
                                                <!-- rename it -->
                                            </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">

                    </div>
                </div>
                {{ Form::close() }}
        </div>

    </div>
</section>
@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgSmall').attr('src', e.target.result);
                    $('#text-image').val(input.files[0].name);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('.editors').each( function () {
            CKEDITOR.replace(this.id, {
            });
        });
    </script>
@endsection
