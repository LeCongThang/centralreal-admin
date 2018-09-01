<section class="content-header">
    <h1>
        Trang chủ
        <small>Nhận thông tin dự án</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>  Trang chủ</a></li>
        <li class="active">Nhận thông tin dự án</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
                {{ Form::open(['url' => "contact/update/$contact->id", 'method' => 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
                <div class="box">
                    <div class="box-header">
                        <a href="{{url('contact')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" disabled class="form-control" value="{{$contact->name or ''}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" disabled class="form-control" value="{{$contact->email or ''}}">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" disabled class="form-control" value="{{$contact->phone or ''}}">
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" disabled class="form-control" value="{{$contact->title or ''}}">
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control" rows="5"  disabled>{{$contact->content or ''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label><br>
                                <label for="show">
                                    <input type="radio" value="1" name="status" {{$contact->status ==1 ? 'checked':''}} id="show">Đã duyệt
                                </label>
                                <label for="hide" style="margin-left: 20px">
                                    <input type="radio" value="0" name="status" {{$contact->status ==0 ? 'checked':''}} id="hide">Chưa duyệt
                                </label>
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
                filebrowserUploadUrl: '/uploader/contact',
                filebrowserBrowseUrl:'{{URL::asset('')}}folder/contact'
            });
        });
    </script>
@endsection
