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
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>@lang('admin::admin.admins')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('admins.index') }}"><i class="fa fa-users"></i> @lang('admin::admin.admins')</a></li>
                    <li><a href="{{ route('admins.create') }}"><i class="fa fa-plus"></i> @lang('adminpanel::adminpanel.add')</a></li>
                </ul>
            </li>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>@lang('user::user.users')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> @lang('user::user.users')</a></li>
                    <li><a href="{{ route('users.create') }}"><i class="fa fa-plus"></i> @lang('adminpanel::adminpanel.add')</a></li>
                </ul>
            </li>

            <li class="active treeview">
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

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
