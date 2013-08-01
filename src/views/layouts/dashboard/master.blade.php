<html>
    <head>
        <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/mrjuliuss/syntara/assets/css/base.css') }}" media="all">

        <script src="{{ asset('packages/mrjuliuss/syntara/assets/js/jquery-2.0.3.min.js') }}"></script> 
        <script src="{{ asset('packages/mrjuliuss/syntara/assets/js/bootstrap.min.js') }}"></script> 
        <script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/base.js') }}"></script> 
    </head>
    <body>
        @include('syntara::layouts.dashboard.header')    
        <div id="content">
            @yield('content')
        </div>
        @include('syntara::layouts.dashboard.footer')
    </body>
</html>
