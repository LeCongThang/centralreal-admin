<section class="content-header">
    <h1>
        Trang chủ
        <small>{{$isEdit ? 'Thông tin dự án': 'Thêm mới dự án'}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>  Trang chủ</a></li>
        <li class="active">dự án</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['url' => $isEdit ? "project/update/$project->id": 'project/storage', 'method' => 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
            <div class="box">
                <div class="box-header">
                    <a href="{{url('project')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Quay lại</a>
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
                                    <input type="text" class="form-control" name="title_vi" value="{{$isEdit ? $project->title_vi : old("title_vi")}}">
                                </div>

                                <div class="form-group">
                                    <label>Vị trí dự án</label>
                                    <input type="text" class="form-control" name="location_vi" value="{{$isEdit ? $project->location_vi : old("location_vi")}}">
                                </div>

                                <div class="form-group">
                                    <label>Giới thiệu ngắn (tối đa 250 ky tự)</label>
                                    <textarea class="form-control" maxlength="250" rows="3" name="des_short_vi" id="des_short_vi">{{$isEdit ? $project->des_short_vi : old("des_short_vi")}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Thông tin</label>
                                    <textarea class="form-control editors" name="description_vi" id="description_vi">{{$isEdit ? $project->description_vi : old("description_vi")}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="english">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title_en" value="{{$isEdit ? $project->title_en : old("title_en")}}">
                                </div>

                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" class="form-control" name="location_en" value="{{$isEdit ? $project->location_en : old("location_en")}}">
                                </div>

                                <div class="form-group">
                                    <label> Short description (max 250 character)</label>
                                    <textarea class="form-control" maxlength="250" rows="3" name="des_short_en" id="des_short_en">{{$isEdit ? $project->des_short_en : old("des_short_en")}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control editors" name="description_en" id="description_en">{{$isEdit ? $project->description_en : old("description_en")}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
                            <input type="checkbox" id="is_sale" style="width: 20px; height: 20px" name="is_sale" {{$isEdit ? ($project->is_sale ? 'checked':'') :''}}>
                                Dự án đang bán</label>
                        </div>
                        <div class="form-group" id="div_sort_order">
                            <label>Thứ tự</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{$isEdit ? $project->sort_order : '1'}}">
                        </div>
                        <div class="form-group">
                            <label>Loại dự án</label>
                            <select class="form-control" name="category_id">
                                @foreach($category as $item)
                                    <option value="{{$item->id}}" {{$isEdit ? ($project->category_id == $item->id ? 'selected':''):''}}>{{$item->title_vi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Chủ đầu tư</label>
                            <select class="form-control" name="partner_id">
                                @foreach($partner as $item)
                                    <option value="{{$item->id}}" {{$isEdit ? ($project->partner_id == $item->id ? 'selected':''):''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hình ảnh đại diện (900 x 600px)</label>
                            <img id="imgSmall" src="{{$isEdit ? asset('images/project/'.$project->image) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">
                            <div class="input-group image-preview" style="margin-top: 10px">
                                <input placeholder="" id="text-image" type="text" value="{{$isEdit? $project->image:''}}" class="form-control image-preview-filename" disabled="disabled">
                                <!-- don't give a name === doesn't send on POST/GET -->
                                <span class="input-group-btn">
                                        <div class="btn btn-success image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>
                                            <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar" onchange="readURL(this);"/>
                                            <!-- rename it -->
                                        </div>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>SEO Keywords</label>
                            <textarea class="form-control" rows="9" name="keywords" id="keywords">{{$isEdit ? $project->keywords : old("keywords")}}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">

                </div>
            </div>
            {{--<div class="col-md-12">--}}
                    {{--<div class="box box-danger">--}}
                        {{--<div class="box-header"><h4>Thông tin giới thiệu</h4></div>--}}
                        {{--<div class="box-body">--}}
                            {{--<div class="col-md-8">--}}
                                {{--<div class="nav-tabs-custom">--}}
                                    {{--<ul class="nav nav-tabs">--}}
                                        {{--<li class="active"><a href="#vietnam_about" data-toggle="tab">Tiếng Viêt</a></li>--}}
                                        {{--<li><a href="#english_about" data-toggle="tab">English</a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                                {{--<div class="tab-content">--}}
                                    {{--<div class="active tab-pane" id="vietnam_about">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Thông tin</label>--}}
                                            {{--<textarea class="form-control editors" name="des_about_vi" id="des_about_vi">{{$isEdit ? $project->des_about_vi : old("des_about_vi")}}</textarea>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="tab-pane" id="english_about">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Description</label>--}}
                                            {{--<textarea class="form-control editors" name="des_about_en" id="des_about_en">{{$isEdit ? $project->des_about_en : old("des_about_en")}}</textarea>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="exampleInputPassword1">Hình ảnh giới thiệu (900 x 600px)</label>--}}
                                    {{--<img id="imgSmall_about" src="{{$isEdit ? asset('images/project/'.$project->image_about) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">--}}
                                    {{--<div class="input-group image-preview" style="margin-top: 10px">--}}
                                        {{--<input placeholder="" id="text-image_about" type="text" value="{{$isEdit? $project->image_about:''}}" class="form-control image-preview-filename" disabled="disabled">--}}
                                        {{--<!-- don't give a name === doesn't send on POST/GET -->--}}
                                        {{--<span class="input-group-btn">--}}
                                            {{--<div class="btn btn-success image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>--}}
                                                {{--<input type="file" accept="image/png, image/jpeg, image/gif" name="avatar_about" onchange="readURL_about(this);"/>--}}
                                                {{--<!-- rename it -->--}}
                                            {{--</div>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="box box-danger">--}}
                    {{--<div class="box-header"><h4>Thông tin vị trí</h4></div>--}}
                    {{--<div class="box-body">--}}
                        {{--<div class="col-md-8">--}}
                            {{--<div class="nav-tabs-custom">--}}
                                {{--<ul class="nav nav-tabs">--}}
                                    {{--<li class="active"><a href="#vietnam_locatione" data-toggle="tab">Tiếng Viêt</a></li>--}}
                                    {{--<li><a href="#english_location" data-toggle="tab">English</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="tab-content">--}}
                                {{--<div class="active tab-pane" id="vietnam_locatione">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Thông tin</label>--}}
                                        {{--<textarea class="form-control editors" name="des_location_vi" id="des_location_vi">{{$isEdit ? $project->des_location_vi : old("des_location_vi")}}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="english_location">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Description</label>--}}
                                        {{--<textarea class="form-control editors" name="des_location_en" id="des_location_en">{{$isEdit ? $project->des_location_en : old("des_location_en")}}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputPassword1">Hình ảnh vị trí (900 x 600px)</label>--}}
                                {{--<img id="imgSmall_location" src="{{$isEdit ? asset('images/project/'.$project->image_location) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">--}}
                                {{--<div class="input-group image-preview" style="margin-top: 10px">--}}
                                    {{--<input placeholder="" id="text-image_location" type="text" value="{{$isEdit? $project->image_location:''}}" class="form-control image-preview-filename" disabled="disabled">--}}
                                    {{--<!-- don't give a name === doesn't send on POST/GET -->--}}
                                    {{--<span class="input-group-btn">--}}
                                            {{--<div class="btn btn-success image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>--}}
                                                {{--<input type="file" accept="image/png, image/jpeg, image/gif" name="avatar_location" onchange="readURL_location(this);"/>--}}
                                                {{--<!-- rename it -->--}}
                                            {{--</div>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="box box-danger">--}}
                    {{--<div class="box-header"><h4>Thông tin tiện ích</h4></div>--}}
                    {{--<div class="box-body">--}}
                        {{--<div class="col-md-8">--}}
                            {{--<div class="nav-tabs-custom">--}}
                                {{--<ul class="nav nav-tabs">--}}
                                    {{--<li class="active"><a href="#vietnam_utility" data-toggle="tab">Tiếng Viêt</a></li>--}}
                                    {{--<li><a href="#english_utility" data-toggle="tab">English</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="tab-content">--}}
                                {{--<div class="active tab-pane" id="vietnam_utility">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Thông tin</label>--}}
                                        {{--<textarea class="form-control editors" name="des_utility_vi" id="des_utility_vi">{{$isEdit ? $project->des_utility_vi : old("des_utility_vi")}}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="english_utility">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Description</label>--}}
                                        {{--<textarea class="form-control editors" name="des_utility_en" id="des_utility_en">{{$isEdit ? $project->des_utility_en : old("des_utility_en")}}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputPassword1">Hình ảnh tiện ích (900 x 600px)</label>--}}
                                {{--<img id="imgSmall_utility" src="{{$isEdit ? asset('images/project/'.$project->image_utility) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">--}}
                                {{--<div class="input-group image-preview" style="margin-top: 10px">--}}
                                    {{--<input placeholder="" id="text-image_utility" type="text" value="{{$isEdit? $project->image_utility:''}}" class="form-control image-preview-filename" disabled="disabled">--}}
                                    {{--<!-- don't give a name === doesn't send on POST/GET -->--}}
                                    {{--<span class="input-group-btn">--}}
                                            {{--<div class="btn btn-success image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>--}}
                                                {{--<input type="file" accept="image/png, image/jpeg, image/gif" name="avatar_utility" onchange="readURL_utility(this);"/>--}}
                                                {{--<!-- rename it -->--}}
                                            {{--</div>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="box box-danger">--}}
                    {{--<div class="box-header"><h4>Thông tin mặt bằng</h4></div>--}}
                    {{--<div class="box-body">--}}
                        {{--<div class="col-md-8">--}}
                            {{--<div class="nav-tabs-custom">--}}
                                {{--<ul class="nav nav-tabs">--}}
                                    {{--<li class="active"><a href="#vietnam_flat" data-toggle="tab">Tiếng Viêt</a></li>--}}
                                    {{--<li><a href="#english_flat" data-toggle="tab">English</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="tab-content">--}}
                                {{--<div class="active tab-pane" id="vietnam_flat">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Thông tin</label>--}}
                                        {{--<textarea class="form-control editors" name="des_flat_vi" id="des_flat_vi">{{$isEdit ? $project->des_flat_vi : old("des_flat_vi")}}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane" id="english_flat">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Description</label>--}}
                                        {{--<textarea class="form-control editors" name="des_flat_en" id="des_flat_en">{{$isEdit ? $project->des_flat_en : old("des_flat_en")}}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputPassword1">Hình ảnh mặt bằng (900 x 600px)</label>--}}
                                {{--<img id="imgSmall_flat" src="{{$isEdit ? asset('images/project/'.$project->image_flat) : asset('img/default.png')}}" class="img-responsive"  alt="Slide Image">--}}
                                {{--<div class="input-group image-preview" style="margin-top: 10px">--}}
                                    {{--<input placeholder="" id="text-image_flat" type="text" value="{{$isEdit? $project->image_flat:''}}" class="form-control image-preview-filename" disabled="disabled">--}}
                                    {{--<!-- don't give a name === doesn't send on POST/GET -->--}}
                                    {{--<span class="input-group-btn">--}}
                                            {{--<div class="btn btn-success image-preview-input"> <span class="glyphicon glyphicon-folder-open"></span> <span class="image-preview-input-title">Browse</span>--}}
                                                {{--<input type="file" accept="image/png, image/jpeg, image/gif" name="avatar_flat" onchange="readURL_flat(this);"/>--}}
                                                {{--<!-- rename it -->--}}
                                            {{--</div>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
           {{--<div class="col-md-12">--}}
               {{-- <div class="box box-danger">--}}
                   {{-- <div class="box-header">Hình ảnh</div>--}}
                    {{-- <div class="box-body">--}}
                        {{-- @if($isEdit)--}}
                           {{--  @if(count($image)!=0)--}}
                                {{-- <div class="form-group">--}}
                                   {{--  <h5>Hình ảnh</h5>--}}
                                    {{-- <input name="arrImage" hidden id="arrImage">--}}
                                    {{-- @foreach($image as $img)--}}
                                        {{-- <div class="col-md-3" id="Img-{{$img->id}}" style="position: relative;margin-bottom: 5px;">--}}
                                           {{--  <a onclick="ftDeleteImage('{{$img->id}}')" style="position: absolute;background: #c73b3b; padding: 5px 7px;">--}}
                                               {{--  <i class="fa fa-close" style="color:#fff;"></i>--}}
                                           {{-- </a>--}}
                                            {{-- <img src="{{asset('images/project')}}/{{$img->image}}" style="width: 100%;border: 1px #ddd solid;padding: 1px;">--}}
                                        {{-- </div>--}}
                                    {{-- @endforeach--}}
                               {{--  </div>--}}
                            {{-- @endif--}}
                        {{-- @endif--}}
                       {{--  <div class="form-group">--}}
                           {{--  <label for="introduce" style="width:100%;">--}}
                               {{--  Thêm hình ảnh (tối đa 5 hình)--}}
                            {{-- </label>--}}
                           {{--  <input class="image file" type="file" name="image[]" multiple data-preview-file-type="text">--}}
                      {{--   </div>--}}
                   {{--  </div>--}}
                {{-- </div>--}}
               {{--  <div class="box-header "></div>--}}
            {{-- </div>--}}
            {{ Form::close() }}
        </div>

    </div>
</section>
@section('scripts')
    <script>
        var check=$('#is_sale').is(':checked');
        if(check){
            document.getElementById('div_sort_order').style.display = 'block';
        }else{
            document.getElementById('div_sort_order').style.display = 'none';
        }
        $('#is_sale').click(function () {
            var c=$(this).is(':checked');
            if(c){
                document.getElementById('div_sort_order').style.display = 'block';
            }else{
                document.getElementById('div_sort_order').style.display = 'none';
            }
        });
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
//        function readURL_about(input) {
//            if (input.files && input.files[0]) {
//                var reader = new FileReader();
//                reader.onload = function (e) {
//                    $('#imgSmall_about').attr('src', e.target.result);
//                    $('#text-image_about').val(input.files[0].name);
//                };
//                reader.readAsDataURL(input.files[0]);
//            }
//        }
//        function readURL_location(input) {
//            if (input.files && input.files[0]) {
//                var reader = new FileReader();
//                reader.onload = function (e) {
//                    $('#imgSmall_location').attr('src', e.target.result);
//                    $('#text-image_location').val(input.files[0].name);
//                };
//                reader.readAsDataURL(input.files[0]);
//            }
//        }
//        function readURL_utility(input) {
//            if (input.files && input.files[0]) {
//                var reader = new FileReader();
//                reader.onload = function (e) {
//                    $('#imgSmall_utility').attr('src', e.target.result);
//                    $('#text-image_utility').val(input.files[0].name);
//                };
//                reader.readAsDataURL(input.files[0]);
//            }
//        }
//        function readURL_flat(input) {
//            if (input.files && input.files[0]) {
//                var reader = new FileReader();
//                reader.onload = function (e) {
//                    $('#imgSmall_flat').attr('src', e.target.result);
//                    $('#text-image_flat').val(input.files[0].name);
//                };
//                reader.readAsDataURL(input.files[0]);
//            }
//        }
        function ftDeleteImage(id) {
            document.getElementById('Img-'+id).style.display = "none";
            var t = $('#arrImage').val();
            $('#arrImage').val(t+id+',');

        }
        $('.editors').each( function () {
            CKEDITOR.replace(this.id, {
                {{--filebrowserUploadUrl: '/uploader/project',--}}
                {{--filebrowserBrowseUrl:'{{URL::asset('')}}link-folder/project'--}}
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            });
        });
    </script>
@endsection

