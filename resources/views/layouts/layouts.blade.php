<html>
    <head>
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(function(){
          $("#test").on("click",function(){
            $("#copy").clone(true).appendTo("#tuika");
          });
        });

        </script>
        
        
        
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/stylesheet.css')}}" rel="stylesheet">
    </head>
    <body>
        
        @component('components.header')
        @endcomponent
        

            @yield('content')

        
        @component('components.footer')
        @endcomponent
        
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html> 
