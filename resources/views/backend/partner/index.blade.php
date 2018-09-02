@extends('backend.layout.master')
@section('title')
    CENTRARLEAL - Đối tác
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/')}}/css/dataTables.bootstrap.css">
@endsection


@section('content')
    <section class="content-header">
        <h1>
            Trang chủ
            <small>Đối tác</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Đối tác</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{url('partner/create')}}" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;&nbsp;Thêm
                            Đối tác</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#vietnam" data-toggle="tab">Tiếng Viêt</a></li>
                                <li><a href="#english" data-toggle="tab">English</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="active tab-pane" id="vietnam">
                                @if(count($partner)!=0)
                                    <table id="datatable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th style="width: 150px">Hình ảnh</th>
                                            <th>Tên</th>
                                            <th>Slug</th>
                                            <th>Loại</th>
                                            <th width="100px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($partner as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <img src="{{asset('images/partner')}}/{{$item->image}}"
                                                         style="width: 100%">
                                                </td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->slug}}</td>
                                                <td>
                                                    @if($item->is_investor)
                                                        <label class="label label-danger">Chủ đầu tư</label>
                                                    @endif
                                                    @if($item->is_connect)
                                                        <label class="label label-success">Sàn liên kết</label>
                                                    @endif
                                                        @if($item->is_bank)
                                                            <label class="label label-primary">Ngân hàng</label>
                                                        @endif
                                                </td>
                                                <td>
                                                    <a href="{{url('partner/edit/')}}/{{$item->id}}"
                                                       class="btn btn-primary" title="Chi thiết"><i
                                                                class="fa fa-pencil-square-o"></i></a>
                                                    <a href="{{url('partner/delete')}}/{{$item->id}}"
                                                       class="btn btn-danger delete" title="Xóa"><i
                                                                class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="tab-pane" id="english">
                                @if(count($partner)!=0)
                                    <table id="datatable1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th style="width: 150px">Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Category</th>
                                            <th width="100px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($partner as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <img src="{{asset('images/partner')}}/{{$item->image}}"
                                                         style="width: 100%">
                                                </td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->slug}}</td>
                                                <td>
                                                    @if($item->is_investor)
                                                        <label class="label label-danger">Investor</label>
                                                    @endif
                                                    @if($item->is_connect)
                                                        <label class="label label-success">Connect</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{url('partner/edit/')}}/{{$item->id}}"
                                                       class="btn btn-primary" title="Chi thiết"><i
                                                                class="fa fa-pencil-square-o"></i></a>
                                                    <a href="{{url('partner/delete')}}/{{$item->id}}"
                                                       class="btn btn-danger delete" title="Xóa"><i
                                                                class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('/')}}/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('/')}}/js/dataTables.bootstrap.min.js"></script>
    <script>
        var table = $('#datatable').DataTable({
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 2]}
            ]
        });
        var table1 = $('#datatable1').DataTable({
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0, 2]}
            ]
        });
    </script>
    <script>
        $('.delete').click(function (e) {
            var a_href = $(this).attr('href');
            e.preventDefault();
            $.ajax({
                url: a_href,
                type: 'GET',
                contentType: 'application/json; charset=utf-8',
                success: function (data) {
                    $('body').prepend(data);
                    $('#modal_Deletepartner').modal('show');
                }
            });
        });
    </script>
@endsection