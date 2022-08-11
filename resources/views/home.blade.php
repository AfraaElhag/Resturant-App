       <style type="text/css">
        .tabbable .nav-tabs {
   overflow-x: auto;
   overflow-y:hidden;
   flex-wrap: nowrap;
}
.tabbable .nav-tabs .nav-link {
  white-space: nowrap;
}







       
</style>



@extends('layouts.app')
     @section('content')
   <body class="fixed-bottom-bar" >
      <div class="osahan-home-page">
         <div class="">
            <div class="">
               <div class="title d-flex align-items-center" >
                  <a class="toggle mt-1" href="#" >
                  <span  id="toggle_menu"></span>
                  </a>
                  <div style="margin:0px auto; ">
                  <img data-src="{{ asset('img/logo3.png') }}" width="72" height="72" style="align-self: center;" class="lazy"></div>
                
               </div>
            </div>
           
         </div>
        
          <!-- Discounts -->
           
               @foreach($discount as $dis)
                  @if($dis->products)
                     @if($dis->name == 'APP_Discount')

                      <div class=" title d-flex align-items-center bg-primary text-white p-3 ">
                        @if($dis->is_percentage == false)
                           <h5 class="m-0 ">عرض لفترة محدودة  خصم {{$dis->amount}} رس<h5>  
                           @else
                           <h5 class="m-0  ">عرض لفترة محدودة  خصم {{$dis->amount}} %<h5>
                        @endif 
                     </div>

            <div class="offer-slider bg-white border-top border-bottom " style="direction: ltr;">
            @foreach($dis->products as $promo)
               <div class="cat-item px-1 py-3" >
                  <a class="bg-white d-block text-center shadow" href="{{ route('product',['id' => $promo->id] ) }}">
                  @if($promo->image)
                           <img data-src="{{ $promo->image }}" class="img-fluid rounded lazy" >
                           @else
                           <img data-src="{{ asset('img/no-image.png') }}" class="img-fluid rounded lazy">
                           @endif

                 
                  </a>
               </div>
               @endforeach
              
         </div>
                     @endif
                  @endif
               @endforeach    

            

         <!-- latest products -->
         @if(count($latest_products) != 0)
            <div class=" title d-flex align-items-center bg-primary text-white p-3 ">
               <h5 class="m-0">المنتجات الجديدة<h5>  
                  
            </div>
         @endif

           
         <div class="offer-slider bg-white border-top border-bottom " style="direction: ltr;">
            @foreach($latest_products as $latest)
               <div class="cat-item px-1 py-3" >
                  <a class="bg-white d-block text-center shadow" href="{{ route('product',['id' => $latest->id] ) }}">
                  @if($latest->image)
                           <img data-src="{{ $latest->image }}" class="img-fluid rounded lazy">
                           @else
                           <img data-src="{{ asset('img/no-image.png') }}" class="img-fluid rounded lazy">
                           @endif
                  
                  </a>
               </div>
               @endforeach
              
         </div>
            

         <div class="bg-light ">


         
          <nav class="tabbable ">
            <div class="nav nav-tabs  align-middle  py-2 col" id="myTab" role="tablist" style="">
              @foreach($categories as $category) 
                    <a class="nav-item nav-link  align-items-center  rounded small  " id="menu{{$category->id}}" data-toggle="tab" href="#tab{{$category->id}}" role="tab" aria-controls="tab{{$category->id}}" aria-selected="true"  style=" color: inherit;border: none; ">{{$category->name}}</a>
                     @endforeach
              
            </div>

          </nav>
         
       </div>




         <div class="tab-content"> 
            <!-- all products -->
            <div class="most_sale px-3 pb-3 tab-pane fade show active" >
               @foreach($products as $product)
                  <div class="row">
                  <div class="col-12 pt-2 ">
                     <div class="d-flex align-items-center list-card bg-white h-100 rounded overflow-hidden    position-relative shadow-sm">
                        <div class="list-card-image">
                           
                          
                           <a href="{{ route('product',['id' => $product->id] ) }}">
                            @if($product->image)
                           <img data-src="{{$product->image}}" class="img-fluid item-img w-100 lazy">
                           @else
                           <img data-src="{{ asset('img/no-image.png') }}" class="img-fluid item-img w-100 lazy">
                           @endif
                           </a>
                        </div>
                        <div class="p-3 position-relative">
                           <div class="list-card-body">
                              <h6 class="mb-1"><a href="{{ route('product',['id' => $product->id] ) }}" class="text-black">{{$product->name}}</a></h6>
                              <p class="text-gray mb-3">{{$product->description}}</p>
                              @if($product->discounts)
				<?php $var=NULL ?>
                                 @foreach($product->discounts as $discount)
					

                                    @if($discount->name == 'APP_Discount')

                                      <?php $var='true' ?>

                                      @if($discount->is_percentage == false)
                                       <h6 class="mb-1 text-black">{{$product->price - $discount->amount}} ر س
                                    <span class="mb-1 ml-4 text-black line-through float-right"><del>{{$product->price}} </del>ر س</span></h6>
                                    @else

                                     <h6 class="mb-1 text-black">{{$product->price}} ر س
                                    <span class="mb-1 ml-4 text-black line-through float-right text-muted">خصم {{$discount->amount}} % <span></h6>
                                    @endif
                                    @endif
                                 @endforeach

                                  @if(!(isset($var)))
                                  <h6 class="mb-1 text-black">{{$product->price}} ر س</h6>
                                    @endif

                              @else
                                 <h6 class="mb-1 text-black">{{$product->price}} ر س</h6>
                              @endif      
                              
                           </div>
                           
                        </div>
                     </div>
                  </div>
            </div>
            @endforeach
         </div>

            @foreach($categories as $category)
               <div class="most_sale px-3 pb-3 tab-pane fade" id="tab{{$category->id}}" role="tabpanel" aria-labelledby="menu{{$category->id}}">
                  @foreach($category->products as $product)
			 @if($product->deleted_at == null)
               <div class="row">
                 <div class="col-12 pt-2 ">
                     <div class="d-flex align-items-center list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                        <div class="list-card-image">
                           
                          
                           <a href="{{ route('product',['id' => $product->id] ) }}">

                            @if($product->image)
                           <img data-src="{{$product->image}}" class="img-fluid item-img w-100 lazy">
                           @else
                           <img data-src="{{ asset('img/no-image.png') }}" class="img-fluid item-img w-100 lazy">
                           @endif

                           

                           </a>
                        </div>
                        <div class="p-3 position-relative">
                           <div class="list-card-body">
                              <h6 class="mb-1"><a href="{{ route('product',['id' => $product->id] ) }}" class="text-black">{{$product->name}}</a></h6>
                              <p class="text-gray mb-3">{{$product->description}}</p>

                              
                              <h6 class="mb-1 text-black">{{$product->price}} ر س</h6>
                              
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
		@endif
            @endforeach
            </div>
            @endforeach
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
         </div>
    
   </body>


@endsection