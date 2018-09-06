@extends('backend.layout.master')
@section('title')
    CENTRARLEAL - Giới thiệu
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Trang chủ
            <small>Giới thiệu</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>  Trang chủ</a></li>
            <li class="active">Giới thiệu</li>
        </ol>
    </section>
    <section class="content">
        {{ Form::open(['url' => "about-us/update", 'method' => 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thông tin hình ảnh (500 x 280 px)</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                               <label>Chọn hiển thị</label>
                                <label style="margin-left: 20px"><input type="radio" name="is_show" value="0" {{$about->is_show ==0 ?'checked':''}}>Hình ảnh</label>
                                <label style="margin-left: 20px"><input type="radio" name="is_show" value="1"{{$about->is_show ==1 ?'checked':''}}>Video</label>
                            </div>
                            <div class="form-group">
                                <img id="imgSmall" src="{{$about ? asset('images/about/'.$about->image) : asset('img/default.png')}}" class="img-responsive"  alt="Hình ảnh giới thiệu">
                                <div class="input-group image-preview" style="margin-top: 10px">
                                    <input placeholder="" id="text-image1" type="text" value="{{$about->image or ''}}" class="form-control image-preview-filename" disabled="disabled">
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
                            <h3 class="box-title">Thông tin video</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <img src="{{ $about->image or ''}}" id="imagevideo" class="img-responsive" alt="Hình ảnh video">
                                <div class="input-group"  style="margin-top: 10px">
                                    <input type="text" class="form-control" name="video_link" aria-required="true" aria-invalid="true"
                                           value="{{ $about->video_link or ''}}" id="inputLink" >

                                    <div class="input-group-btn">
                                        <button style="margin-right: 0px" type="button" onclick="getId()" class="btn btn-warning btn-flat">Lấy link embed
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Link embed</label>
                                <input value="{{ $about->embed_link }}" type="text" id="embed_link1" disabled name="embed_link1" class="form-control">
                                <input value="{{ $about->embed_link }}" type="text" style="display: none" id="embed_link" name="embed_link" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin nội dung</h3>
                    </div>
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#vietnam" data-toggle="tab">Tiếng Viêt</a></li>
                                <li><a href="#english" data-toggle="tab">English</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="active tab-pane" id="vietnam">
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="form-control editors" name="content_vi" rows="5" id="content_vi">{{$about->content_vi or ''}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="english">
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea class="form-control editors" name="content_en" id="content_en">{{$about->content_en or ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin số liệu</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Nhân Viên</label>
                            <input type="number" class="form-control" name="projects" value="{{$about->projects  or '1'}}">
                        </div>
                        <div class="form-group">
                            <label>Dự án</label>
                            <input type="number" class="form-control" name="transports" value="{{$about->transports  or '1'}}">
                        </div>
                        <div class="form-group">
                            <label>Đối tác</label>
                            <input type="number" class="form-control" name="awards" value="{{$about->awards  or '1'}}">
                        </div>
                        <div class="form-group">
                            <label>Sàn liên kết</label>
                            <input type="number" class="form-control" name="clients" value="{{$about->clients  or '1'}}">
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
            var link= "<?php echo $about->video_link ?>";
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
            console.log(match);
            if (match && match[2].length == 11) {

                $('#embed_link1').val('//www.youtube.com/embed/'+match[2]);
                $('#embed_link').val('//www.youtube.com/embed/'+match[2]);
                $("#imagevideo").attr('src','http://img.youtube.com/vi/'+match[2]+'/0.jpg');
                $('#image').val('http://img.youtube.com/vi/'+match[2]+'/0.jpg');
            } else {
                return 'error';
            }
        }
        $('.editors').each( function () {
            CKEDITOR.replace(this.id, {
            });
        });
    </script>
@endsection

