<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('doctor.index') }}">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('doctor.index') }}">P</a>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ Request::route()->getName() == 'doctor.index' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('doctor.index') }}">
                <i class="fa fa-columns"></i> <span>Panel Home</span>
            </a>
        </li>

        @can('view-users')
            <li class="{{ Request::route()->getName() == 'doctor.users' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.users.index') }}">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
            </li>
        @endcan

        @can('view-courses')
            <li class="{{ Request::route()->getName() == 'doctor.courses.index' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('doctor.courses.index') }}">
                    <i class="fa fa-book"></i> <span>Courses</span>
                </a>
            </li>
        @endcan

        {{--        @can('view-earnings')--}}
        {{--            <li class="{{ Request::route()->getName() == 'doctor.courses.index' ? ' active' : '' }}">--}}
        {{--                <a class="nav-link" href="{{ route("") }}">--}}
        {{--                    <i class="fa fa-book"></i> <span>Earnings</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--        @endcan--}}

        {{--        @can('view-course-sessions')--}}
        {{--            <li class="{{ Request::route()->getName() == 'doctor.course-sessions.index' ? ' active' : '' }}">--}}
        {{--                <a class="nav-link" href="{{ route('doctor.course-sessions.index') }}">--}}
        {{--                    <i class="fa fa-clock"></i> <span>Course Session</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--        @endcan--}}

        {{--        @can('view-items')--}}
        {{--            <li class="{{ Request::route()->getName() == 'doctor.items' ? ' active' : '' }}">--}}
        {{--                <a class="nav-link" href="{{ route('doctor.items.index') }}">--}}
        {{--                    <i class="fa fa-book"></i> <span>Items</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--        @endcan--}}

        {{--        @can('view-announcements')--}}
        {{--            <li class="{{ Request::route()->getName() == 'doctor.announcements' ? ' active' : '' }}">--}}
        {{--                <a class="nav-link" href="{{ route('doctor.announcements.index') }}">--}}
        {{--                    <i class="fa fa-bullhorn"></i> <span>Announcements</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--        @endcan--}}
    </ul>
</aside>
