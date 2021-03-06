@extends('backend.layout.master')
@section('title')
    CENTRAREAL - Dự án
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/')}}datatables/dataTables.bootstrap.css">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Trang chủ
            <small>Dự án</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Dự án</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{url('project/create')}}" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;&nbsp;Thêm Dự án</a>
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
                                @if(count($projects)!=0)
                                <table id="datatable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th style="width: 150px">Hình ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Loại dự án</th>
                                        <th>Chủ đầu tư</th>

                                        <th>Trạng thái</th>
                                        <th>Thứ tự</th>
                                        <th width="100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projects as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <img src="{{asset('images/project')}}/{{$item->image}}" style="width: 100%">
                                            </td>
                                            <td>{{$item->title_vi}}</td>
                                            <td>{{$item->rela_category ? $item->rela_category->title_en :'--/--'}}</td>
                                            <td>{{$item->rela_partner ? $item->rela_partner->name : '--/--'}}</td>
                                            <td>
                                                @if($item->is_sale)
                                                    <label class="label label-danger">Đang bán</label>
                                                @endif

                                            </td>
                                            <td>
                                                @if($item->is_sale)
                                                   {{$item->sort_order}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('project/edit/')}}/{{$item->id}}" class="btn btn-primary" title="Chi thiết"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{url('project/delete')}}/{{$item->id}}" class="btn btn-danger delete" title="Xóa"><i class="fa fa-close"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="tab-pane" id="english">
                                @if(count($projects)!=0)
                                    <table id="datatable1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th style="width: 150px">Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Investor</th>
                                            <th>Status</th>
                                            <th>Sort order</th>
                                            <th width="100px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($projects as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <img src="{{asset('images/project')}}/{{$item->image}}" style="width: 100%">
                                                </td>
                                                <td>{{$item->title_en}}</td>
                                                <td>{{$item->rela_category ? $item->rela_category->title_en :'--/--'}}</td>
                                                <td>{{$item->rela_partner ? $item->rela_partner->name : '--/--'}}</td>
                                                <td>
                                                    @if($item->is_sale)
                                                        <label class="label label-danger">Is sale</label>
                                                    @endif

                                                </td>
                                                <td>
                                                @if($item->is_sale)
                                                    {{$item->sort_order}}
                                                @endif

                                                </td>
                                                <td>
                                                    <a href="{{url('project/edit/')}}/{{$item->id}}" class="btn btn-primary" title="Chi thiết"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a href="{{url('project/delete')}}/{{$item->id}}" class="btn btn-danger delete" title="Xóa"><i class="fa fa-close"></i></a>
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
    <script src="{{asset('/')}}datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('/')}}datatables/dataTables.bootstrap.min.js"></script>
    <script>
        var table = $('#datatable').DataTable({
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 0,2 ] }
            ]
        });
        var table1 = $('#datatable1').DataTable({
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 0,2 ] }
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
                    $('#modal_DeleteProject').modal('show');
                }
            });
        });
    </script>
@endsection