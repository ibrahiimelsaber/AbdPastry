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
                <i class="fa fa-users"></i> <span>MY Accounts</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('my.accounts')}}">Accounts</a>
                </li>

{{--                <li>--}}
{{--                    <a class="nav-link" href="{{route('my.contacts')}}">Contacts</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a class="nav-link" href="{{route('my.accounts')}}">Service Requests</a>--}}
{{--                </li>--}}


            </ul>
        </li>



        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-users"></i> <span>MY Contacts</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('my.contacts')}}">Contacts</a>
                </li>




            </ul>
        </li>

{{--        <li class="menu-header"><strong>All</strong></li>--}}

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-users"></i> <span>All Accounts</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{route('all.accounts')}}">Accounts</a>
                </li>


            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-users"></i> <span>All Contacts</span>
            </a>
            <ul class="dropdown-menu">

                <li>
                    <a class="nav-link" href="{{route('all.contacts')}}">Contacts</a>
                </li>


            </ul>
        </li>


        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                <i class="fa fa-users"></i> <span>All Service Requests</span>
            </a>
            <ul class="dropdown-menu">

                <li>
                    <a class="nav-link" href="{{route('all.requests')}}">Service Requests</a>
                </li>


            </ul>
        </li>



    </ul>
</aside>
