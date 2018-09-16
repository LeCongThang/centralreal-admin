@extends('backend.layout.master')

@section('title')
    CENTRARLEAL - Quản trị
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('/')}}/css/dataTables.bootstrap.css">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Trang chủ
            <small>Quản trị</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quản trị</li>
        </ol>
    </section>
    <section class="content">
    <div class="box post-list">
        <div class="box-header">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('user.create')}}" class="btn btn-success pull-right"><i class="fa fa-plus-circle"></i> Thêm người dùng</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div >
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;"></th>
                        <th style="text-align: left; vertical-align: middle;">Họ tên</th>
                        <th style="text-align: left; vertical-align: middle;">Email</th>

                        <th style="text-align: center; vertical-align: middle;">Vai trò</th>
                        <th style="text-align: center; vertical-align: middle;">Trạng thái</th>
                        <th style="text-align: center; vertical-align: middle;">...</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$value)
                        <tr id="id{{$value->id}}">
                            <td style="text-align: center; vertical-align: middle;">
                                {{($key+1)}}
                            </td>
                            <td style="text-align: left; vertical-align: middle;">
                                {{$value->fullname}}
                            </td>
                            <td style="text-align: left; vertical-align: middle;">
                                {{$value->email}}
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                @if($value->role_id)
                                    <label class="label label-success">Administrator</label>
                                @else
                                    <label class="label label-danger">Nhân viên</label>
                                @endif
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                @if($value->status)
                                    <label class="label label-success">Hoạt động</label>
                                @else
                                    <label class="label label-danger">Bị khóa</label>
                                @endif
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                @if(Auth::user()->role_id)
                                    <div class="btn-group group-{{$value->id}}" role="group">
                                        <a type="button" href="{{url('/')}}/admin/user/{{$value->id}}/edit"
                                           class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        @if(Auth::user()->id=$value->created_by)
                                            <a type="button" onclick="deleteObj('.group-{{$value->id}}','admin/user/{{$value->id}}','{{$value->name}}')"
                                               class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <i class="fa fa-ban"></i>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">#</th>
                        <th style="text-align: left; vertical-align: middle;">Họ tên</th>
                        <th style="text-align: left; vertical-align: middle;">Email</th>

                        <th style="text-align: center; vertical-align: middle;">Vai trò</th>
                        <th style="text-align: center; vertical-align: middle;">Trạng thái</th>
                        <th style="text-align: center; vertical-align: middle;">...</th>
                    </tr>
                    </tfoot>
                </table>

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
                { 'bSortable': false, 'aTargets': [ 0,4] }
            ]
        });
    </script>
@endsection
