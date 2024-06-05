<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="flex-row nav navbar-nav">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('front.dashboard') }}"><span
                        class="brand-logo">
                        {{-- <img src="#"> --}}
                    </span>
                    <h2 class="brand-text">{{ env('APP_NAME') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                        data-ticon="disc"></i></a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if (Route::is('front.dashboard')) active @endif nav-item"><a class="d-flex align-items-center"
                    href="{{ route('front.dashboard') }}"><i data-feather="home"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
            </li>

            <li class="@if (Route::is('front.profile')) active @endif nav-item"><a class="d-flex align-items-center"
                    href="{{ route('front.profile') }}"><i data-feather="user"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboards">Profile</span></a>
            </li>

            <li class="@if (Route::is('Store.income')) active @endif nav-item"><a class="d-flex align-items-center"
                    href="{{ route('Store.income') }}"><i data-feather="plus"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboards">Income</span></a>
            </li>

            <li class="@if (Route::is('Store.expense')) active @endif nav-item"><a class="d-flex align-items-center"
                    href="{{ route('Store.expense') }}"><i data-feather="minus"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboards">Expense</span></a>
            </li>

            <li class="@if (Route::is('Store.pending')) active @endif nav-item"><a class="d-flex align-items-center"
                href="{{ route('Store.pending') }}"><i data-feather="pen-tool"></i><span
                    class="menu-title text-truncate" data-i18n="Pending Orders">Pendings</span></a>
        </li>

            <li class="@if (Route::is('Store.balancesheet')) active @endif nav-item"><a class="d-flex align-items-center"
                href="{{ route('Store.balancesheet') }}"><i data-feather="bar-chart"></i><span
                    class="menu-title text-truncate" data-i18n="Dashboards">Balance Sheet</span></a>
        </li>

            @canany(['Super-Admin-View','Admin-View'])
            <li class="@if (Route::is('Managment.profiUserManagmentle')) active @endif nav-item"><a
                    class="d-flex align-items-center" href="{{ route('Managment.UserManagment') }}"><i
                        data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Dashboards">User
                        Managment</span></a>
            </li>
            @endcan
            <li class="@if (Route::is('Store.index')) active @endif nav-item"><a class="d-flex align-items-center"
                    href="{{ route('Store.index') }}"><i data-feather="shopping-bag"></i><span
                        class="menu-title text-truncate" data-i18n="Store">Store
                    </span></a>
            </li>

            <li class="@if (Route::is('Store.manage')) active @endif nav-item"><a class="d-flex align-items-center"
                    href="{{ route('Store.manage') }}"><i data-feather="shopping-cart"></i><span
                        class="menu-title text-truncate" data-i18n="item">Manage Orders
                    </span></a>
            </li>

            @can('Super-Admin-View')
            <li class="navigation-header"><span data-i18n="Apps &amp; Pages">Super Admin's Section</span><i
                    data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                    <i class="fas fa-building"></i><span class="menu-title text-truncate" data-i18n="Invoice">Roles And
                        Permission </span></a>
                <ul class="menu-content">
                    <li class="@if (Route::is('Roles.role')) active @endif nav-item"><a
                            class=" d-flex align-items-center" href="{{route('Roles.role')}}"><i
                                data-feather="award"></i><span class="menu-item text-truncate"
                                data-i18n="List">Role</span></a>
                    </li>
                    <li class="@if (Route::is('Roles.permission')) active @endif nav-item"><a
                            class="d-flex align-items-center" href="{{route('Roles.permission')}}"><i
                                data-feather="award"></i><span class="menu-item text-truncate"
                                data-i18n="Preview">Permission </span></a>
                    </li>
                </ul>
            </li>
            @endcan
            @canany(['Super-Admin-View','Admin-View'])
            <li class="navigation-header"><span data-i18n="Apps &amp; Pages">Store's Section</span><i
                    data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                    <i class="fas fa-building"></i><span class="menu-title text-truncate" data-i18n="shopping-cart">Item
                        Managment </span></a>
                <ul class="menu-content">
                    <li class="@if (Route::is('Managment.category')) active @endif nav-item"><a
                            class=" d-flex align-items-center" href="{{route('Managment.category')}}"><i
                                data-feather="folder-plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">Categories </span></a>
                    </li>
                    <li class="@if (Route::is('Managment.sub_category')) active @endif nav-item"><a
                            class="d-flex align-items-center" href="{{route('Managment.sub_category')}}"><i
                                data-feather="shopping-bag"></i><span class="menu-item text-truncate"
                                data-i18n="Preview">Sub Category </span></a>
                    </li>
                    <li class="@if (Route::is('Managment.unit')) active @endif nav-item"><a
                            class="d-flex align-items-center" href="{{route('Managment.unit')}}"><i
                                data-feather="shopping-cart"></i><span class="menu-item text-truncate"
                                data-i18n="Preview">Item </span></a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
        <hr>
        <h6 class="mb-3 text-center">Crafted with ❤️ by <a href="#">FAST | DEVs</a></h6>
    </div>
</div>
<!-- END: Main Menu-->