<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
{{--        <a href="#">Al-abd</a>--}}
{{--        <img src="{{asset('assets/img/rayacx.jpg')}}" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">--}}
        <img src="{{asset('assets/img/rayacx.jpg')}}" alt="logo" width="80" height="75" class="shadow-light rounded-circle mb-3 mt-2">
        <img src="{{asset('assets/img/abd-logo.jpg')}}" alt="logo" width="85" class="shadow-light rounded-circle mb-3 mt-2">
        <h6>Al- Abd Foods</h6>
        <span class="mt-2"></span>
    </div>
{{--    <div class="sidebar-brand sidebar-brand-sm">--}}
{{--        <a href="#">P</a>--}}
{{--    </div>--}}
    <ul class="sidebar-menu">
{{--        <li class="{{ Request::route()->getName() === 'dashboard.index' ? ' active' : '' }}">--}}
{{--            <a class="nav-link" href="#">--}}
{{--                <i class="fa fa-hamburger"></i> <span>Al-Abd Pastry</span>--}}
{{--            </a>--}}
{{--        </li>--}}


        <li class="menu-header">My Actions</li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-user-tie"></i> <span>MY Accounts</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('my.accounts.index')}}">Accounts</a>
                </li>

            </ul>
        </li>


        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-user-plus"></i> <span>MY Contacts</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('my.contacts.index')}}">Contacts</a>
                </li>


            </ul>
        </li>


        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-tasks"></i> <span>My Service Requests</span>
            </a>
            <ul class="dropdown-menu">

                <li>
                    <a class="nav-link" href="{{route('my.requests.index')}}">Service Requests</a>
                </li>


            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-hand-holding-usd"></i> <span>My Activities</span>
            </a>
            <ul class="dropdown-menu">

                <li>
                    <a class="nav-link" href="{{route('my.activities.index')}}">Activities</a>
                </li>


            </ul>
        </li>

        <li class="menu-header">All Actions</li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-user-tie"></i> <span>All Accounts</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('all.accounts.index')}}">Accounts</a>
                </li>


            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-user-plus"></i> <span>All Contacts</span>
            </a>
            <ul class="dropdown-menu">

                <li>
                    <a class="nav-link" href="{{route('all.contacts.index')}}">Contacts</a>
                </li>


            </ul>
        </li>


        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-tasks"></i> <span>All Service Requests</span>
            </a>
            <ul class="dropdown-menu">

                <li>
                    <a class="nav-link" href="{{route('all.requests.index')}}">Service Requests</a>
                </li>


            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-hand-holding-usd"></i> <span>All Activities</span>
            </a>
            <ul class="dropdown-menu">

                <li>
                    <a class="nav-link" href="{{route('all.activities.index')}}">Activities</a>
                </li>


            </ul>
        </li>

        <li class="menu-header">Management</li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-user"></i> <span>Users Management</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('users.index')}}">Users</a>
                </li>

            </ul>
        </li>



    </ul>
</aside>
