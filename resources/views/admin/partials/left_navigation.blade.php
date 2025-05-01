<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('themes/custom/css/assets/admin/Logo.min.svg.png') }}" class="navbar-brand-img h-100"
                alt="main_logo">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <x-admin.left-navigation.nav-item title="Users" image="<i class='fas fa-users text-dark'></i>"
                :link="route('admin.users.index')" :active="str_contains($routeName, 'admin.users') ? 1 : 0" />

            <x-admin.left-navigation.nav-item title="Roles" image="<i class='fas fa-user-shield text-dark'></i>"
                :link="route('admin.roles.index')" :active="str_contains($routeName, 'admin.roles') ? 1 : 0" />

            <x-admin.left-navigation.nav-item title="Permissions" image="<i class='fas fa-key text-dark'></i>"
                :link="route('admin.permissions.index')" :active="str_contains($routeName, 'admin.permissions') ? 1 : 0" />

            <x-admin.left-navigation.nav-item title="Products" image="<i class='fas fa-box text-dark'></i>"
                link="#" active="0" />

            <x-admin.left-navigation.nav-item title="Product Categories" image="<i class='fas fa-th-large text-dark'></i>"
                link="#" active="0" />

            <x-admin.left-navigation.nav-item title="Product Attributes" image="<i class='fas fa-sliders-h text-dark'></i>"
                link="#" active="0" />
        </ul>
    </div>
</aside>
