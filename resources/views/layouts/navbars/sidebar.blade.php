<div class="sidebar" style="padding-bottom: 40px">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text logo-mini">{{ __('DW®') }}</a>
                <a href="#" class="simple-text logo-normal">{{ __('MyUKM') }}</a>
            </div>
            <ul class="nav">
                <li @if ($pageSlug=='dashboard' ) class="active " @endif>
                    <a href="{{ route('home') }}">
                        <i class="tim-icons icon-chart-pie-36"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>


                <li @if ($pageSlug=='TabelPengajuan' ) class="active " @endif>
                    <a href="/adminTable/Pengajuan">
                        <i class="tim-icons icon-single-copy-04"></i>
                        <p>{{ __('Daftar Proposal') }}</p>
                    </a>
                </li>

                <li>
                    <a data-toggle="collapse" href="#laravel-examples" >
                        <i class="fab fa-laravel"></i>
                        <span class="nav-link-text">{{ __('Manajerial Akun') }}</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="laravel-examples">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug=='profile' ) class="active " @endif>
                                <a href="{{ route('profile.edit')  }}">
                                    <i class="tim-icons icon-single-02"></i>
                                    <p>{{ __('Profil Pengguna') }}</p>
                                </a>
                            </li>
                            <li @if ($pageSlug=='users' ) class="active " @endif>
                                <a href="{{ route('user.index')  }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ __('Manajemen Pengguna') }}</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                
                
                <li @if ($pageSlug=='Jadwal' ) class="active " @endif>
                    <a href="{{ route('CalendarAdmin') }}">
                        <i class="tim-icons icon-calendar-60"></i>
                        <p>{{ __('Jadwal') }}</p>
                    </a>
                </li>
                <li @if ($pageSlug=='Catatan' ) class="active " @endif>
                    <a href="{{ route('catatan') }}">
                        <i class="tim-icons icon-bell-55"></i>
                        <p>{{ __('Catatan') }}</p>
                    </a>
                </li>
                

            </ul>
        </div>
</div>