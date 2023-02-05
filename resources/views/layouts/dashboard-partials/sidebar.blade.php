<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="#">{{config('app.name')}}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">P</a>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ Request::route()->getName() === 'dashboard.index' ? ' active' : '' }}">
            <a class="nav-link" href="#">
                <i class="fa fa-columns"></i> <span>Al-Abd Pastry</span>
            </a>
        </li>

{{--        <li class="menu-header">My</li>--}}

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-users"></i> <span>MY</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('my.accounts')}}">Accounts</a>
                </li>

                <li>
                    <a class="nav-link" href="{{route('my.contacts')}}">Contacts</a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('my.accounts')}}">Service Requests</a>
                </li>


            </ul>
        </li>

{{--        <li class="menu-header"><strong>All</strong></li>--}}

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-users"></i> <span>All</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('all.accounts')}}">Accounts</a>
                </li>

                <li>
                    <a class="nav-link" href="{{route('all.contacts')}}">Contacts</a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('my.accounts')}}">Service Requests</a>
                </li>

            </ul>
        </li>


{{--           <li class="menu-header">Service Requests</li>--}}

{{--        <li class="dropdown">--}}
{{--            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">--}}
{{--                <i class="fas fa-server"></i> <span>Service Requests</span>--}}
{{--            </a>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                <li>--}}
{{--                    <a class="nav-link" href="{{route('my.accounts')}}">My Service Requests</a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a class="nav-link" href="{{route('my.accounts')}}">All Service Requests</a>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </li>--}}



    </ul>
</aside>
