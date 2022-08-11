@extends('layouts.app')
   @section('content')
  
      <body class="bg-light fixed-bottom-bar" >
      <div class="osahan-checkout">
        <div class="bg-primary  px-3 pt-2 pb-5 d-flex align-items-center" >
            <a class="toggle" href="#"><span></span></a>
            <h4 class=" m-0 text-white pl-5" style="width: 60%">الطلبات</h4>
<a class=" text-white font-weight-bold  " href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 40%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
  
         </div>

         <!-- checkout -->
         <div class="p-3 osahan-cart-item">
            <div class="d-flex mb-3 osahan-cart-item-profile bg-white shadow rounded p-3 mt-n5">
               <div class="d-flex flex-column">
                  <h6 class="mb-1 font-weight-bold">الطلبات السابقة</h6>
               </div>
            </div>

@if($orders)

   @foreach($orders as $order)
    <div class="most_sale " >
             
         <div class="row"  >
           <div class="col-12 pt-2 " >
                     <div class="d-flex align-items-center list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        
                        <div class="p-3 position-relative" >
                           <div class="list-card-body">
                              <h6 class="mb-1"><a href="" class="text-black"><i class="feather-archive mr-2 text-danger "></i> طلب #{{$order->reference}}</a></h6>

                              @if($order->status =='1')
                              <span class="text-success">تم  إرسال الطلب</span>
                              @endif
                              @if($order->status =='2')
                              <span class="text-success">تم الاستلام الطلب</span>
                              @endif
                              @if($order->status =='3')
                              <span class="text-success">تم  رفض الطلب</span>
                              @endif
                              @if($order->status =='4')
                              <span class="text-success">تم تسليم الطلب</span>
                              @endif
                               @if($order->status =='5')
                              <span class="text-success">تم إسترجاع الطلب </span>
                              @endif

                              <p class="text-gray mb-1 mt-3 font-weight-bold"> {{$order->total_price}} رس</p>
                              <p class="text-gray mb-3"> <span>{{date('d.m.Y', strtotime($order->created_at))}}
                              
                           </span>  </p>
                           
                           
                              
                           </div>
                           
                        </div>
                     </div>
                  </div>
            </div>

            
         </div>
   @endforeach
@else
    <div class="osahan-slider-item text-center">

                         <div class="d-flex align-items-center justify-content-center mt-5 flex-column">
                            
                           
                            <p class="mt-3">    لا يوجد طلبات سابقة </p>
                         </div>
                      </div>
 @endif        
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
  ">{{Session::get('total_qty')}}</span>@endif</i>                     </a>
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
   </body>
 @endsection



   







