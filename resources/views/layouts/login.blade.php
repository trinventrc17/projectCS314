@include('partials.header')

<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
     <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
     <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
</body>
</html>
