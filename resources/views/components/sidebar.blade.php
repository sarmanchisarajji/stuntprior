<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center align-items-center">
                <div class="logo">
                    @guest
                        <a href="/guest/dashboard" class="d-flex align-items-center">
                            <img src="{{ url('') }}/assets/auth/assets/images/stuntprior.png" alt="Logo"
                                style="max-width: 60px; height: auto; margin-right: 5px;">
                            <h4 style="font-size:; margin: 0; color: #36eb60;">STUNTPRIOR</h4>
                        </a>
                    @endguest
                    @auth
                        <a href="/admin/dashboard" class="d-flex align-items-center">
                            <img src="{{ url('') }}/assets/auth/assets/images/stuntprior.png" alt="Logo"
                                style="max-width: 60px; height: auto; margin-right: 5px;">
                            <h4 style="font-size:; margin: 0; color: #36eb60;">STUNTPRIOR</h4>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            @auth
                <ul class="menu">
                    <li class="sidebar-title justify-content-center text-center text-bolder"
                        style="color: #435ebe; font-size: 18px;">~ Menu Utama ~</li>

                    <li
                        class="sidebar-item {{ request()->is('admin/dashboard-tahun') && request()->has('tahun') ? 'active' : '' }}">
                        <a href="{{ url('/admin/dashboard-tahun') }}?tahun={{ request('inputYear', date('Y')) }}"
                            class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>


                    <li class="sidebar-title text-center text-bolder" style="color:#435ebe; font-size: 18px;">~ Proses
                        SMARTER ~</li>

                    <li class="sidebar-item {{ request()->is('admin/data-alternatif*') ? 'active' : '' }}">
                        <a href="/admin/data-alternatif" class='sidebar-link'>
                            <i class="bi bi-book-half"></i>
                            <span>Data Alternatif</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('admin/data-kriteria*') ? 'active' : '' }}">
                        <a href="/admin/data-kriteria" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Data Kriteria</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('admin/data-subkriteria*') ? 'active' : '' }}">
                        <a href="/admin/data-subkriteria" class='sidebar-link'>
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>Data Subkriteria</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('admin/data-penilaian*') ? 'active' : '' }}">
                        <a href="/admin/data-penilaian" class='sidebar-link'>
                            <i class="bi bi-file-earmark-check-fill"></i>
                            <span>Data Penilaian</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item {{ request()->is('admin/perhitungan') && request()->has('tahun_pemilihan') ? 'active' : '' }}">
                        <a href="{{ url('/admin/perhitungan') }}?tahun_pemilihan={{ request('tahun_pemilihan', date('Y')) }}"
                            class='sidebar-link'>
                            <i class="bi bi-calculator-fill"></i>
                            <span>Data Perhitungan</span>
                        </a>
                    </li>


                    <li class="sidebar-item {{ request()->is('admin/data-akhir*') ? 'active' : '' }}">
                        <a href="/admin/data-akhir" class='sidebar-link'>
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Hasil Akhir</span>
                        </a>
                    </li>

                </ul>
            @endauth

            @guest
                <ul class="menu">
                    <li class="sidebar-title justify-content-center text-center text-bolder"
                        style="color: #435ebe; font-size: 18px;">~ Menu Utama ~</li>

                    {{-- <li class="sidebar-item {{ request()->is('guest/dashboard') ? 'active' : '' }}">
                        <a href="/guest/dashboard" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li> --}}

                    <li
                        class="sidebar-item {{ request()->is('guest/dashboard-tahun') && request()->has('tahun') ? 'active' : '' }}">
                        <a href="{{ url('/guest/dashboard-tahun') }}?tahun={{ request('inputYear', date('Y')) }}"
                            class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-title text-center text-bolder" style="color: #435ebe; font-size: 18px;">~ Proses
                        SMARTER ~</li>

                    <li class="sidebar-item {{ request()->is('guest/data-akhir*') ? 'active' : '' }}">
                        <a href="/guest/data-akhir" class='sidebar-link'>
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Hasil Akhir</span>
                        </a>
                    </li>
                </ul>
            @endguest
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
