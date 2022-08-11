
@extends('layouts.app')
 @section('content')
   <body class="bg-light fixed-bottom-bar" >
      <div class="osahan-checkout">
         <div class="bg-primary border-bottom px-3 pt-3 pb-5 d-flex align-items-center">
            <a class="toggle" href="#"><span></span></a>
            <h4 class="font-weight-bold m-0 text-white pl-5">السله</h4>
         </div>
         <!-- checkout -->
         <div class="p-3 osahan-cart-item">
            <div class="d-flex mb-3 osahan-cart-item-profile bg-white shadow rounded p-3 mt-n5">
               <div class="d-flex flex-column">
                  <h6 class="mb-1 font-weight-bold">طلبك</h6>
               </div>
            </div>
<div class="osahan-slider-item text-center">

               <div class="d-flex align-items-center justify-content-center mt-5 flex-column">
                  <img src="{{ asset('img/success.png') }}"  height="150px" width="120px" class="img-fluid mx-auto  mt-5" alt="Responsive image">
                 
                 <p class="mt-5">تم إرسال طلبك بنجاح</p>
               </div>
            </div>

             <!-- Footer -->
         <div class="osahan-menu-fotter fixed-bottom bg-white px-3 py-2 text-center">
            <div class="row">
               <div class="col selected">
                  <a href="{{route('home')}}" class="text-danger small font-weight-bold text-decoration-none">
                     <p class="h4 m-0"><i class="feather-home text-danger"></i></p>
                    
                  </a>
               </div>
               <div class="col">
                  <a href="{{route('branches')}}" class="text-dark small font-weight-bold text-decoration-none">
                     <p class="h4 m-0"><i class="feather-map-pin"></i></p>
                     
                  </a>
               </div>
               <div class="col bg-white rounded-circle mt-n4 px-3 py-2">
                  <div class="bg-danger rounded-circle mt-n0 shadow pr-3">
                     <a href="{{route('checkout')}}" class="text-white small font-weight-bold text-decoration-none">
                    <i class="feather-shopping-cart">@if(Session::get('total_qty') > 0)<span style="  position: relative;
  left: ;
  bottom: 25px;
  font-weight: 700;
  font-family: sans-serif;
  font-size: 15px;
  color: #fff;
  width: 20px;
  height: 20px;
  text-align: center;
  ">{{Session::get('total_qty')}}</span>@endif</i>
                     </a>
                  </div>
               </div>
               <div class="col">
                  <a href="{{route('get_orders')}}" class="text-dark small font-weight-bold text-decoration-none">
                     <p class="h4 m-0"><i class="feather-file-text"></i></p>
                    
                  </a>
               </div>
               <div class="col">
                  <a href="{{route('profile')}}" class="text-dark small font-weight-bold text-decoration-none">
                     <p class="h4 m-0"><i class="feather-user"></i></p>
                    
                  </a>
               </div>
            </div>
         </div>
      </div>
     
   </body>
@endsection