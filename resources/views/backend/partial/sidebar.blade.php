<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{URL::asset('')}}img/avatar5.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->email}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            @if(Auth::user()->role_id)
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-user text-yellow"></i>
                        <span>QUẢN LÝ NGƯỜI DÙNG</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('user.create')}}"><i class="fa fa-plus-circle"></i> Thêm Người Dùng</a>
                        </li>
                        <li><a href="{{route('user.index')}}"><i class="fa fa-list-ul"></i> Tất Cả Người Dùng</a></li>
                    </ul>
                </li>
            @endif
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-gears text-green"></i>
                    <span>QUẢN LÝ THÔNG TIN</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('system')}}"><i class="fa fa-list-ul"></i> THÔNG TIN CHUNG</a></li>
                    <li><a href="{{url('config-popup')}}"><i class="fa fa-list-ul"></i> CẤU HÌNH POPUP</a></li>
                    <li><a href="{{url('about-us')}}"><i class="fa fa-list-ul"></i> GIỚI THIỆU</a></li>
                    <li><a href="{{url('culture')}}"><i class="fa fa-list-ul"></i> VĂN HÓA C.TY</a></li>
                </ul>
            </li>
            <li><a href="{{url('people')}}"><i class="fa fa-envelope-o text-yellow"></i> <span>QUẢN LÝ BAN LÃNH ĐẠO</span></a></li>
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-newspaper-o text-yellow"></i>
                    <span>QUẢN LÝ TIN TỨC</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('news')}}"><i class="fa fa-list-ul"></i> Danh sách</a></li>
                    <li><a href="{{url('news/create')}}"><i class="fa fa-plus-circle"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-cube text-blue"></i>
                    <span>QUẢN LÝ LOẠI DỰ ÁN</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('category')}}"><i class="fa fa-list-ul"></i> Danh sách</a></li>
                    <li><a href="{{url('category/create')}}"><i class="fa fa-plus-circle"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-cube text-blue"></i>
                    <span>QUẢN LÝ DỰ ÁN</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('project')}}"><i class="fa fa-list-ul"></i> Danh sách</a></li>
                    <li><a href="{{url('project/create')}}"><i class="fa fa-plus-circle"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-briefcase text-yellow"></i>
                    <span>QUẢN LÝ TUYỂN DỤNG</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('recruitment-central-real')}}"><i class="fa fa-list-ul"></i> CentralReal</a></li>
                    <li><a href="{{url('recruitment')}}"><i class="fa fa-list-ul"></i> Danh sách tuyển dụng</a></li>
                    <li><a href="{{url('recruitment-role')}}"><i class="fa fa-list-ul"></i> Vị trí tuyển dụng</a></li>
                    <li><a href="{{url('education')}}"><i class="fa fa-list-ul"></i> Đào tạo</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-sliders text-red"></i>
                    <span>QUẢN LÝ SLIDER</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('slider')}}"><i class="fa fa-list-ul"></i> Danh sách</a></li>
                    <li><a href="{{url('slider/create')}}"><i class="fa fa-plus-circle"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-file-image-o text-blue"></i>
                    <span>QUẢN LÝ GALLERY</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('gallery')}}"><i class="fa fa-list-ul"></i> Danh sách</a></li>
                    <li><a href="{{url('gallery/create')}}"><i class="fa fa-plus-circle"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-users text-red"></i>
                    <span>QUẢN LÝ ĐỐI TÁC</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('partner')}}"><i class="fa fa-list-ul"></i> Danh sách</a></li>
                    <li><a href="{{url('partner/create')}}"><i class="fa fa-plus-circle"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-comment-o text-green"></i>
                    <span>QUẢN LÝ PHẢN HỒI</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('feedback')}}"><i class="fa fa-list-ul"></i> Danh sách</a></li>
                    <li><a href="{{url('feedback/create')}}"><i class="fa fa-plus-circle"></i> Thêm mới</a></li>
                </ul>
            </li>
            <li><a href="{{url('contact')}}"><i class="fa fa-envelope-o text-yellow"></i> <span>QUẢN LÝ LIÊN HỆ</span></a></li>
            <li><a href="{{url('event-register')}}"><i class="fa fa-paper-plane text-red"></i> <span>QUẢN LÝ ĐĂNG KÝ SỰ KIỆN</span></a></li>
            <li><a href="{{url('project-register')}}"><i class="fa fa-paper-plane text-red"></i> <span>QUẢN LÝ ĐĂNG KÝ DỰ ÁN</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<style>
    .sidebar-menu >li >a{
        font-size: 13px !important;
    }
</style>