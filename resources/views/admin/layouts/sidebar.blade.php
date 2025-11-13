<aside class="left-sidebar">
    <style>
        .left-sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
            border-right: 1px solid #e9ecef;
        }

        .sidebar-link {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            margin: 4px 8px;
            padding: 12px 16px;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #115C5B 0%, #1a8786 100%);
            transition: width 0.3s ease;
            border-radius: 12px;
            z-index: 0;
        }

        .sidebar-link.active::before,
        .sidebar-link:hover::before {
            width: 4px;
        }

        .sidebar-link:hover {
            background: linear-gradient(90deg, rgba(17, 92, 91, 0.08) 0%, rgba(26, 135, 134, 0.05) 100%);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(17, 92, 91, 0.1);
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(17, 92, 91, 0.12) 0%, rgba(26, 135, 134, 0.08) 100%);
            box-shadow: 0 2px 8px rgba(17, 92, 91, 0.15);
        }

        .sidebar-link.active .aside-icon {
            background: linear-gradient(135deg, #115C5B 0%, #1a8786 100%) !important;
            box-shadow: 0 4px 12px rgba(17, 92, 91, 0.3);
        }

        .sidebar-link.active .aside-icon i {
            color: #ffffff !important;
        }

        .sidebar-link.active .hide-menu {
            color: #115C5B;
            font-weight: 600;
        }

        .aside-icon {
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
        }

        .sidebar-link:hover .aside-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 4px 12px rgba(17, 92, 91, 0.2);
        }

        .nav-small-cap {
            color: #6c757d;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 24px;
            margin-bottom: 12px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-small-cap-icon {
            color: #115C5B;
            opacity: 0.6;
        }

        .logo-img {
            padding: 16px;
            display: block;
            transition: transform 0.3s ease;
        }

        .logo-img:hover {
            transform: scale(1.05);
        }

        .close-btn {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: #e9ecef;
            transform: rotate(90deg);
        }

        /* Logout Button Special Styling */
        .logout-btn {
            margin-top: 24px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: linear-gradient(90deg, rgba(220, 53, 69, 0.08) 0%, rgba(220, 53, 69, 0.05) 100%);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.15);
        }

        .logout-btn .aside-icon {
            background: linear-gradient(135deg, #fee, #fdd) !important;
        }

        .logout-btn:hover .aside-icon {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
            transform: scale(1.1);
        }

        .logout-btn:hover .aside-icon i {
            color: #ffffff !important;
        }

        /* Scrollbar Styling */
        .scroll-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .scroll-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .scroll-sidebar::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 10px;
        }

        .scroll-sidebar::-webkit-scrollbar-thumb:hover {
            background: #115C5B;
        }

        /* Icon Colors */
        .aside-icon i {
            transition: all 0.3s ease;
        }

        .bg-light-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%) !important;
        }

        .bg-light-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%) !important;
        }

        /* Badge for active state */
        .sidebar-item.active .sidebar-link::after {
            content: '';
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background: #115C5B;
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(17, 92, 91, 0.2);
        }

        /* Hover Animation for Icons */
        @keyframes iconPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.15);
            }
        }

        .sidebar-link:hover .aside-icon i {
            animation: iconPulse 0.6s ease-in-out;
        }
    </style>

    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-simplebar>
        <div class="d-flex mb-4 align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img ms-0 ms-md-1">
                <img src="{{ asset('imagesAdmin/logoHijauAssets.svg') }}" width="180" alt="ASSETS Logo">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="mb-4 pb-2">
                <!-- HOME SECTION -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span class="aside-icon p-2 rounded-3"
                            style="background: linear-gradient(135deg, #115C5B 0%, #1a8786 100%)">
                            <i class="ti ti-home fs-7 text-light"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Dashboard</span>
                    </a>
                </li>

                <!-- DATA SECTION -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Data Management</span>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.datamahasiswa.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.datamahasiswa.*') ? 'active' : '' }}"
                        href="{{ route('admin.datamahasiswa.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 rounded-3 bg-light-success">
                            <i class="ti ti-users fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Mahasiswa</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.datakabinet.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.datakabinet.*') ? 'active' : '' }}"
                        href="{{ route('admin.datakabinet.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-success rounded-3">
                            <i class="ti ti-building fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Kabinet</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.pemira*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.pemira*') ? 'active' : '' }}"
                        href="{{ route('admin.pemira') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-success rounded-3">
                            <i class="ti ti-mailbox fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Pemira</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.datacolorpallete.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.datacolorpallete.*') ? 'active' : '' }}"
                        href="{{ route('admin.datacolorpallete.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-success rounded-3">
                            <i class="ti ti-palette fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Color Palette</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.datadivisi.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.datadivisi.*') ? 'active' : '' }}"
                        href="{{ route('admin.datadivisi.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-success rounded-3">
                            <i class="ti ti-layout-grid fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Divisi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.datastaff.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.datastaff.*') ? 'active' : '' }}"
                        href="{{ route('admin.datastaff.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-success rounded-3">
                            <i class="ti ti-user-check fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Staff</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.dataproker.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.dataproker.*') ? 'active' : '' }}"
                        href="{{ route('admin.dataproker.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-success rounded-3">
                            <i class="ti ti-clipboard-list fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Program Kerja</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.datadokumentasi.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.datadokumentasi.*') ? 'active' : '' }}"
                        href="{{ route('admin.datadokumentasi.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-success rounded-3">
                            <i class="ti ti-camera fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Dokumentasi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">
                    <a class="sidebar-link {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}"
                        href="{{ route('admin.aspirasi.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-success rounded-3">
                            <i class="ti ti-message-circle fs-7 text-secondary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Aspirasi</span>
                    </a>
                </li>

                <!-- AUTH SECTION -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Authentication</span>
                </li>
                <li class="sidebar-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                        @csrf
                        <button type="submit"
                            class="sidebar-link logout-btn d-flex align-items-center bg-transparent border-0 p-0 w-100"
                            aria-expanded="false">
                            <span class="aside-icon p-2 bg-light-warning rounded-3">
                                <i class="ti ti-logout fs-7 text-danger"></i>
                            </span>
                            <span class="hide-menu ms-2 ps-1">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
