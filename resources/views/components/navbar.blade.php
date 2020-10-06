<nav class="navbar-custom">
    <ul class="navbar-right list-inline float-right mb-0">

        <!-- notification -->
        <li class="dropdown notification-list list-inline-item">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-bell-outline noti-icon"></i>
                <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                <!-- item-->
                <h6 class="dropdown-item-text">
                        Notifications
                    </h6>
                <div class="slimscroll notification-item-list">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                        <div class="notify-icon bg-warning"><i class="mdi mdi-pause"></i></div>
                        <p class="notify-details"><b>Pesan baru diterima</b><span class="text-muted">Anda memiliki x pengajuan cuti</span></p>
                    </a>
                </div>
            </div>
        </li>

        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();"><i class="mdi mdi-power text-danger"></i>
                            {{ __('Logout') }}</a>
                    </form>
                </div>
            </div>
        </li>
    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

        <!-- fullscreen -->
        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                <i class="mdi mdi-arrow-expand-all noti-icon"></i>
            </a>
        </li>
    </ul>

</nav>
