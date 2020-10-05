<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <x-nav-link href="{{ route('sales') }}" :active="request()->routeIs('sales')">
                        <i class="icon-profile"></i><span> Sales </span>
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link href="{{ route('pelanggan') }}" :active="request()->routeIs('pelanggan')">
                        <i class="icon-profile"></i><span> Pelanggan </span>
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link href="{{ route('barang') }}" :active="request()->routeIs('barang')">
                        <i class="icon-squares"></i><span> Barang </span>
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link href="{{ route('order') }}" :active="request()->routeIs('order')">
                        <i class="icon-shopping-cart"></i><span> Order </span>
                    </x-nav-link>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
