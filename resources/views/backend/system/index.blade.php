@extends('backend.layout.master')
@section('title')
    CENTRARLEAL - Tin tức
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Trang chủ
            <small>Thông tin cấu hình chung</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>  Trang chủ</a></li>
            <li class="active">Thông tin cấu hình chung</li>
        </ol>
    </section>
    <section class="content">
        {{ Form::open(['url' => "system/update", 'method' => 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false']) }}
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin chính</h3>
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
                                    <label>Tên công ty</label>
                                    <input type="text" class="form-control" name="name_vi" value="{{$system->name_vi}}">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <textarea class="form-control" name="address_vi" rows="5" id="address_vi">{{$system->address_vi}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="english">
                                <div class="form-group">
                                    <label>Company name</label>
                                    <input type="text" class="form-control" name="name_en" value="{{$system->name_en}}">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="5" name="address_en" id="address_en">{{$system->address_en}}</textarea>
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
                        <h3 class="box-title">Thông tin liên hệ</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Email header</label>
                            <input type="email" class="form-control" name="email_header" value="{{$system->email_header}}">
                        </div>
                        <div class="form-group">
                            <label>Hotline</label>
                            <input type="text" class="form-control" name="hotline" value="{{$system->hotline}}">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="{{$system->phone}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{$system->email}}">
                        </div>
                        <div class="form-group">
                            <label>Link trang web</label>
                            <input type="text" class="form-control" name="web" value="{{$system->web}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin mạng xã hội</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Google plus</label>
                            <input type="text" class="form-control" name="google_plus" value="{{$system->google_plus}}">
                        </div>
                        <div class="form-group">
                            <label>Viber</label>
                            <input type="text" class="form-control" name="viber" value="{{$system->viber}}">
                        </div>
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" class="form-control" name="youtube" value="{{$system->youtube}}">
                        </div>
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control" name="facebook" value="{{$system->facebook}}">
                        </div>
                        <div class="form-group">
                            <label>Fanpage</label>
                            <input type="text" class="form-control" name="fanpage" value="{{$system->fanpage}}">
                        </div>
                        <div class="form-group">
                            <label>Google map</label>
                            <textarea class="form-control" rows="5" name="google_map" id="google_map">{{$system->google_map}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin SEO</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Meta title</label>
                            <textarea class="form-control" rows="3" name="meta_title" id="meta_title">{{$system->meta_title}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta keysword</label>
                            <textarea class="form-control" rows="4" name="meta_keysword" id="meta_keysword">{{$system->meta_keysword}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta description</label>
                            <textarea class="form-control" rows="4" name="meta_des" id="meta_des">{{$system->meta_des}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Google analytics</label>
                            <textarea class="form-control" rows="5" name="google_analytics" id="google_analytics">{{$system->google_analytics}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin tiêu đề trang chủ</h3>
                    </div>
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#vietnam1" data-toggle="tab">Tiếng Viêt</a></li>
                                <li><a href="#english1" data-toggle="tab">English</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="active tab-pane" id="vietnam1">
                                <div class="form-group">
                                    <label>Tiêu đề dưới giới thiệu</label>
                                    <textarea class="form-control" name="title_about_vi" rows="4">{{$system->title_about_vi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề dưới dự án</label>
                                    <textarea class="form-control" name="title_project_vi" rows="4">{{$system->title_project_vi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề dưới tin tức</label>
                                    <textarea class="form-control" name="title_news_vi" rows="4">{{$system->title_news_vi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề dưới thư viện</label>
                                    <textarea class="form-control" name="title_gallery_vi" rows="4">{{$system->title_gallery_vi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề dưới tin tức nổi bật</label>
                                    <textarea class="form-control" name="title_hot_news_vi" rows="4">{{$system->title_hot_news_vi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề dưới khách hàng đánh giá</label>
                                    <textarea class="form-control" name="title_comment_vi" rows="4">{{$system->title_comment_vi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề dưới đối tác</label>
                                    <textarea class="form-control" name="title_partner_vi" rows="4">{{$system->title_partner_vi}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="english1">
                                <div class="form-group">
                                    <label>Title about</label>
                                    <textarea class="form-control" rows="4" name="title_about_en">{{$system->title_about_en}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Title project</label>
                                    <textarea class="form-control" rows="4" name="title_project_en">{{$system->title_project_en}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Title news</label>
                                    <textarea class="form-control" rows="4" name="title_news_en">{{$system->title_news_en}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Title gallery</label>
                                    <textarea class="form-control" rows="4" name="title_gallery_en">{{$system->title_gallery_en}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Title hot news</label>
                                    <textarea class="form-control" rows="4" name="title_hot_news_en">{{$system->title_hot_news_en}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Title comment</label>
                                    <textarea class="form-control" rows="4" name="title_comment_en">{{$system->title_comment_en}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Title partner</label>
                                    <textarea class="form-control" rows="4" name="title_partner_en">{{$system->title_partner_en}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin trang đối tác</h3>
                    </div>
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#vietnam2" data-toggle="tab">Tiếng Viêt</a></li>
                                <li><a href="#english2" data-toggle="tab">English</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="active tab-pane" id="vietnam2">
                                <div class="form-group">
                                    <label>Mô tả đối tác Chủ đầu tư</label>
                                    <textarea class="form-control" name="partner_invester_vi" rows="4">{{$system->partner_invester_vi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả đối tác Sàn Liên Kết</label>
                                    <textarea class="form-control" name="partner_connect_vi" rows="4">{{$system->partner_connect_vi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả đối tác Ngân Hàng</label>
                                    <textarea class="form-control" name="partner_bank_vi" rows="4">{{$system->partner_bank_vi}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="english2">
                                <div class="form-group">
                                    <label>Mô tả đối tác Chủ đầu tư</label>
                                    <textarea class="form-control" name="partner_invester_en" rows="4">{{$system->partner_invester_en}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả đối tác Sàn Liên Kết</label>
                                    <textarea class="form-control" name="partner_connect_en" rows="4">{{$system->partner_connect_en}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả đối tác Ngân Hàng</label>
                                    <textarea class="form-control" name="partner_bank_en" rows="4">{{$system->partner_bank_en}}</textarea>
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
