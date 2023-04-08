<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="#" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img logo-img-lg" src="{{ url('images/logo.png') }}" srcset="{{ url('images/logo2x.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ url('images/logo-dark.png') }}" srcset="{{ url('images/logo-dark2x.png') }} 2x" alt="logo-dark">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">DASHBOARD</h6>
                    </li>

                    <div class="nk-menu-item list-menu {{ active_menu('dashboard') }}">
                        <a href="{{ route('dashboard') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-activity-round-fill"></em>
                            </span>
                            <span class="nk-menu-text letter-space-1 ff-mono">Dashboard</span>
                        </a>
                    </div>

                    @if (Gate::check('customers-view') || Gate::check('items-view'))
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">MASTER</h6>
                        </li>

                        @can('customers-view')
                            <div class="nk-menu-item list-menu {{ active_menu('customer') }}">
                                <a href="{{ route('customer.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-user-list-fill"></em>
                                    </span>
                                    <span class="nk-menu-text letter-space-1 ff-mono">Customers</span>
                                </a>
                            </div>
                        @endcan

                        @can('items-view')
                            <div class="nk-menu-item list-menu {{ active_menu('item') }}">
                                <a href="{{ route('item.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon">
                                        <em class="icon ni ni-card-view"></em>
                                    </span>
                                    <span class="nk-menu-text letter-space-1 ff-mono">Items</span>
                                </a>
                            </div>
                        @endcan
                    @endif


                    @can('orders-view')
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">TRANSACTION</h6>
                        </li>
                        <div class="nk-menu-item list-menu {{ active_menu('order') }}">
                            <a href="{{ route('order.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-cc-alt2-fill"></em>
                                </span>
                                <span class="nk-menu-text letter-space-1 ff-mono">Orders</span>
                            </a>
                        </div>
                    @endcan

                    @can('users-view')
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">USER MANAGEMENT</h6>
                        </li>
                        <div class="nk-menu-item list-menu {{ active_menu('user') }}">
                            <a href="{{ route('user.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-users-fill"></em>
                                </span>
                                <span class="nk-menu-text letter-space-1 ff-mono">Users</span>
                            </a>
                        </div>
                    @endcan

                    @if (Gate::check('roles-view') || Gate::check('permissions-view'))
                        <div class="nk-menu-item list-menu has-sub {{ active_menu('permission') }} {{ active_menu('role') }}">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-shield-half"></em>
                                </span>
                                <span class="nk-menu-text letter-space-1 ff-mono">
                                    Privileges
                                </span>
                            </a>
                            <ul class="nk-menu-sub">
                                @can('roles-view')
                                    <div class="nk-menu-item list-menu {{ active_menu('role') }}">
                                        <a href="{{ route('role.index') }}" class="nk-menu-link">
                                            <span class="nk-menu-text letter-space-1">Roles</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('permissions-view')
                                    <div class="nk-menu-item list-menu {{ active_menu('permission') }}">
                                        <a href="{{ route('permission.index') }}" class="nk-menu-link">
                                            <span class="nk-menu-text letter-space-1">Permissions</span>
                                        </a>
                                    </div>
                                @endcan
                            </ul>
                        </div>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
