<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">

            <li class="nav-item {{ Route::currentRouteName()=='MyUKM' ? 'active' : '' }}" data-item="dashboard">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Layanan</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item " data-item="">
                <a class="nav-item-hold" href="{{ route('Calendar') }}">
                    <i class="nav-icon i-Calendar-4"></i>
                    <span class="nav-text">Kalender</span>
                </a>
                <div class="triangle"></div>
            </li>

            
            <li class="nav-item {{ request()->is('uikits/*') ? 'active' : '' }}" data-item="uikits">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">Riwayat</span>
                </a>
                <div class="triangle"></div>
            </li>


            <li class="nav-item {{ request()->is('sessions/*') ? 'active' : '' }}" data-item="sessions">
                <a class="nav-item-hold" href="/test.html">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Profile</span>
                </a>
                <div class="triangle"></div>
            </li>


        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        <ul class="childNav" data-parent="dashboard">
            <li class="nav-item ">
                <a class="{{ Route::currentRouteName()=='MyUKM' ? 'open' : '' }}" href="/MyUKM">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="item-name">Permohonan Proposal</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="{{ Route::currentRouteName()=='MyUKM' ? 'open' : '' }}">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="item-name">Laporan SPJ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='MyUKM' ? 'open' : '' }}" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="item-name">Version 3</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='MyUKM' ? 'open' : '' }}" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="item-name">Version 4</span>
                </a>
            </li>
        </ul>
        
        

       


        <ul class="childNav" data-parent="uikits">

            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='typography' ? 'open' : '' }}" href="#">
                    <i class="nav-icon i-Letter-Open"></i>
                    <span class="item-name">Riwayat hutang 23242k</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='typography' ? 'open' : '' }}" href="#">
                    <i class="nav-icon i-Letter-Open"></i>
                    <span class="item-name">Riwayat Mantan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='typography' ? 'open' : '' }}" href="#">
                    <i class="nav-icon i-Letter-Open"></i>
                    <span class="item-name">Riwayat Penyakit</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='typography' ? 'open' : '' }}" href="#">
                    <i class="nav-icon i-Letter-Open"></i>
                    <span class="item-name">Riwayat Jantung</span>
                </a>
            </li>

            
        </ul>
        <ul class="childNav" data-parent="sessions">
            <li class="nav-item">
                <a href="/profileUKM/data">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">Data Proposal</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">Data UKM</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">Data UKM</span>
                </a>
            </li>
        </ul>

        
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->