@extends('layouts.app')
     @section('content')
   <body>
      <div class="bg-primary d-flex align-items-center justify-content-center vh-100 index-page">
         <div class="text-center"><img src="img/logo2.png" alt="" style="background-color: white;border-radius: 50%;"><br>
            <div class="spinner"></div></div>
      </div>
      <div class="fixed-bottom d-flex align-items-center justify-content-center">
         <a class="btn btn-block d-flex align-items-center btn-lg btn-warning" href="{{route('home')}}">
           مرحبا بك !  <i class="feather-arrow-right ml-auto"></i>
         </a>
      </div>
    
   </body>
 @endsection