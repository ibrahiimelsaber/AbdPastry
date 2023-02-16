<?php
$route = "";
if (session('role') == 'user') {
    $route = "account.search";
}
if (session('role') == 'branch') {

    $route = "branch.account.search";
}
?>
<form class="form-inline mr-auto" action="{{route($route)}}">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        {{--<li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>--}}
    </ul>
    <div class="search-element">
        <input class="form-control" name="search" type="search"
               placeholder="Search For Account Name Or Phone" aria-label="Search" data-width="300">
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        <div class="search-backdrop"></div>
    </div>
</form>
<ul class="navbar-nav navbar-right">
    {{--<li class="dropdown dropdown-list-toggle">
        <a href="#" data-toggle="dropdown"
           class="nav-link notification-toggle nav-link-lg{{ Auth::user()->unreadNotifications->count() ? ' beep' : '' }}"><i class="far fa-bell"></i></a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifications
          <div class="float-right">
            <a href="#">Mark all As Read</a>
          </div>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
          @if(Auth::user()->unreadNotifications->count())
          @for($i = 1; $i < 40; $i++)
          <a href="#" class="dropdown-item dropdown-item-unread">
            <div class="dropdown-item-icon bg-primary text-white">
              <i class="fas fa-code"></i>
            </div>
            <div class="dropdown-item-desc">
              Template update is available now!
              <div class="time text-primary">2 Min Ago</div>
            </div>
          </a>
          @endfor
          @else
          <p class="text-muted p-2 text-center">No notifications found!</p>
          @endif
        </div>
      </div>
    </li>--}}
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{asset('assets/img/user.jpg')}}" class="rounded-circle mr-1">
            {{--    <img alt="image" src="{{ Auth::user()->avatarlink }}" class="rounded-circle mr-1">--}}
            <div class="d-sm-none d-lg-inline-block">Hi, {{ session('userName') }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            {{--      <div class="dropdown-title"> {{ session('userName') }}</div>--}}
            <div class="dropdown-title">   @if(session('role') == 'user')
                    {{ session('GroupId') == 1 ? 'Agent' : 'Team Leader'}}
                @else
                    {{session('BranchName')}}
                @endif</div>
            <a href="" class="dropdown-item has-icon disabled">
                <i class="far fa-user"></i> {{ session('userName') }}
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
</ul>
