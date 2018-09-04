@extends('backend.layout.master')
@section('title')
    CENTRARLEAL - Đào tạo
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('/')}}/css/dataTables.bootstrap.css">
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Trang chủ
            <small>Đào tạo</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Đào tạo</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{url('education/create')}}" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;&nbsp;Thêm
                            Đào tạo</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(count($education)!=0)
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Tiêu đề</th>
                                    <th>Đường đẫn</th>
                                    <th width="300px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($education as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->title_vi}}</td>
                                        <td>
                                            <input type="text"
                                                   value="http://centralreal.cf/educate/{{$item->id}}/{{$item->slug}}"
                                                   class="input{{$item->id}} form-control" style="width:100%!important;"/>
                                        </td>
                                        <td>

                                            <button onclick="myFunction({{$item->id}})"
                                                    onmouseout="outFunc({{$item->id}})" type="button"
                                                    class="btn btn-primary button{{$item->id}}" data-toggle="tooltip"
                                                    data-placement="top" title="Copy URL">
                                                Copy URL
                                            </button>
                                            <a href="{{url('education/edit/')}}/{{$item->id}}" class="btn btn-primary"
                                               title="Chi thiết"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="{{url('education/delete')}}/{{$item->id}}"
                                               class="btn btn-danger delete" title="Xóa"><i class="fa fa-close"></i></a>
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
        function myFunction(id) {
            $('.input' + id).select();
            document.execCommand("copy");
            $('.button' + id).attr('title', 'Copied')
        }

        function outFunc(id) {
            $('.button' + id).attr('title', 'Copy URL')
        }
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
                    $('#modal_DeleteEducation').modal('show');
                }
            });
        });
    </script>
@endsection