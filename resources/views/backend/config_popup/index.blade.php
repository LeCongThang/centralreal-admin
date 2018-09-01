@extends('backend.layout.master')
@section('title')
    CENTRARLEAL - Tin tức
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Trang chủ
            <small>Thông tin cấu hình popup</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>  Trang chủ</a></li>
            <li class="active">Thông tin cấu hình popup</li>
        </ol>
    </section>
    <section class="content">
        {{ Form::open(['url' => "config-popup/update", 'method' => 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin liên hệ</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <label><input type="checkbox" name="is_active" {{$popup->is_active ? 'checked':''}}></label>
                        </div>
                        <div class="form-group">
                            <label>Thời gian delay</label>
                            <input type="number" class="form-control" name="delay" value="{{$popup->delay}}">
                        </div>
                        <div class="form-group">
                            <label>Hiển thị</label></br>
                            <label><input type="radio" name="type" value="0" {{$popup->type ? '':'checked'}}> Hình ảnh</label>
                            <label><input type="radio" name="type" value="1" {{$popup->type ? 'checked':''}}> Video</label>
                        </div>
                        <div class="form-group">
                            <label>Trang có hiển thị popup( Nhập đường link, ví dụ: [duong-link1],[duong-link2])</label>
                            <textarea type="text" class="form-control" name="arr_link">{{$popup->arr_link}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hình ảnh</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hình ảnh</label>
                            <img id="imgSmall" src="{{asset('images/config/')}}/{{$popup->image }}" class="img-responsive"  alt="Slide Image">
                            <div class="input-group image-preview" style="margin-top: 10px">
                                <input placeholder="" id="text-image1" type="text" value="{{ $popup->image or''}}" class="form-control image-preview-filename" disabled="disabled">
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
            </div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Video</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <img src="{{ $popup->image or ''}}" id="imagevideo" class="img-responsive" alt="Hình ảnh video">
                            <div class="input-group"  style="margin-top: 10px">
                                <input type="text" class="form-control" name="video" aria-required="true" aria-invalid="true"
                                       value="{{ $popup->video or ''}}" id="inputLink" >
                                <div class="input-group-btn">
                                    <button style="margin-right: 0px" type="button" onclick="getId()" class="btn btn-warning btn-flat">Lấy Hình
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>

        </div>
        {{ Form::close() }}
    </section>
@endsection
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
        $(function () {
            var link= "<?php echo $popup->video ?>";
            if(link !=''){
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                var match = link.match(regExp);
                if (match && match[2].length == 11) {
//                    $('#embed_link').val('//www.youtube.com/embed/'+match[2]);
                    $("#imagevideo").attr('src','http://img.youtube.com/vi/'+match[2]+'/0.jpg');
//                    $('#image').val('http://img.youtube.com/vi/'+match[2]+'/0.jpg');
                } else {
                    return 'error';
                }
            }
        });
        function getId() {
            var url=$("#inputLink").val();
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[2].length == 11) {
                $('#embed_link').val('//www.youtube.com/embed/'+match[2]);
                $("#imagevideo").attr('src','http://img.youtube.com/vi/'+match[2]+'/0.jpg');
                $('#image').val('http://img.youtube.com/vi/'+match[2]+'/0.jpg');
            } else {
                return 'error';
            }
        }
    </script>
@endsection
