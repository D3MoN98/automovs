<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="{{Route::is('admin.dashboard') ? 'active' : ''}}" href="{{route('admin.dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{in_array(Route::currentRouteName(), ['admin.user.index', 'admin.user.edit']) ? 'active' : ''}}" href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Route::is('admin.user.index') ? 'active' : ''}}"><a href="{{route('admin.user.index')}}">All User List</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{in_array(Route::currentRouteName(), ['admin.vehicle.index', 'admin.vehicle.create', 'admin.vehicle.edit', 'admin.vehicle_book.index', 'admin.vehicle_purchase.index']) ? 'active' : ''}}" href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Vehicles</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Route::is('admin.vehicle.create') ? 'active' : ''}}"><a href="{{route('admin.vehicle.create')}}">Add A Vehicle</a></li>
                        <li class="{{Route::is('admin.vehicle.index') ? 'active' : ''}}"><a href="{{route('admin.vehicle.index')}}">All Vehicle List</a></li>
                        <li class="{{Route::is('admin.vehicle_book.index') ? 'active' : ''}}"><a href="{{route('admin.vehicle_book.index')}}">Vehicle Books</a></li>
                        <li class="{{Route::is('admin.vehicle_purchase.index') ? 'active' : ''}}"><a href="{{route('admin.vehicle_purchase.index')}}">Vehicle Purchases</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{in_array(Route::currentRouteName(), ['admin.service_type.index', 'admin.service_type.create', 'admin.service_type.edit']) ? 'active' : ''}}" href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Service Types</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Route::is('admin.service_type.create') ? 'active' : ''}}"><a href="{{route('admin.service_type.create')}}">Add A Service Type</a></li>
                        <li class="{{Route::is('admin.service_type.index') ? 'active' : ''}}"><a href="{{route('admin.service_type.index')}}">All Service Type List</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a class="{{in_array(Route::currentRouteName(), ['admin.service.index', 'admin.service.create', 'admin.service.edit', 'admin.service_book.index']) ? 'active' : ''}}" href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Services</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Route::is('admin.service.create') ? 'active' : ''}}"><a href="{{route('admin.service.create')}}">Add A Service</a></li>
                        <li class="{{Route::is('admin.service.index') ? 'active' : ''}}"><a href="{{route('admin.service.index')}}">All Service List</a></li>
                        <li class="{{Route::is('admin.service_book.index') ? 'active' : ''}}"><a href="{{route('admin.service_book.index')}}">Service Books</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a class="{{in_array(Route::currentRouteName(), ['admin.payment.index', 'admin.payment.show']) ? 'active' : ''}}" href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Payments</span>
                    </a>
                    <ul class="sub">
                        <li class="{{Route::is('admin.payment.index') ? 'active' : ''}}"><a href="{{route('admin.payment.index')}}">All Payments</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
