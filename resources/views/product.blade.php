
     @extends('layouts.app')
     @section('content')
     <body class="fixed-bottom-bar">
      <div class="osahan-recepie">
         <!-- recepie-header -->
         <div class="recepie-header">

          <div class=" border-bottom px-3 pt-2 pb-1 d-flex align-items-center" >
            <a class="toggle mb-4" href="#"><span id="toggle_menu"></span></a>
            <h4 class="font-weight-bold m-0 text-white pl-5 " style="width: 50%">  </h4>
            <a class=" text-white font-weight-bold  " href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 50%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 text-danger"   ><i class="feather-chevron-left"> </i></h2></a>
         </div>


            @if($product->image)
            <img src="{{$product->image}}" class="img-fluid w-100" id="img" alt="Responsive image" >
            @else
            <img src="{{ asset('img/no-image.png') }}" class="img-fluid w-100" id="img" alt="Responsive image">

            @endif
         </div>
         <!-- recepie-body -->
         <div class="recepie-body">
            <div class="p-3">
               <div>

                   @if($product->discounts)
                                 @foreach($product->discounts as $discount)
                                    @if($discount->name == 'APP_Discount')
                                     <?php $var='true' ?>
                                    <h5 id="{{$product->id}}"  class="font-weight-bold" >{{$product->name}}</h5>
                                    @if($discount->is_percentage == false)
                                    <p>
                                     <span id="price"  class=" h5">{{$product->price - $discount->amount}}رس</span>
                                     <span class="mb-1 text-black line-through float-right text-muted">
                                       <del>{{$product->price}} </del>ر س</span> 
                                    </p>
                                    @else
                                      <p>
                                     <span id="price" class=" h5">{{$product->price}}رس</span>
                                     <span class="mb-1 text-black line-through float-right text-muted">
                                     خصم  {{ $discount->amount}} %</span> 
                                    </p>
                                    @endif
                                       
                                    @endif
                                 @endforeach

                                   @if(!(isset($var)))
                                    <h5 id="{{$product->id}}"  class="font-weight-bold" >{{$product->name}}</h5>
				<p>
					<span id="price" class=" h5">{{$product->price}}رس</span> </p>
                                    @endif


                              @else
                                  <h5 id="{{$product->id}}"  class="font-weight-bold" >{{$product->name}} </h5>
					<p><span id="price"  class=" h5">{{$product->price}}رس</span> </P>
                              @endif   



              
               </div>
               @if($product->description)
               <h6 class="font-weight-bold mt-4">{{__('lang.DESCRIPTION')}}</h6>
               <p class="text-muted">{{$product->description}}</p>
               @endif

              @if($product->modifiers)
               <h6 class="font-weight-bold mt-4">{{__('lang.EXTRAS')}}</h6> @endif
         <form method="post" action="{{route('addtoCart')}}" id="product" onsubmit="return form_validate()">
                                        @csrf
               @foreach($product->modifiers as $modifier)
                <h6 class="font-weight-bold mt-4">{{$modifier->name}}
                   @if($modifier->pivot->minimum_options > 0)
                   <span class="text-danger">*</span>
                   @endif
                </h6>
                <p class=" small text-danger" id="{{$modifier->id}}"></p>
                @foreach($modifier->options as $option)
               <div class="custom-control custom-radio border-bottom py-2">
                  <input type="hidden" name="modifier[{{$option->id}}][price]" value="{{$option->price}}">
                  <input type="checkbox" id="{{$option->id}}" name="modifier[{{$option->id}}][name]" class="custom-control-input c{{$modifier->id}}"  value="{{$option->name}}" data-modifier-price="{{$option->price}}"  onclick="modifier('{{$option->id}}') " >
                  <label class="custom-control-label" for="{{$option->id}}">{{$option->name}} <span class="text-muted">+{{$option->price}}</span></label>
               </div>
               @endforeach
               @endforeach  
              
            </div>
         </div>
                                   
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="name" value="{{$product->name}}">
                    <input type="hidden" name="price" value="{{$product->price}}">
                    <input type="hidden" name="image" value="{{$product->image}}">
  

           <div class="d-flex align-items-center justify-content-between  border-bottom fixed-bottom">
                  <div class="align-items-center bg-primary col-6">
                  
                       <button class="btn text-white btn-lg btn-block " type="submit">{{__('lang.Add to order')}}</a>
                     
                  </div>
                  <div class="d-flex align-items-center  col-6 ">
                  
                     @if($product->discounts)
                        @foreach($product->discounts as $discount)
                           @if($discount->name == 'APP_Discount')
                           <?php $var='true' ?>
                           @if($discount->is_percentage == false)
                                     <button type="button" class="btn-lg left dec btn " id="dec" onclick="removeitem(this)"  data-total-price="{{$product->price - $discount->amount}}" data-product-price="{{$product->price}}"> 
                        <i class="feather-minus"></i>
                     </button>

                     <input class="count-number-input align-middle " type="text" readonly="" value="1" id="qty" name="qty">
                     <button type="button" class="btn-lg right inc btn " id="inc" onclick="additem(this)" data-total-price="{{$product->price -$discount->amount}}" data-product-price="{{$product->price}}"> 
                        <i class="feather-plus"></i> 
                     </button>

                                        @else
                      <button type="button" class="btn-lg left dec btn " id="dec" onclick="removeitem(this)"  data-total-price="{{$product->price}}" data-product-price="{{$product->price}}"> 
                        <i class="feather-minus"></i>
                     </button>

                     <input class="count-number-input align-middle " type="text" readonly="" value="1" id="qty" name="qty">
                     <button type="button" class="btn-lg right inc btn " id="inc" onclick="additem(this)" data-total-price="{{$product->price}}" data-product-price="{{$product->price}}"> 
                        <i class="feather-plus"></i> 
                     </button>



                                        @endif

                                  <input type="hidden" name="discount_amount" value="{{$discount->amount}}" id="discount_amount">
                                  <input type="hidden" name="discount_id" value="{{$discount->id}}">
                                  <input type="hidden" name="discount_is_percentage" value="{{$discount->is_percentage}}">
                           @endif
                        @endforeach
                        @if(!(isset($var)))
                         <input type="hidden" name="discount_id" value="">
                                   <button type="button" class="btn-lg left dec btn " id="dec" onclick="removeitem(this)"  data-total-price="{{$product->price}}" data-product-price="{{$product->price}}"> 
                        <i class="feather-minus"></i>
                     </button>

                     <input class="count-number-input align-middle " type="text" readonly="" value="1" id="qty" name="qty">
                     <button type="button" class="btn-lg right inc btn " id="inc" onclick="additem(this)" data-total-price="{{$product->price}}" data-product-price="{{$product->price}}"> 
                        <i class="feather-plus"></i> 
                     </button>
                        @endif
                     @else
                     
                               <input type="hidden" name="discount_id" value="">
                                   <button type="button" class="btn-lg left dec btn " id="dec" onclick="removeitem(this)"  data-total-price="{{$product->price}}" data-product-price="{{$product->price}}"> 
                        <i class="feather-minus"></i>
                     </button>

                     <input class="count-number-input align-middle " type="text" readonly="" value="1" id="qty" name="qty">
                     <button type="button" class="btn-lg right inc btn " id="inc" onclick="additem(this)" data-total-price="{{$product->price}}" data-product-price="{{$product->price}}"> 
                        <i class="feather-plus"></i> 
                     </button>
                     @endif 
                  </div>
               </div>
    </form>
      </div>
   </body>
   @endsection

<script>
   
   //var product_price = {!! json_encode($product->price) !!};
   var product_id = {!! json_encode($product->id) !!};
   var modifiers = {!! json_encode($product->modifiers) !!};

   //var discount_amount=document.getElementById("discount_amount").value;
function additem(item) {
    var sum=Number($(item).data('total-price'))+ Number($(item).data('product-price'));
 
     for(var i=0; i < modifiers.length; i++){

         for(var j=0; j < modifiers[i]['options'].length; j++){

             if (document.getElementById(modifiers[i]['options'][j]['id']).checked){
               sum=sum+modifiers[i]['options'][j]['price'];
         }
        
      }
    }
    $(item).data('total-price',sum);
    document.getElementById("price").innerHTML =$(item).data('total-price') + "رس " ;
 
    $(document.getElementById("dec")).data('total-price',sum);
    ++document.getElementById("qty").value;
}

function removeitem(item) {

    if (document.getElementById("qty").value > 1) {
     
      var sum=Number($(item).data('total-price')) - Number($(item).data('product-price'));
       for(var i=0; i < modifiers.length; i++){

       for(var j=0; j < modifiers[i]['options'].length; j++){

             if (document.getElementById(modifiers[i]['options'][j]['id']).checked){
               sum=sum-modifiers[i]['options'][j]['price'];
         }
    }}
      $(item).data('total-price',sum);
      document.getElementById("price").innerHTML =$(item).data('total-price')+ "رس " ;

      $(document.getElementById("inc")).data('total-price',sum);
      --document.getElementById("qty").value;
    } 
}


function modifier(id )
{
  
 
   var modifier_price=$(document.getElementById(id)).data('modifier-price');
   var total_price = $(document.getElementById("inc")).data('total-price');

  if (document.getElementById(id).checked) 
  {
    
      var sum= document.getElementById("qty").value * modifier_price + total_price;

      document.getElementById("price").innerHTML = "رس "+ sum;

      $(document.getElementById("dec")).data('total-price',sum);
      $(document.getElementById("inc")).data('total-price',sum);

  } else {

      var sum=total_price - modifier_price ;
      var sum=total_price - (modifier_price * document.getElementById("qty").value) ;
      document.getElementById("price").innerHTML =sum+ "رس " ;

      $(document.getElementById("dec")).data('total-price',sum);
      $(document.getElementById("inc")).data('total-price',sum);

  }
}

function form_validate(){
var submit=[];
   for(var i=0; i < modifiers.length; i++){
    
         if( $('input:checkbox.c'+modifiers[i]['id']+':checked').length > modifiers[i]['pivot']['maximum_options']){
            document.getElementById(modifiers[i]['id']).style.display = "block";
            document.getElementById(modifiers[i]['id']).innerHTML ="عفوا لا يمكنك اختيار أكثر من  "+ modifiers[i]['pivot']['maximum_options']+"  خيارات";
           submit= false;
         }
        
         else if( $('input:checkbox.c'+modifiers[i]['id']+':checked').length < modifiers[i]['pivot']['minimum_options']){
            document.getElementById(modifiers[i]['id']).style.display = "block";
            document.getElementById(modifiers[i]['id']).innerHTML ="عفوا الرجاء اختيار "+ modifiers[i]['pivot']['minimum_options']+" علي الأقل";
            submit= false;
         }
         else{
            document.getElementById(modifiers[i]['id']).style.display = "none";
            
         }
        
    }
  
  if(submit.length == 0){
  return true;}
  else{
   return false;
  }
  

}

 </script>