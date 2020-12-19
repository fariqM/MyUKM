<div class="main-header">
    <div class="logo">
        <img src="{{asset('assets/images/logo.png')}}" alt="">
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="d-flex align-items-center">
        <div class="search-bar d-flex " style="pointer-events:none;">
            <input type="text" placeholder="Search">
            <i class="search-icon text-muted i-Magnifi-Glass1"></i>
        </div>
    </div>

    <div style="margin: auto"></div>

    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
        <!-- Grid menu Dropdown -->
        <div class="dropdown widget_dropdown">
            <i class="i-Speach-Bubble-8 text-muted header-icon" role="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="menu-icon-grid">
                    <a href="#"><i class="i-Shop-4"></i> Service</a>
                    <a href="#"><i class="i-Library"></i> FAQ</a>
                    <a href="#"><i class="i-File-Clipboard-File--Text"></i> User Guide</a>
                    <a href="#"><i class="i-Ambulance"></i> Support</a>
                </div>
            </div>
        </div>


        <!-- Notificaiton -->
        <div class="dropdown">
            <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @if ($notifBaru > 0)
                <span class="badge badge-primary">{{ $notifBaru }}</span>
                @endif

                <i class="i-Bell text-muted header-icon"></i>
            </div>
            <!-- Notification dropdown -->

            <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" id="itemNotif"
                aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                @if (count($allNotif)==0)
                <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-close-windows-File--Text text-info mr1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <span class="flex-grow-1"></span>
                        <span class="badge badge-outline badge-secondary ml-1 mr-1">Notif kosong</span>
                        
                        <span class="text-small text-muted ml-auto">Ciyee anak baru.. notifnya kosong</span>
                    </div>
                </div>
                @endif
                @foreach ($allNotif as $notif)
                <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        @if ($notif->tipe == 1)
                        <i class="i-File-Clipboard-File--Text text-success mr-1"></i>
                        @else
                        <i class="i-File-Clipboard-File--Text text-danger mr-1"></i>
                        @endif

                    </div>
                    <div class="notification-details flex-grow-1">
                        <p class="m-0 d-flex align-items-center">
                            <span><a href="/profileUKM/data">{{ $notif->judul }}</a></span>
                            @if ($notif->tipe == 1)
                            <span class="badge badge-pill badge-success ml-1 mr-1">baru</span>
                            @else
                            <span class="badge badge-pill badge-danger ml-1 mr-1">baru</span>
                            @endif
                            <span class="flex-grow-1"></span>
                            <span class="text-small text-muted ml-auto">{{ waktu($notif->created_at) }}</span>
                        </p>
                        <p class="text-small text-muted m-0">{{ Str::limit($notif->deskripsi, 65) }}</p>
                    </div>
                </div>
                
                @endforeach


                {{-- <div class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-File-Clipboard-File--Text text-danger mr-1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <p class="m-0 d-flex align-items-center">
                            <span>Product out of stock</span>
                            <span class="badge badge-pill badge-danger ml-1 mr-1">3</span>
                            <span class="flex-grow-1"></span>
                            <span class="text-small text-muted ml-auto">10 hours ago</span>
                        </p>
                        <p class="text-small text-muted m-0">Headphone E67, R98, XL90, Q77</p>
                    </div>
                </div> --}}

            </div>
        </div>
        <!-- Notificaiton End -->

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <img src="{{asset('assets/images/faces/1.jpg')}}" id="userDropdown" alt="" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> Fariq Maulana
                    </div>
                    <a class="dropdown-item">Setting Profil</a>
                    <a class="dropdown-item">Ganti Password</a>
                    <a class="dropdown-item" href="/logoutUKM"
                        >{{ __('Log out') }}</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- header top menu end -->