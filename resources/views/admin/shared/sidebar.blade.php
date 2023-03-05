@php
    $activeClass = 'active';
@endphp
<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url('#') }}">Manajemen Barang</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('#') }}">LS</a>
    </div>
    <ul class="sidebar-menu">
        {{-- <li class="{{ $currentAdminMenu == 'dashboard' ? $activeClass : '' }}"><a class="nav-link"
                href="{{ url('admin/dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li> --}}
        @foreach ($moduleAdminMenus as $moduleAdminMenu)
            @php
                $check = false;
            @endphp
            @foreach ($moduleAdminMenu['admin_menus'] as $moduleMenu)
                @php
                    $check = $check || Gate::check($moduleMenu['permission']);
                @endphp
            @endforeach
            @if ($check)
                <li class="menu-header">{{ $moduleAdminMenu['label'] }}</li>
            @endif
            @foreach ($moduleAdminMenu['admin_menus'] as $moduleMenu)
                @can($moduleMenu['permission'])
                    <li class="{{ $moduleMenu['route'] == implode('/', request()->segments()) ? $activeClass : '' }}"><a
                            class="nav-link" href="{{ url($moduleMenu['route']) }}"><i class="{{ $moduleMenu['icon'] }}"></i>
                            <span>{{ $moduleMenu['name'] }}</span></a></li>
                @endcan
            @endforeach
        @endforeach
        <li class="menu-header">@lang('general.menu_account_label')</li>
        @can('view_users')
            <li class="{{ $currentAdminMenu == 'users' ? $activeClass : '' }}"><a class="nav-link"
                    href="{{ url('admin/users') }}"><i class="fas fa-user"></i> <span>Users</span></a></li>
        @endcan
        @can('view_roles')
            <li class="{{ $currentAdminMenu == 'roles' ? $activeClass : '' }}"><a class="nav-link"
                    href="{{ url('admin/roles') }}"><i class="fas fa-lock"></i> <span>@lang('roles.menu_role_label')</span></a></li>
        @endcan
        @if (auth()->user()->hasRole(\App\Models\Role::ADMIN))
            <li class="{{ $currentAdminMenu == 'settings' ? $activeClass : '' }}"><a class="nav-link"
                    href="{{ url('admin/settings') }}"><i class="fas fa-cogs"></i> <span>@lang('settings.menu_settings_label')</span></a>
            </li>
        @endif
    </ul>
</aside>
