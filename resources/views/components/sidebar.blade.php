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

                @if (auth()->user()->role == "admin")
                <li>
                    <x-nav-link href="{{ route('admin.employee') }}" :active="request()->routeIs('admin.employee')">
                        <i class="icon-profile"></i><span> Data Pegawai </span>
                    </x-nav-link>
                </li>
                @php
                    $leave = App\Models\Leave::whereNull('status_boss')->orWhereNull('status_leader')->count();
                @endphp
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-todolist"></i>
                        <span> Cuti <span class="float-right menu-arrow"><i
                                class="mdi mdi-chevron-right"></i></span>
                                {{-- @if ($leave)
                                <span class="badge badge-danger badge-pill float-right">{{ $leave }}</span>
                                @endif --}}
                            </span></a>
                        <ul class="submenu">
                            <li>
                                <x-nav-link href="{{ route('admin.input.leave') }}" :active="request()->routeIs('admin.input.leave')">
                                    <span> Input data cuti tahunan </span>
                                </x-nav-link>
                            </li>
                            {{-- <li>
                                <x-nav-link href="{{ route('admin.approves') }}" :active="request()->routeIs('admin.approves')">

                                    <span> Verifikasi Cuti </span>
                                    @if ($leave)
                                    <span class="badge badge-danger badge-pill float-right">{{ $leave }}</span>
                                    @endif
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link href="{{ route('admin.history') }}" :active="request()->routeIs('admin.history')">
                                    <span> Riwayat Cuti </span>
                                </x-nav-link>
                            </li> --}}
                        </ul>
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

                @can('boss', 'leader')
                @php
                    if (auth()->user()->employee->is_leader == 1) {
                        $leave = App\Models\Leave::where('status_boss', 'Disetujui')->WhereNull('status_leader')->count();
                    } else {
                        $employees = auth()->user()->employee->employees;
                        $employees_id = [];
                        foreach ($employees as $key => $value) {
                            array_push($employees_id, $value->id);
                        }
                        $leave = App\Models\Leave::whereNull('status_boss')->whereIn('employee_id', $employees_id)->count();
                    }
                @endphp
                <li>
                    <x-nav-link href="{{ route('employee.leave.acc.view') }}" :active="request()->routeIs('employee.leave.acc.view')">
                        <i class="icon-check"></i><span> Verifikasi Cuti </span>
                        @if ($leave)
                        <span class="badge badge-danger badge-pill float-right">{{ $leave }}</span>
                        @endif
                    </x-nav-link>
                </li>
                @endcan

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
                        <i class="icon-clock"></i><span> Riwayat Cuti </span>
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
