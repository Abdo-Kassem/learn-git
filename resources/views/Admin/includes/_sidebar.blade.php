@php
    $segment = Request::segment(3);
    $route = Route::currentRouteName();
@endphp
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left">
          <img src="{{ asset(adminurl()->avatar) }}" style="width:40px;height:40px;border-radius:50%" class="" alt="User Image">
        </div>
        <div class="pull-left info" style="margin-top:10px">
          <p> {{ adminurl()->first_name }} {{ adminurl()->last_name }}</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

            <!--<li class="header">MAIN NAVIGATION</li>-->
            <li class="{{ $route == 'admin.index' ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard text-aqua"></i> <span> {{ trans('backend.dashboard') }}</span></a>
            </li>
        
            <!-- Admins -->
            <li class="{{ $segment == 'admins' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-user-plus"></i> <span>{{ trans('backend.admins') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.admins.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.admins.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.admins') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'admin.admins.create' ? 'active' : '' }}">
                        <a href="{{ route('admin.admins.create') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.create_new') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        
            <li class="{{ $segment == 'users' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-user-plus"></i> <span>{{ trans('backend.users') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.users.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.users') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'admin.users.create' ? 'active' : '' }}">
                        <a href="{{ route('admin.users.create') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.create_new') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- categories-->
            <li class="{{ $segment == 'categories' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-th-large" aria-hidden="true"></i> <span>{{ trans('backend.categories') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.categories.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.categories') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'admin.categories.create' ? 'active' : '' }}">
                        <a href="{{ route('admin.categories.create') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.create_new') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- subcategories-->
            <li class="{{ $segment == 'subcategories' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-th" aria-hidden="true"></i> <span>{{ trans('backend.subcategories') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'subcategories.index' ? 'active' : '' }}">
                        <a href="{{ route('subcategories.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.subcategories') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'subcategories.create' ? 'active' : '' }}">
                        <a href="{{ route('subcategories.create') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.create_new') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- brands-->
            <li class="{{ $segment == 'brands' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-bookmark" aria-hidden="true"></i> <span>{{ trans('backend.brands') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.brands.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.brands.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.brands') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'admin.brands.create' ? 'active' : '' }}">
                        <a href="{{ route('admin.brands.create') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.create_new') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- locations-->
            <li class="{{ $segment == 'locations' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> <span>{{ trans('backend.locations') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'cities.index' ? 'active' : '' }}">
                        <a href="{{ route('cities.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.cities') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'areas.index' ? 'active' : '' }}">
                        <a href="{{ route('areas.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.areas') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- products -->
            <li class="{{ $segment == 'products' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-shopping-bag"></i> <span>{{ trans('backend.products') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.products.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.products.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.products') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'admin.products.create' ? 'active' : '' }}">
                        <a href="{{ route('admin.products.create') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.create_new') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- packages -->
            <li class="{{ $segment == 'packages' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>{{ trans('backend.packages') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'packages.index' ? 'active' : '' }}">
                        <a href="{{ route('packages.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.packages') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'packages.create' ? 'active' : '' }}">
                        <a href="{{ route('packages.create') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.create_new') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- installation subscriptions-->
            <li class="{{ $segment == 'installation-subscriptions' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-money" aria-hidden="true"></i> <span>{{ trans('backend.installation_subscriptions') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.installation-subscriptions.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.installation-subscriptions.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.installation_subscriptions') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- ads -->
            <li class="{{ $segment == 'sliders' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-sliders" aria-hidden="true"></i> <span>{{ trans('backend.ads') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'sliders.index' ? 'active' : '' }}">
                        <a href="{{ route('sliders.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.ads') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'sliders.create' ? 'active' : '' }}">
                        <a href="{{ route('sliders.create') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.create_new') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- rating-->
            <li class="{{ $segment == 'ratings' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="">
                    <i class="fa fa-star" aria-hidden="true"></i> <span>{{ trans('backend.ratings') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.ratings.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.ratings.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.ratings') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- complaints-->
            <li class="{{ $segment == 'complaints' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-flag" aria-hidden="true"></i> <span>{{ trans('backend.complaints') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.complaints.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.complaints.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.complaints') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ $segment == 'pages' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
                <a href="users.html">
                    <i class="fa fa-file" aria-hidden="true"></i> <span>{{ trans('backend.pages') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.pages.contacts.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.pages.contacts.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.contacts') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'admin.pages.privacy-policy.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.pages.privacy-policy.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.privacy_policy') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'admin.pages.about.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.pages.about.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.about') }}</span>
                        </a>
                    </li>
                    <li class="{{ $route == 'admin.pages.setting.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.pages.setting.index') }}">
                            <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                            <span>{{ trans('backend.app_setting') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>