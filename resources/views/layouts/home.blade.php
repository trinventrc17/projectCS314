@include('partials.header')

<body>
        @include('partials.navbar')

        @include('partials.notification')

        @yield('content')
     <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
     <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>

</body>
</html>
