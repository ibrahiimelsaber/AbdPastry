<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('teacher.index') }}">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('teacher.index') }}">P</a>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ Request::route()->getName() == 'teacher.index' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('teacher.index') }}">
                <i class="fa fa-columns"></i> <span>Panel Home</span>
            </a>
        </li>

        @can('view-users')
            <li class="{{ Request::route()->getName() == 'teacher.users' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('teacher.users.index') }}">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
            </li>
        @endcan

        @can('view-courses')
            <li class="{{ Request::route()->getName() == 'teacher.courses.index' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('teacher.courses.index') }}">
                    <i class="fa fa-book"></i> <span>Courses</span>
                </a>
            </li>
        @endcan

        @can('view-items')
            <li class="{{ Request::route()->getName() == 'teacher.items' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('teacher.items.index') }}">
                    <i class="fa fa-eye"></i> <span>Items</span>
                </a>
            </li>
        @endcan

        {{--        @can('view-earnings')--}}
        {{--            <li class="{{ Request::route()->getName() == 'teacher.courses.index' ? ' active' : '' }}">--}}
        {{--                <a class="nav-link" href="{{ route("") }}">--}}
        {{--                    <i class="fa fa-book"></i> <span>Earnings</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--        @endcan--}}

        {{--        @can('view-announcements')--}}
        {{--            <li class="{{ Request::route()->getName() == 'teacher.announcements' ? ' active' : '' }}">--}}
        {{--                <a class="nav-link" href="{{ route('teacher.announcements.index') }}">--}}
        {{--                    <i class="fa fa-bullhorn"></i> <span>Announcements</span>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--        @endcan--}}

    </ul>
</aside>
