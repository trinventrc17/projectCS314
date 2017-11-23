@include('partials.header')

<body>
    <div id="app">
        @include('partials.navbar')

        @include('partials.notification')

        @yield('content')

        
    </div>
    <!-- Scripts -->
     <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
     <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
</body>
</html>
