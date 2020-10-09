<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <i class="icon-accelerator"></i><span> Dashboard </span>
                    </x-nav-link>
                </li>

                @if (auth()->user()->role == "Admin")
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-profile"></i><span>
                            Pegawai <span class="float-right menu-arrow"><i
                                    class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li>
                            <x-nav-link href="{{ route('admin.employee') }}" :active="request()->routeIs('admin.employee')">
                                <span> Data Pegawai </span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <li>
                    <x-nav-link href="{{ route('admin.input.leave') }}" :active="request()->routeIs('admin.input.leave')">
                        <i class="icon-todolist-add"></i><span> Input data cuti Tahunan </span>
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link href="{{ route('admin.approves') }}" :active="request()->routeIs('admin.approves')">
                        @php
                            $leave = App\Models\Leave::whereNull('status')->count();
                        @endphp
                        <i class="icon-check"></i><span> Approval Cuti </span>
                        @if ($leave)
                        <span class="badge badge-danger badge-pill float-right">{{ $leave }}</span>
                        @endif
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link href="{{ route('admin.history') }}" :active="request()->routeIs('admin.history')">
                        <i class="icon-clock"></i><span> History Cuti </span>
                    </x-nav-link>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-setting-2"></i><span>
                            Setting <span class="float-right menu-arrow"><i
                                    class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li>
                            <x-nav-link href="{{ route('admin.user') }}" :active="request()->routeIs('admin.user')">
                                <span> User </span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                @else

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-profile"></i><span>
                            Permohonan Cuti <span class="float-right menu-arrow"><i
                                    class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li>
                            <x-nav-link href="{{ route('employee.leave.year') }}" :active="request()->routeIs('employee.leave.year')">
                                <span> Tahunan </span>
                            </x-nav-link>
                        </li>

                        <li>
                            <x-nav-link href="{{ route('employee.leave') }}" :active="request()->routeIs('employee.leave')">
                                <span> Umum </span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <li>
                    <x-nav-link href="{{ route('employee.history') }}" :active="request()->routeIs('employee.history')">
                        <i class="icon-clock"></i><span> History Cuti </span>
                    </x-nav-link>
                </li>

                @endif

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
