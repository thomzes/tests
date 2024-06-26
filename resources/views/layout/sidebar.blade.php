<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CBB Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Manage Product -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('productView',[Session::get('name')]) }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage Product</span></a>
    </li>

    <!-- Manage Product Category -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categoryView',[Session::get('name')]) }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage Product Category</span></a>
    </li>

    <!-- Manage Product Size -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('sizeView',[Session::get('name')]) }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage Product Size</span></a>
    </li>

    <!-- Manage Transaction -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transactionView',[Session::get('name')]) }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage Transaction</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>