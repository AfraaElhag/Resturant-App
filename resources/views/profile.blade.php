   @extends('layouts.app')
     @section('content')
   <body class="fixed-bottom-bar bg-light">
      <div class="osahan-profile">
          <div class="bg-primary  px-3 pt-2 pb-5 d-flex align-items-center" >
            <a class="toggle" href="#"><span></span></a>
            <h4 class=" m-0 text-white pl-5" style="width: 60%">الملف الشخصي </h4>
<a href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 40%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
   
         </div>

         
         <!-- profile -->
         <div class="p-3 osahan-profile">
            <div class="bg-white rounded shadow mt-n5">
               <div class="d-flex align-items-center border-bottom p-3">
                  
                  <div class="right">
                     <h6 class="mb-1 font-weight-bold">{{ Auth::user()->name }} <i class="feather-check-circle text-success"></i></h6>
                     <p class="text-muted m-0 small">{{ Auth::user()->phone }}</p>
                  </div>
               </div>
              


<div class="osahan-cart-item-profile bg-white rounded  p-3 mt-3">
                 <div class="flex-column">
               <h6 class="font-weight-bold">{{__('lang.Tell us about yourself')}}</h6>
               <p class="text-muted">{{__('lang.Update Your Information')}}</p>
               <form method="post" action="{{route('update')}}" id="profile">
                  @csrf
                  <div class="form-group">
                     <label for="exampleFormControlInput1" class="small font-weight-bold">{{__('lang.Your Name')}}</label>
                     <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="{{ Auth::user()->name }}" name="name" value="{{ Auth::user()->name }}" >
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlInput2" class="small font-weight-bold">{{__('lang.Email Address')}}</label>
                     <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="{{ Auth::user()->email }}" name="email" value="{{ Auth::user()->email }}">
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlInput3" class="small font-weight-bold">{{__('lang.Phone Number')}}</label>
                     <input type="tel" class="form-control" id="exampleFormControlInput3" placeholder="{{ Auth::user()->phone }}" disabled>
                  </div>
                  
                  <button class="btn btn-primary btn-block" type="SUBMIT">{{__('lang.SUBMIT')}}</button>
               </form>
               
            </div>
         </div>
      </div>


            <!-- profile-details -->
            <div class="bg-white rounded shadow mt-3 profile-details">
              
               <a href="{{route('getaddress')}}" class="d-flex w-100 align-items-center border-bottom p-3">
                  <div class="left mr-3">
                     <h6 class="font-weight-bold mb-1 text-dark">{{__('lang.Address')}}</h6>
                     <p class="small text-muted m-0">{{__('lang.Add or remove a delivery address')}}</p>
                  </div>
                  <div class="right ml-auto">
                     <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                  </div>
               </a>
             
               <a href="{{route('get_orders')}}" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                  <div class="left mr-3">
                     <h6 class="font-weight-bold m-0 text-dark"><i class="feather-truck bg-danger text-white p-2 rounded-circle mr-2"></i> {{__('lang.Previous Orders')}}</h6>
                  </div>
                  <div class="right ml-auto">
                     <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                  </div>
               </a>
             
     
              
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
                  <div class="bg-danger rounded-circle mt-n0 shadow">
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
