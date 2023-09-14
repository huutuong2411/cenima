<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{asset('user/assets/img/logo.png')}}" alt="" style="width:80%;">
        </div>

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="{{Request::route()->getName() == 'admin.dashboard' ? 'nav-item active' : 'nav-item' }}">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="{{Request::is('admin/theaters*','admin/showtime*','admin/rooms*') ? 'nav-item active' : 'nav-item'}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-solid fa-newspaper"></i>
            <span>Quản lý chiếu phim</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="{{Request::is('admin/theaters*') ? 'collapse-item active' : 'collapse-item'}}" href="{{route('admin.theaters')}}">QL rạp chiếu</a>
                <a class="{{Request::is('admin/rooms*') ? 'collapse-item active' : 'collapse-item'}}" href="{{route('admin.rooms')}}">QL phòng chiếu</a>
                <a class="{{Request::is('admin/showtime*') ? 'collapse-item active' : 'collapse-item'}}" href="{{route('admin.showtime')}}">QL suất chiếu</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->

    <li class="{{Request::is('admin/movie*','admin/categories*','admin/purchase*') ? 'nav-item active' : 'nav-item'}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-solid fa-file-import"></i>
            <span>Quản lý phim</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="{{Request::is('admin/movie*') ? 'collapse-item active' : 'collapse-item'}}" href="{{route('admin.movies')}}">QL phim</a>
                <a class="{{Request::is('admin/categories*') ? 'collapse-item active' : 'collapse-item'}}" href="{{route('admin.categories')}}">QL danh mục</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    <li class="{{Request::is('admin/ticket*') ? 'nav-item active' : 'nav-item'}}">
        <a class="nav-link" href="{{route('admin.ticket')}}">
            <i class="fas fa-solid fa-truck"></i>
            <span>Quản lý vé</span></a>
    </li>
    <li class="{{Request::is('admin/register-device*') ? 'nav-item active' : 'nav-item'}}">
        <a class="nav-link" href="{{route('admin.register_device')}}">
            <i class="fas fa-solid fa-users"></i>
            <span>Đăng ký thiết bị nhân thông báo</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->

</ul>