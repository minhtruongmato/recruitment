
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("public/admin/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Quản Lý Ứng Viên</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('candidate.index') }}"><i class="fa fa-circle-o"></i> Danh Sách Ứng Viên</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>

            <li class="{{ Request::segment(2) == 'field' ? 'active' : '' }}">
                <a href="{{ route('field.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>Lĩnh Vực</span>
                </a>
            </li>

            <li class="{{ Request::segment(2) == 'career' ? 'active' : '' }}">
                <a href="{{ route('career.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>Ngành Nghề</span>
                </a>
            </li>

            <li class="{{ Request::segment(2) == 'position' ? 'active' : '' }}">
                <a href="{{ route('position.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>Chức Vụ</span>
                </a>
            </li>

            <li class="{{ Request::segment(2) == 'location' ? 'active' : '' }}">
                <a href="{{ route('location.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>Nơi Làm Việc</span>
                </a>
            </li>

            <li class="{{ Request::segment(2) == 'time' ? 'active' : '' }}">
                <a href="{{ route('time.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>Giờ Làm</span>
                </a>
            </li>
            
            <li class="{{ Request::segment(2) == 'language' ? 'active' : '' }}">
                <a href="{{ route('language.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>Ngoại Ngữ</span>
                </a>
            </li>

            <li class="{{ Request::segment(2) == 'wage' ? 'active' : '' }}">
                <a href="{{ route('wage.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>Mức Lương</span>
                </a>
            </li>

            <li class="{{ Request::segment(2) == 'education' ? 'active' : '' }}">
                <a href="{{ route('education.index') }}">
                    <i class="fa fa-hand-o-right"></i> <span>Học Vấn</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Layout Options</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                    <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                    <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                    <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>