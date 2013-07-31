<div class="navbar">
    <div class="container">
        
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Syntara Dashboard</a>
        @if (Sentry::check())
        <div class="nav-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav pull-right">
                <li class="" ><a title="" href="{{ URL::to('dashboard/profile'); }}"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
                <li class=""><a title="" href="{{ URL::to('dashboard/logout'); }}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
        @endif
    </div>
</div>


<!-- Side bar -->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-pencil"></i>Menu</a>
    <ul>
        <li class="active"><a href="{{ URL::to('dashboard'); }}"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
        @if (Sentry::check())
        <li class="submenu"><a href="#"><i class="icon icon-user"></i><span>Users</span></a>
            <ul>    
                <li><a href="{{ URL::to('dashboard/users'); }}">Users</a></li>
                <li><a href="{{ URL::to('dashboard/groups'); }}">Groups</a></li>
            </ul>
        </li>
        @endif
    </ul>
</div>
