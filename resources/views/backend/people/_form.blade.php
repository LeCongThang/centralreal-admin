<section class="content-header">
    <h1>
        Trang chủ
        <small>{{$isEdit ? 'Thông tin lãnh đạo': 'Thêm mới lãnh đạo'}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>  Trang chủ</a></li>
        <li class="active">Ban Lãnh Đạo</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['url' => $isEdit ? "people/update/$people->id": 'people/storage', 'method' => 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
            <div class="box">
                <div class="box-header">
                    <a href="{{url('people')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Quay lại</a>
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
                                    <label>Tiêu đề</label>
                                    <input type="text" class="form-control" name="name_vi" value="{{$isEdit ? $people->name_vi : old("name_vi")}}">
                                </div>
                                <div class="form-group">
                                    <label>Vị trí</label>
                                    <input type="text" class="form-control" name="position_vi" value="{{$isEdit ? $people->position_vi : old("position_vi")}}">
                                </div>
                                <div class="form-group">
                                    <label>Thông tin</label>
                                    <textarea class="form-control editors" name="description_vi" id="description_vi">{{$isEdit ? $people->description_vi : old("description_vi")}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="english">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="name_en" value="{{$isEdit ? $people->name_en : old("name_en")}}">
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" class="form-control" name="position_en" value="{{$isEdit ? $people->position_en : old("position_en")}}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control editors" name="description_en" id="description_en">{{$isEdit ? $people->description_en : old("description_en")}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Đang làm việc</label>
                            <input type="checkbox" id="is_active" style="width: 20px; height: 20px" name="is_active" {{$isEdit ? ($people->is_active ? 'checked':'') :''}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hình ảnh đại diện</label>
                            <img id="imgSmall" src="{{$isEdit ? asset('images/people/'.$people->avatar) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">
                            <div class="input-group image-preview" style="margin-top: 10px">
                                <input placeholder="" id="text-image" type="text" value="{{$isEdit? $people->avatar:''}}" class="form-control image-preview-filename" disabled="disabled">
                                <!-- don't give a name === doesn't send on POST/GET -->
                                <span class="input-group-btn">
                                        <div class="btn btn-success image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>
                                            <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar" onchange="readURL(this);"/>
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
        function ftDeleteImage(id) {
            document.getElementById('Img-'+id).style.display = "none";
            var t = $('#arrImage').val();
            $('#arrImage').val(t+id+',');

        }
        $('.editors').each( function () {
            CKEDITOR.replace(this.id, {
                filebrowserUploadUrl: '/uploader/people',
                filebrowserBrowseUrl:'{{URL::asset('')}}link-folder/people'
            });
        });
    </script>
@endsection
