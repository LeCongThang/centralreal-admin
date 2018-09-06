<section class="content-header">
    <h1>
        Trang chủ
        <small>{{$isEdit ? 'Thông tin tin tức': 'Thêm mới tin tức'}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>  Trang chủ</a></li>
        <li class="active">Tin tức</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
                {{ Form::open(['url' => $isEdit ? "news/update/$news->id": 'news/storage', 'method' => 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
                <div class="box">
                    <div class="box-header">
                        <a href="{{url('news')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Quay lại</a>
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
                                        <input type="text" class="form-control" name="title_vi" value="{{$isEdit ? $news->title_vi : old("title_vi")}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Giới thiệu ngắn (tối đa 250 ký tự)</label>
                                        <textarea class="form-control" rows="3" name="des_short_vi">{{$isEdit ? $news->des_short_vi : old("des_short_vi")}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Giới thiệu</label>
                                        <textarea class="form-control editors" name="description_vi" id="description_vi">{{$isEdit ? $news->description_vi : old("description_vi")}}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane" id="english">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title_en" value="{{$isEdit ? $news->title_en : old("title_en")}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Short description (max 250 character)</label>
                                        <textarea class="form-control" rows="3" name="des_short_en">{{$isEdit ? $news->des_short_en : old("des_short_en")}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control editors" name="description_en" id="description_en">{{$isEdit ? $news->description_en : old("description_en")}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <input type="checkbox" class="" name="is_featured" value="1" {{$isEdit ? ($news->is_featured ==1 ? 'checked':'') : 'checked'}}>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="post_type">
                                    <option value="1" {{$isEdit ? ($news->post_type == 1 ? 'selected':''):''}}>Tin tức</option>
                                    <option value="0" {{$isEdit ? ($news->post_type == 0 ? 'selected':''):''}}>Sự kiện</option>
                                    <option value="2" {{$isEdit ? ($news->post_type == 2 ? 'selected':''):''}}>Video</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh thumnail</label><br>
                                <label style="font-size: 10px">Tin tức (590 x 310px) | Sự kiện (900 x 390px)</label>
                                <img id="imgSmall1" src="{{$isEdit ? asset('images/news/'.$news->image_thumbnail) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">
                                <div class="input-group image-preview" style="margin-top: 10px">
                                    <input placeholder="" id="text-image1" type="text" value="{{$isEdit? $news->image:''}}" class="form-control image-preview-filename" disabled="disabled">
                                    <!-- don't give a name === doesn't send on POST/GET -->
                                    <span class="input-group-btn">
                                            <div class="btn btn-success image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="image_thumbnail" onchange="readURL1(this);"/>
                                                <!-- rename it -->
                                            </div>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh</label>
                                <img id="imgSmall" src="{{$isEdit ? asset('images/news/'.$news->image) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">
                                <div class="input-group image-preview" style="margin-top: 10px">
                                    <input placeholder="" id="text-image" type="text" value="{{$isEdit? $news->image:''}}" class="form-control image-preview-filename" disabled="disabled">
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
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgSmall1').attr('src', e.target.result);
                    $('#text-image1').val(input.files[0].name);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('.editors').each( function () {
            CKEDITOR.replace(this.id, {
                {{--filebrowserUploadUrl: '/uploader/news',--}}
                {{--filebrowserBrowseUrl:'{{URL::asset('')}}link-folder/news'--}}
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='

            });
        });
    </script>
@endsection
