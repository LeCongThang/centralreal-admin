@extends('backend.layout.master')
@section('title')
    CENTRAREAL - Ban Lãnh Đạo
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/')}}datatables/dataTables.bootstrap.css">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Trang chủ
            <small>Ban lãnh đạo</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Ban lãnh đạo</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{url('people/create')}}" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;&nbsp;Thêm
                            lãnh đạo</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        @if(count($peoples)!=0)
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th style="width: 150px">Avatar</th>
                                    <th>Tên</th>
                                    <th>Chức vụ</th>
                                    <th width="100px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($peoples as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <img src="{{asset('images/people')}}/{{$item->avatar}}" style="width: 100%">
                                        </td>
                                        <td>{{$item->name_vi}}</td>
                                        <td>{{$item->position_vi}}</td>
                                        <td>
                                            <a href="{{url('people/edit/')}}/{{$item->id}}" class="btn btn-primary"
                                               title="Chi thiết"><i class="fa fa-pencil-square-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif

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
                    $('#modal_DeleteProject').modal('show');
                }
            });
        });
    </script>
@endsection