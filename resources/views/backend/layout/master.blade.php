<!DOCTYPE html>
<html>
@include('backend.partial.head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('backend.partial.header')
<!-- Left side column. contains the logo and sidebar -->
@include('backend.partial.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{$title or ""}}<small>{{$subtitle or ""}}</small>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @include('backend.partial.alert')
                </div>
            </div>
            @hasSection('content')
                @yield('content')
            @else
                Có lỗi trong quá trình đọc nội dung...
            @endif
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2018 <a href="#">CENTRARLEAL</a>.</strong> All rights
        reserved.
    </footer>
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@include('backend.partial.js')
@yield('scripts')
</body>
</html>
