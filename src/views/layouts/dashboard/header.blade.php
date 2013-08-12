<div class="navbar main-bar">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
            Syntara
            <div class="visible-sm"><img class="ajax-loader ajax-loader-sm" src="{{ asset('packages/mrjuliuss/syntara/assets/img/ajax-load.gif') }}" style="float: right;"/></div>
        </a>
        <div class="nav-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class=""><a href="{{ URL::to('dashboard'); }}"><i class="glyphicon glyphicon-home"></i> <span>Dashboard</span></a></li>
                @if (Sentry::check())
                <li class="dropdown" >
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <span>Users</span></a></a>
                    <ul class="dropdown-menu">
                        @if($currentUser->hasAccess('view-users-list'))
                        <li><a href="{{ URL::to('dashboard/users'); }}">Users</a></li>
                        @endif

                        @if($currentUser->hasAccess('groups-management'))
                        <li><a href="{{ URL::to('dashboard/groups'); }}">Groups</a></li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
            
            @if(Sentry::check())
            <ul class="nav navbar-nav pull-right">
                <li class="hidden-sm"><img class="ajax-loader ajax-loader-lg" src="{{ asset('packages/mrjuliuss/syntara/assets/img/ajax-load.gif') }}" style="float: right;"/></li> 
                <li><a title="" href="{{ URL::to('dashboard/user/'.Sentry::getUser()->getId()); }}"><span class="text">{{ Sentry::getUser()->username }}</span></a></li>
                <li><a title="" href="{{ URL::to('dashboard/logout'); }}"><i class="glyphicon glyphicon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
            @endif
        </div>
    </div>
</div>