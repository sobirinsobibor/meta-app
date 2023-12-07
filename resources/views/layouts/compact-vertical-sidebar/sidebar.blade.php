<?php

$id_role='';
$main_url='';
$isActive_dashboard = '';
$isActive_master =  '';
$isActive_pendataanPerangkatJaringan =  '';

if( Auth::user()->id_role === 1){
    $id_role = Auth::user()->id_role;
    $main_url = 'admin';
    $isActive_dashboard = request()->is($main_url);
    $isActive_master =  request()->is($main_url.'/master*');
    $isActive_pendataanPerangkatJaringan =  request()->is($main_url.'/pendataan*');
    $isActive_layananDataCenter =  request()->is($main_url.'/layanan*');
    $isActive_dokumentasi =  request()->is($main_url.'/dokumentasi*');
}else if(Auth::user()->id_role === 2){
    $id_role = Auth::user()->id_role;
    $main_url = 'staff';
    $isActive_dashboard = request()->is($main_url);
    $isActive_pendataanPerangkatJaringan =  request()->is($main_url.'/pendataan*');
    $isActive_layananDataCenter =  request()->is($main_url.'/layanan*');
    $isActive_dokumentasi =  request()->is($main_url.'/dokumentasi*');
}else if(Auth::user()->id_role === 3){
    $id_role = Auth::user()->id_role;
    $main_url = 'visitor';
}

?>
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">

            <li class="nav-item {{$isActive_dashboard ? 'active' : '' }} {{ request()->is('profile') ? 'active' : '' }} "data-item="dashboard">
                <a class="nav-item-hold" href="{{ route($main_url) }}" >
                    <i class="nav-icon bi bi-display"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            @if($id_role === 1) {{-- if admin --}}
            <li class="nav-item {{ $isActive_master ? 'active' : '' }}  " data-item="master">
                <a class="nav-item-hold" href="{{ route($main_url.'.master') }}" >
                    <i class="nav-icon bi bi-gear"></i>
                    <span class="nav-text">Master</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endif
            <li class="nav-item  {{ $isActive_pendataanPerangkatJaringan ? 'active' : '' }} " data-item="perangkat-jaringan">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Router"></i>
                    <span class="nav-text">Perangkat Jaringan</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ $isActive_layananDataCenter ? 'active' : '' }}"data-item="data-center">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon  i-Data-Center"></i>
                    <span class="nav-text">Data Center</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ $isActive_dokumentasi ? 'active' : '' }}"data-item="documentation">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon  i-Data-Center"></i>
                    <span class="nav-text">Documentation</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <i class="sidebar-close i-Close" (click)="toggelSidebar()"></i>
        <header>
            <div class="logo">
                <img src="{{asset('storage/img/main/Logo-Universitas-Airlangga-UNAIR.png')}}" alt="">
            </div>
        </header>
        <!-- Submenu Dashboards -->
        <div class="submenu-area" data-parent="dashboard">
            <header>
                <h6>Dashboard</h6>
                {{-- <p>click to refresh</p> --}}
            </header>
            <ul class="childNav" data-parent="dashboard">
                <li class="nav-item ">
                    <a class=""  href="/{{ $main_url }}">
                        <i class="nav-icon bi bi-display"></i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route('profile') }}">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <span class="item-name">Profile</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="/logout">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <span class="item-name">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        @if($id_role === 1)
        {{-- Submenu Master --}}
        <div class="submenu-area" data-parent="master">
            <header>
                <a href="{{ route($main_url.'.master') }}">
                    <h6>Master</h6>
                </a>
                {{-- <p>click to refresh</p> --}}
            </header>
            <ul class="childNav" data-parent="master">
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url . '.master.user') }}">
                        <i class="nav-icon i-Checked-User"></i>
                        <span class="item-name">User</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url . '.master.jenis-perangkat') }}">
                        <i class="nav-icon i-Data"></i>
                        <span class="item-name">Jenis Perangkat</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url . '.master.merk-perangkat') }}">
                        <i class="nav-icon i-Tag"></i>
                        <span class="item-name">Merk Perangkat</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url . '.master.kategori-perangkat') }}">
                        <i class="nav-icon i-Data-Copy"></i>
                        <span class="item-name">Kategori Perangkat</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url . '.master.tipe-server') }}">
                        <i class="nav-icon i-Data-Signal"></i>
                        <span class="item-name">Tipe Server</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url . '.master.fungsi-server') }}">
                        <i class="nav-icon i-Data-Settings"></i>
                        <span class="item-name">Fungsi Server</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url . '.master.up-link') }}">
                        <i class="nav-icon i-Data-Settings"></i>
                        <span class="item-name">Up Link</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url . '.master.unit-kerja') }}">
                        <i class="nav-icon i-Building"></i>
                        <span class="item-name">Unit Kerja</span>
                    </a>
                </li>
            </ul>
        </div>
        @endif

        {{-- submenu perangkat-jaringan --}}
        <div class="submenu-area" data-parent="perangkat-jaringan">
            <header>
                <a href="{{ route($main_url.'.pendataan') }}">
                    <h6>Perangkat Jaringan</h6>
                </a>
                {{-- <p>click to refresh</p> --}}
            </header>
            <ul class="childNav" data-parent="perangkat-jaringan">
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url.'.pendataan.perangkat') }}">
                        <i class="nav-icon i-Data"></i>
                        <span class="item-name">Data Perangkat</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""   href="{{ route($main_url.'.pendataan.topologi-jaringan')}}">
                        <i class="nav-icon i-Internet"></i>
                        <span class="item-name">Topologi Jaringan</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url.'.pendataan.mapping-wifi')}}">
                        <i class="nav-icon i-Wireless"></i>
                        <span class="item-name">Mapping Wifi</span>
                    </a>
                </li>
                
            </ul>
        </div>

        {{-- submenu data-center --}}
        <div class="submenu-area" data-parent="data-center">
            <header>
                <a href="{{ route($main_url.'.layanan') }}">
                    <h6>Layanan Data Center</h6>
                </a>
                {{-- <p>click to refresh</p> --}}
            </header>
            <ul class="childNav" data-parent="data-center">
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url.'.layanan.instalasi-perangkat') }}">
                        <i class="nav-icon  i-Data-Upload"></i>
                        <span class="item-name">co-Location Perangkat</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="" href="{{ route($main_url.'.layanan.pemeliharaan-perangkat') }}">
                        <i class="nav-icon i-Optimization"></i>
                        <span class="item-name">Maintenance</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class=""  href="{{ route($main_url.'.layanan.pelepasan-perangkat') }}">
                        <i class="nav-icon i-Folder-Archive"></i>
                        <span class="item-name">Dismantle</span>
                    </a>
                </li>
                
            </ul>
        </div>

        @if($id_role !== 1)
        {{-- submenu documentation --}}
        <div class="submenu-area" data-parent="documentation">
            <header>
                <a href="{{ route($main_url.'.dokumentasi') }}">
                    <h6>Dokumentasi</h6>
                </a>
                {{-- <p>click to refresh</p> --}}
            </header>
            <ul class="childNav" data-parent="documentation">
                <li class="nav-item ">
                    <a class=""  href="">
                        <i class="nav-icon  i-Data-Upload"></i>
                        <span class="item-name">User Manual</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="" href="">
                        <i class="nav-icon i-Optimization"></i>
                        <span class="item-name">Maps</span>
                    </a>
                </li>
            </ul>
        </div>
        @endif



    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->