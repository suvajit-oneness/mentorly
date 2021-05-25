<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{config('app.name', 'Laravel')}} - @yield('title')</title>
  <link rel="icon" href="{{asset('design/images/logo.png')}}" type="image/gif" sizes="any">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{asset('design/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="{{asset('design/css/slick.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('design/css/slick-theme.css')}}"/>
  <link rel="stylesheet" href="{{asset('design/css/style.css')}}">
  @yield('css')
</head>
<body>
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <script src="{{asset('design/js/jquery.min.js')}}"></script>
    <script src="{{asset('design/js/popper.min.js')}}"></script>
    <script src="{{asset('design/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('design/js/slick.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script>

        @if(Session::has('Success'))
            swal('Success','{{Session::get('Success')}}');
        @elseif(Session::has('Errors'))
            swal('Error','{{Session::get('Errors')}}');
        @endif

        function isNumberKey(evt){  
            if(evt.charCode >= 48 && evt.charCode <= 57){  
                return true;  
            }  
            return false;  
        }

        // accordian
        jQuery(document).ready(function($){
            // Acordeon
            $('.dropdown-toggle').click(function(e) {
                e.preventDefault();
                var $this = $(this);
                if ($this.hasClass('dropdown-active')) {
                    $this.removeClass('dropdown-active');
                    $this.next().slideUp(350);
                } else {
                    $this.toggleClass('dropdown-active');
                    $this.next().slideToggle(350);
                    $('.dropdown-toggle').not($(this)).removeClass('dropdown-active');
                    $('.dropdown-inner').not($(this).next()).slideUp('600');
                }
            });
        });
        
        $('.mentor-slider').slick({
          centerMode: false,
          centerPadding: '60px',
          slidesToShow: 3,
          dots: true,
          arrows:false,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
              }
            }
          ]
        });
    </script>
    @yield('script')
</body>
</html>