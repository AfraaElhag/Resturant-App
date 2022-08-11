<!doctype html>

@if( app()->getLocale()== 'ar')
<html lang="{{ app()->getLocale() }}" dir="rtl" >
@else
<html lang="{{ app()->getLocale() }}" >

@endif


<head>


       <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="الجرة الحجازية">
      <meta name="author" content="الجرة الحجازية">
      <link rel="icon" type="image/png"   href="{{ asset('img/logo.png') }}">
      <title>الجرة الحجازية</title>
     
      <!-- Modify RTL css file -->
      @if (App::getLocale() == 'ar')
      <!-- Slick Slider -->
     

      
      <!-- Feather Icon-->
      <link  rel="stylesheet" type="text/css" href="{{ asset('vendor/icons/feather-rtl.css') }}" >
      <!-- Bootstrap core CSS -->
       
      <link  rel="stylesheet" type="text/css" href="{{ asset('css/style-rtl.css') }}">
      <link  href="{{ asset('vendor/bootstrap/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css">

       <!-- Sidebar CSS -->
      <link  href="{{ asset('vendor/sidebar/demo-rtl.css') }}" rel="stylesheet" type="text/css">

      @else        
      <!-- Slick Slider -->
      
      <!-- Feather Icon-->
      <link  rel="stylesheet" type="text/css" href="{{ asset('vendor/icons/feather.css') }}" >

      <!-- Bootstrap core CSS -->
      <link  rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css"/>
      <link  href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Sidebar CSS -->
      <link  href="{{ asset('vendor/sidebar/demo.css') }}" rel="stylesheet" type="text/css">
      @endif

        <style type="text/css">          
          #toggle_menu,#toggle_menu::before,#toggle_menu::after{
            background: linear-gradient(-45deg, #d92662 0%, #e23744 100%);          }
          .hc-offcanvas-nav h2 {
            display:  none;
          }
 #product_menu,#product_menu::before,#product_menu::after{
 background: linear-gradient(-45deg, #d92662 0%, #e23744 100%);
          }
          
  button:focus {
    box-shadow: none !important;
}

.btn:focus {
    box-shadow: none !important;
}

.btn:active { 
            transform: scale(0.95); 
         
        } 
  
        button:active { 
            transform: scale(0.95); 
         
        } 
 textarea:focus , .btn-primary{border:none;
}
 textarea:focus , input:focus {
    outline: none !important;
   
    box-shadow: 0 0 5px #e29fa4 !important;
}
        </style>

      
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'الجرة الحجازية') }}</title>
</head>

<body>      
  @yield('content')        
    <nav id="main-nav">
         <ul class="second-nav">
           <li ><img src="{{ asset('img/logo.png') }}" width="72" height="72" style="border-radius: 50%;align-self: center;"></li>
            <li><a href="{{route('home')}}"><i class="feather-home mr-2 text-danger" ></i> {{__('lang.Home Page')}}</a></li>
 @if(!(Auth::check())) 
            <li><a href="{{route('loginform')}}"><i class="feather-log-in mr-2 text-danger"></i>{{__('lang.Login')}}</a></li>
            <li><a href="{{route('signupform')}}"><i class="feather-user-plus mr-2 text-danger"></i>{{__('lang.Register')}}</a></li>
@endif
            <li><a href="{{route('branches')}}"><i class="feather-map-pin mr-2 text-danger"></i> {{__('lang.Branches')}}</a></li>
            <li><a href="{{route('profile')}}"><i class="feather-user mr-2 text-danger"></i>{{__('lang.Profile')}}</a></li>
            <li><a href="{{route('about_us')}}">{{__('lang.About Us')}}</a></li>
            <li><a href="{{route('faq')}}">{{__('lang.FAQ')}}</a></li>
            <li><a href="{{route('contact')}}">{{__('lang.Contact Us')}}</a> </li>
 @if (Auth::check())             
<li >
              <form action="{{ route('logout') }}" method="POST" >
                @csrf
                  <button type="submit" style="border: none; " class="p-2 rounded bg-primary text-white"><i class="feather-log-out mr-2 "></i>{{__('lang.Logout')}} </button>
              </form>    
            </li>
@endif
         </ul>
      </nav>

       @yield('content2')
    <!-- Bootstrap core JavaScript -->
      <script  src="{{ asset('vendor/jquery/jquery.min.js') }}" ></script>      
      <script  src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

      <!-- slick Slider JS-->
      <script type="text/javascript"  src="{{ asset('vendor/slick/slick2.min.js') }}"></script>
      <!-- Sidebar JS-->
      <script type="text/javascript" src="{{ asset('vendor/sidebar/hc-offcanvas-nav.js') }}"></script>
      <!-- Custom scripts for all pages-->
      <script  src="{{ asset('js/osahan.js') }}"></script>

<script  src="{{ asset('js/lazyload.js') }}"></script>
<script  src="{{ asset('js/double_submission.js') }}"></script>

</body>


</html>

