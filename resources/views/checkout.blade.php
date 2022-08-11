@extends('layouts.app')
 @section('content')
   <body class="bg-light fixed-bottom-bar" >
      <div class="osahan-checkout">
         <div class="bg-primary border-bottom px-3 pt-3 pb-5 d-flex align-items-center">
            <a class="toggle" href="#"><span></span></a>
            <h4 class="m-0 text-white pl-5">السلة</h4>
         </div>
         <!-- checkout -->
         <div class="p-3 osahan-cart-item">
            <div class="d-flex mb-3 osahan-cart-item-profile bg-white shadow rounded p-3 mt-n5">
               <div class="d-flex flex-column">
                  <h6 class="mb-1 font-weight-bold">محتويات السلة</h6>
               </div>
            </div>
 @if(Session::get('products'))
            <div class="bg-white mb-3">
              
               @foreach(Session::get('products') as $product)

                  <div class="row">
                     <div class="col-12 pt-2 ">
                        <div class="d-flex  list-card bg-white rounded overflow-hidden position-relative shadow-sm">
                           <div class="list-card-image">
                              @if($product['image'])
            <img src="{{$product['image']}}" class="img-fluid item-img w-100">
            @else
            <img src="{{ asset('img/no-image.png') }}" class="img-fluid w-100" id="img" alt="Responsive image">

            @endif
                             
                           </div>

                          
                        <form action="{{route('getcartproduct')}}" method="post">
                        @csrf

                         
                        <button class="btn float-right pr-0" type="submit"><i class="feather-edit "></i></button> 
                              
                        <div class="p-3 position-relative ">
                          
                           <div class="list-card-body  ">
                              
                              <h6 class="mb-1" style="max-width: 130px; min-width: 130px;" >x{{$product['qty']}} {{$product['name']}}</h6>
                              <input type="hidden" name="id" value="{{$product['id']}}">
                              <input type="hidden" name="qty" value="{{$product['qty']}}">
                              <input type="hidden" name="product_discount" value="{{$product['product_discount']}}">
                              <input type="hidden" name="is_percentage" value="{{$product['is_percentage']}}">

                              @foreach($product['modifier'] as $modifier)
                              <p class="text-gray m-0">+{{$modifier[1]}}</p>
                              <input type="hidden" name="modifier_id[]" value="{{$modifier[0]}}">
                              @endforeach
                              
                                <h6 class="mb-1 mt-4 text-black  text-left font-weight-bold">{{$product['total_price']}} ر س</h6>
                              <input type="hidden" name="product_total_price" value="{{$product['total_price']}}">
                           </div>
                          
                       </div>
                       
                         </form>
                         

                          <form action="{{route('deletecartproduct')}}" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{$product['id']}}">
                              <input type="hidden" name="qty" value="{{$product['qty']}}">

                              @foreach($product['modifier'] as $modifier)
                              <input type="hidden" name="modifier[{{$modifier[0]}}][price]" value="{{$modifier[2]}}">
                              <input type="hidden" name="modifier[{{$modifier[0]}}][name]" value="{{$modifier[1]}}">
                              
                              @endforeach
                              <input type="hidden" name="product_total_price" value="{{$product['total_price']}}">
                              <input type="hidden" name="product_discount" value="{{$product['product_discount']}}">

                              <button class="btn  " type="submit"><i class="feather-trash"></i></button> 
                         </form> 
                     </div>
                  </div>
               </div>

                @endforeach
           
            </div>
    
          <form action="{{route('delivery_type')}}" method="get" id="checkout">

             <div class="mb-0 input-group">
                  <div class="input-group-prepend"><span class="input-group-text"><i class="feather-message-square"></i></span></div>
                  <textarea placeholder="ملاحظات" aria-label="With textarea" class="form-control" name="notes"></textarea>
               </div>
             
                      <div class="mb-3 shadow bg-white rounded p-3 py-3 mt-3 clearfix">
           <div class="mb-3">
                            <h5 class="h6">اختر طريقة الاستلام</h5>
                         </div>
                          <div class="custom-control custom-radio  py-2">
                            <input type="radio" id="pick" name="type" class="custom-control-input"  value="2" oninvalid="this.setCustomValidity('الرجاء اختيار طريقة الإستلام')" onclick="this.setCustomValidity('')"  required>
                            <label class="custom-control-label" for="pick">إستلام من الفرع </label>
                         </div>

                         <div class="custom-control custom-radio  py-2">
                            <input type="radio" id="del" name="type" class="custom-control-input"  value="3"  onclick="clearValidity()">
                            <label class="custom-control-label" for="del">توصيل </label>
                         </div>
                        
                         @error('type')
                         <p class="alert alert-danger">   الرجاء اختيار طريقة الإستلام  </p>
                        @enderror
                           
                      </div>



                       
           <div class="shadow bg-white rounded p-3 clearfix">

                         <p class="mb-1">المجموع الكلي <span class="float-right text-dark"> {{Session::get('order_price') + Session::get('total_discount')}} ر س</span></p>
                         <p class="mb-1 text-success">الخصم  <span class="float-right text-success">{{Session::get('total_discount')}} ر س</span></p>
                         <hr>


                          <p class="mb-1"> الإجمالي  <span class="float-right text-dark">{{Session::get('order_price')}}  ر س</span></p>
                         <p class="mb-1 text-success">الضريبة (15%)<span class="float-right text-success">{{Session::get('tax')}} ر س</span></p>
                         <hr>


                         <h6 class="font-weight-bold mb-0">العدد الكلي    <span class="float-right">{{Session::get('total_qty')}}</span></h6>
                      </div>
                      <button class="btn btn-success btn-block btn-lg fixed-bottom" type="submit">متابعة<i class="icofont-long-arrow-right"></i></a>
                   </div>
                </div>
            </form> 
            @else 


            <div class="osahan-slider-item text-center">

                         <div class="d-flex align-items-center justify-content-center mt-5 flex-column">
                            <img src="{{ asset('img/cart4.png') }}"  height="150px" width="120px" class="img-fluid mx-auto  mt-5" alt="Responsive image">
                           
                            <p class="mt-3">سلتك فاضية</p>
                         </div>
                      </div>
                      @endif
               
             </body>
          @endsection



<script>
function clearValidity()
{
document.getElementById('pick').setCustomValidity('');
}

</script>