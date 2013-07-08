<html>
    <head>
        <link type='text/css'href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,500italic,500,300italic,300' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/bootstrap-responsive.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/base.css') }}" media="all">
        <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/base.responsive.css') }}" media="all">

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="{{ asset('packages/mrjuliuss/syntara/assets/js/bootstrap.min.js') }}"></script> 
        <script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/base.js') }}"></script> 
    </head>
    <body>
        @include('syntara::layouts.dashboard.header')    
        <div id="content">
            <div id="content-header">
            @yield('content')
            </div>
        </div>
        @include('syntara::layouts.dashboard.footer')
    </body>
</html>
