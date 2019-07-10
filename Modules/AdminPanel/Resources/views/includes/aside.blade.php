<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset(admin()->image)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{admin()->full_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> @lang('adminpanel::adminpanel.online')</a>
            </div>
        </div>

        <!-- start search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="@lang('adminpanel::adminpanel.search')">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- end search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">@lang('adminpanel::adminpanel.main_navigation')</li>

            <li class=" {{ active('admins') }} treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i> <span>@lang('admin::admin.admins')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('admins.index') }}"><i class="fa fa-user-secret"></i> @lang('admin::admin.admins')</a></li>
                    <li><a href="{{ route('admins.create') }}"><i class="fa fa-plus"></i> @lang('adminpanel::adminpanel.add')</a></li>
                </ul>
            </li>

            <li class=" {{ active('users') }} treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>@lang('user::user.users')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> @lang('user::user.users')</a></li>
                    <li><a href="{{ route('users.create') }}"><i class="fa fa-plus"></i> @lang('adminpanel::adminpanel.add')</a></li>
                </ul>
            </li>

            <li class=" {{ active('services') }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>@lang('service::service.services')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="active">
                        <a href="{{ route('service-categories.index') }}"><i class="fa fa-users"></i>
                            @lang('service::category.categories')
                        </a>
                    </li>

                    <li class="active">
                        <a href="{{ route('services.index') }}"><i class="fa fa-users"></i>
                            @lang('service::service.services')
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" {{ active('trips') }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>@lang('trip::trip.trips')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="active">
                        <a href="{{ route('trip-categories.index') }}"><i class="fa fa-users"></i>
                            @lang('trip::category.categories')
                        </a>
                    </li>

                    <li class="active">
                        <a href="{{ route('trips.index') }}"><i class="fa fa-users"></i>
                            @lang('trip::trip.trips')
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
