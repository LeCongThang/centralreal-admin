@section('css')
@endsection

@section('js')
    <script>
        var input = $('#inputMatKhau');
        var btn = $('#btnShowHidden');
        (input.attr('type') == 'text') ? btn.text('Ẩn') : btn.text('Hiển thị');
        btn.click(function(){
            if(input.attr('type') == 'text')
            {
                input.attr('type','password');
                $(this).text('Hiển thị');
            }
            else
            {
                input.attr('type','text');
                $(this).text('Ẩn');
            }
        });
    </script>
@endsection

<div class="box user-form">
    {{ Form::open(['url' => $isEdit ? "user/$user->id": route('user.store'), 'method' => $isEdit ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
    <div class="box-header with-border">
        <div class="col-md-12">
            @if(isset($profile))
                <button class="btn btn-default"  name="profile" value="ok" type="reset"> Hủy
                </button>
                <button class="btn btn-info pull-right"  name="profile" value="ok" type="submit"><i class="fa fa-check"></i> Cập nhật
                </button>
            @else
                <button class="btn btn-primary" name="save" value="{{route('user.index')}}" type="submit"><i class="fa fa-check"></i> Lưu &amp;
                    đóng
                </button>
                @if(!$isEdit)
                    <button class="btn btn-primary" name="save" value="{{route('user.create')}}" type="submit"><i class="fa fa-plus"></i> Lưu &amp; tạo
                        mới
                    </button>
                @endif
                <a class="btn btn-warning  pull-right" href="{{route('user.index')}}"><i class="fa fa-close"></i>
                    Hủy bỏ</a>
            @endif
        </div>
    </div>
    <div class="box-body">
        <div class="col-sm-8 col-xs-12 col-md-8 col-lg-8">
            <div class="form-group">
                {{ Form::label("email", "Email:") }}
                {{ Form::text("email", $isEdit ? $user->email : old("email") , ['class' => 'form-control','id'=>"email",'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label("fullname", "Họ tên:") }}
                {{ Form::text("fullname", $isEdit ? $user->fullname : old("fullname") , ['class' => 'form-control','id'=>"fullname",'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label("inputMatKhau", "Mật khẩu:") }}
                <div class="input-group">
                    <input type="password" class="form-control" name="password" maxlength="255"
                           minlength="6" aria-required="true" aria-invalid="true"
                           value="" id="inputMatKhau">
                    <div class="input-group-btn">
                        <button style="margin-right: 0px" type="button" id="btnShowHidden" class="btn btn-warning btn-flat">Ẩn
                        </button>
                    </div>
                </div>
                <label style="color: #3702ff">
                    {{$isEdit ? "Nếu để trống, mật khẩu sẽ giữ nguyên không thay đổi" : "Nếu để trống, mật khẩu mặc định sẽ được đặt trùng với email" }}
                </label>
            </div>

        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            {{--@if(!isset($profile))--}}
                {{--<div class="form-group">--}}
                    {{--{{ Form::label("role", "Vai trò:") }}--}}

                        {{--<select class="form-control" name="role_id">--}}
                            {{--@if($isEdit)--}}
                                {{--<option value="1" {{$user->role_id ? "selected":""}}>Quản trị viên</option>--}}
                                {{--<option value="0"{{$user->role_id ? "":"selected"}}>Nhân viên</option>--}}
                            {{--@else--}}
                                {{--<option value="1">Quản trị viên</option>--}}
                                {{--<option value="0">Nhân viên</option>--}}
                            {{--@endif--}}
                        {{--</select>--}}
                {{--</div>--}}
            {{--@endif--}}
            {{--@if(!isset($profile))--}}
                {{--<div class="form-group">--}}
                    {{--{{ Form::label("status", 'Trạng thái:') }}--}}
                    {{--{{ Form::select("status", array('1' => 'Hoạt động', '0' => 'Khóa'),$isEdit ? $user->status : (!empty(old('status')) ? old('status') : '1'), ['id'=>"status", 'class' => 'form-control']) }}--}}
                {{--</div>--}}
            {{--@endif--}}
                @if($isEdit)
                    @if($user->id != Auth::user()->id && !isset($profile))
                        <div class="form-group">
                            {{ Form::label("role", "Vai trò:") }}
                            <select class="form-control" name="role_id">
                                <option value="1" {{$user->role_id ? "selected":""}}>Quản trị viên</option>
                                <option value="0"{{$user->role_id ? "":"selected"}}>Nhân viên</option>
                            </select>
                        </div>
                        <div class="form-group">
                            {{ Form::label("status", 'Trạng thái:') }}
                            {{ Form::select("status", array('1' => 'Hoạt động', '0' => 'Khóa'),$isEdit ? $user->status : (!empty(old('status')) ? old('status') : '1'), ['id'=>"status", 'class' => 'form-control']) }}
                        </div>
                    @endif
                @else
                <div class="form-group">
                    {{ Form::label("role", "Vai trò:") }}

                    <select class="form-control" name="role_id">
                        <option value="1">Quản trị viên</option>
                        <option value="0">Nhân viên</option>
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label("status", 'Trạng thái:') }}
                    {{ Form::select("status", array('1' => 'Hoạt động', '0' => 'Khóa'),$isEdit ? $user->status : (!empty(old('status')) ? old('status') : '1'), ['id'=>"status", 'class' => 'form-control']) }}
                </div>
                @endif

        </div>
    </div>
    {{ Form::close() }}
</div>