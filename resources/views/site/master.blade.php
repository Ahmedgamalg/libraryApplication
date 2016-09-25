<!DOCTYPE html>
<html lang="en">
<head>


    <title>Library</title>
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/bootstrap.min.css')}}">
    {!! Html::style('website/css/bootstrap.min.css') !!}
    {!! Html::style('website/css/flexslider.css') !!}
    {!! Html::style('website/css/style.css') !!}
    {!! Html::style('website/css/font-awesome.min.css') !!}
    {!! Html::script('website/js/jquery.min.js') !!}
    
   @yield('background')


</head>
<body id="app-layout" style="direction:rtl">
  <div class="header">
  <div class="container"> <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-paper-plane"></i> مكتبتى</a>
    <div class="menu pull-left" > <a class="toggleMenu" href="#"><img src="images/nav_icon.png" alt="" /> </a>
      <ul class="nav" id="nav">
      @if(Auth::check())

        <li class="current"><a href="/library">الرئيسيه</a></li>
        <li><a href="/summery">الملخص</a></li>
        <li><a href="services.html">الخدمات</a></li>
        <li><a href="/admin">الادمن</a></li>
        <li><a href="{{ url('/logout') }}">تسجيل الخروج</a></li>
        
        @endif
        <div class="clear"></div>
      </ul>

    </div>
  </div>
</div>
@if(Session::has('m'))
<div class="container">
  <?php $a=[]; 
  $a=session()->pull('m'); ?>
  <div class="alert alert-{{$a[0]}}">
    {{$a[1]}}
  </div>
</div>
@endif
    @yield('content')

  </nav>
  <div class="footer">
  <div class="footer_bottom">
    <div class="follow-us"> <a class="fa fa-facebook social-icon" href="#"></a> <a class="fa fa-twitter social-icon" href="#"></a> <a class="fa fa-linkedin social-icon" href="#"></a> <a class="fa fa-google-plus social-icon" href="#"></a> </div>
    <div class="copy">
      <p>Copyright &copy; 2015 Company Name. Design by Ahmed Gamal</p>
    </div>
  </div>
</div>

{!! Html::script('website/js/responsive-nav.js') !!}
{!! Html::script('website/js/bootstrap.min.js') !!}
{!! Html::script('website/js/jquery.flexslider.js') !!}

</body>
</html>
