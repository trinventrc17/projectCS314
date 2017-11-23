<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Good Times Movie Lounge</title>

    <!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
<!-- <link href="{{ asset('css/site.css') }}" rel="stylesheet" type="text/css" >
 --><link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css" >
<!-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" >
 -->    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken'  => csrf_token(),
            'siteUrlApi' => url('api'),
            'tokenApi'
        ]); ?>
    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', '{{ $google_analytics_id }}', 'auto');
      ga('send', 'pageview');

    </script>
        @yield('assets')
</head>