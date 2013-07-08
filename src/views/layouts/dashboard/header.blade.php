<!-- Header left -->
<div id="header">
    <h1><a href="">My Dashboard</a></h1>
</div>
<!-- Header left end--> 

@if (Sentry::check())
<!-- Right header -->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="" ><a title="" href="{{ URL::to('dashboard/profile'); }}"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
        <li class=""><a title="" href="{{ URL::to('dashboard/logout'); }}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    </ul>
</div>
<!-- Right header end -->

<!-- Side bar -->
<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-pencil"></i>Menu</a>
    <ul>
        <li class="active"><a href="{{ URL::to('dashboard'); }}"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
        <li class="submenu"><a href="#"><i class="icon icon-user"></i><span>Users</span></a>
            <ul>    
                <li><a href="dashboard/users">All users</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- Side bar end -->
@endif