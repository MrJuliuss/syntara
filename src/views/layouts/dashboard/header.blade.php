<div class="navbar main-bar">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Syntara Dashboard</a>
    <ul class="nav navbar-nav">
        <li class=""><a href="{{ URL::to('dashboard'); }}"><i class="glyphicon glyphicon-home"></i> <span>Dashboard</span></a></li>
        @if (Sentry::check())
        <li class="dropdown" >
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <span>Users</span></a></a>
            <ul class="dropdown-menu">
                <li><a href="{{ URL::to('dashboard/users'); }}">Users</a></li>
                <li><a href="{{ URL::to('dashboard/groups'); }}">Groups</a></li>
            </ul>
        </li>
        @endif
    </ul>

    @if (Sentry::check())
    <div class="nav-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav pull-right">
            <li class="" ><a title="" href="{{ URL::to('dashboard/profile'); }}"><i class="glyphicon glyphicon-user"></i> <span class="text">Profile</span></a></li>
            <li class=""><a title="" href="{{ URL::to('dashboard/logout'); }}"><i class="glyphicon glyphicon-share-alt"></i> <span class="text">Logout</span></a></li>
        </ul>
    </div>
    @endif
</div>