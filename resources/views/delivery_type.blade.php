@extends('layouts.app')
@section('content')
   <body class="bg-light fixed-bottom-bar">
      <div class="osahan-payment">
         
 @if(Session::get('products'))
         <div class="bg-primary border-bottom px-3 pt-3 pb-5 d-flex align-items-center">
            <a class="toggle" href="#"><span></span></a>
            <h4 class=" m-0 text-white pl-5">طريقة الإستلام </h4>
         </div>
         <!-- checkout -->
         <div class="p-3 osahan-cart-item">
            <div class="osahan-cart-item-profile bg-white rounded shadow p-3 mt-n5">
               <div class="d-flex flex-column">
                @if(session()->has('message'))
                  <div class="alert alert-danger">
                      {{ session()->get('message') }}
                  </div>
                @endif


              @error('pickup_branch_id')
               <p class="alert alert-danger">   الرجاء إختيار الفرع     </p>
              @enderror

               @error('address_id')
               <p class="alert alert-danger">   الرجاء اختيار عنوان التوصيل </p>
              @enderror

               @error('delivery_charge_name')
               <p class="alert alert-danger">   الرجاء إختيار نوع التوصيل     </p>
              @enderror

              @if($is_branches_open==null)     
                <p class="align-items-center alert alert-danger mt-5">عذرا جميع فروعنا مغلقة حاليا !</p>
              @else
              
              <form action="{{route('place_order')}}" method="post" id="delivery_type">
              @csrf
                          <input type="hidden" name="notes" value="{{$notes}}">

                  @if($type == 2)
                     @foreach($branches as $branche)
                   <div class="custom-control custom-radio mb-2 px-0">
                     @if($branche->status == "Closed")
                     <input type="radio" id="{{$branche->id}}" name="branch_id" value="{{$branche->id}}" class="custom-control-input" disabled>
                     @else

                    
                     <input type="radio" id="{{$branche->id}}" name="pickup_branch_id" value="{{$branche->id}}" class="custom-control-input branch" >
                     @endif
                     <label class="custom-control-label border osahan-check p-3 w-100 rounded border-danger" for="{{$branche->id}}">

                        <h5 class=""> {{$branche->name}} </b><span class="small text-success font-weight-bold"> @if($branche->status == 'Open')
                               مفتوح
                             @else
                             مغلق
                             @endif
                              </span> </h5>
                        <p class="mb-1 mt-3 small font-weight-bold"><i class="feather-phone mr-2 mt-1 text-danger" style="float: right;" ></i> {{$branche->phone}} </p>
                        <p class=" mb-3 small font-weight-bold mt-2"><i class="feather-clock mr-2 mt-1 text-danger" style="float: right;"></i><span> {{$branche->opening_from}}  - {{date('H:i', strtotime($app_time->opening_from))}}  </span> </br><i class="feather-clock mr-2 mt-1 text-danger" style="float: right;"></i><span>{{date('H:i', strtotime($app_time->opening_to))}} - {{$branche->opening_to}} </span></p>
                     

                     </label>
                  </div>
                  @endforeach
                
                    <div class="shadow bg-white rounded p-3 clearfix">

             
               <h6 class="font-weight-bold mb-0">الإجمالي   <span class="float-right">{{Session::get('order_price')}} ر س</span></h6>
            </div>
            <input type="hidden" name="type" value="{{$type}}">
          <div class="fixed-bottom"><button class="btn btn-success btn-lg btn-block" type="submit" > إرسال الطلب </button> </div>

         </form>
                  @endif


                  @if($type == 3)
                   
                  <input type="hidden" name="delivery_branch_id" value="" id="delivery_branch_id">
                  <h6 class="mb-2 font-weight-bold">عنوان التوصيل</h6>

              
                 @foreach($addresses as $address)
                  <div class="custom-control custom-radio mb-2 px-0">
                     <input type="radio" id="{{$address->id}}" name="address_id" value="{{$address->id}}" class="custom-control-input address"  data-lng="{{$address->longitude}}" data-lat="{{$address->latitude}}" >
                     <label class="custom-control-label border osahan-check p-3 w-100 rounded border-danger" for="{{$address->id}}">
                        <b><i class="feather-home mr-2"></i>{{$address->name}}</b> <br>
                        <p class="small mb-0 pl-4">{{$address->description}}</p>
                     </label>
                  </div>

                  @endforeach
                  
                  <input type="hidden" name="lat" id="lat">
                  <input type="hidden" name="lng" id="lng">
                  <a class="btn btn-primary" href="{{route('add_new_address',['previous_url'=>'delivery_type','type'=>$type])}}"  > أضف عنوان جديد </a>
                        
               </div>
            </div>
 
            <div class="mb-3 shadow bg-white rounded p-3 py-3 mt-3 clearfix"  id="delivery_div">
               <h5 class="h6">اختر طريقة التوصيل</h5>
                
                <div class="custom-control custom-radio  py-2" id="free_msg"  style="display: none;">
                  <input type="radio"  name="delivery_charge_name" id="free_charge" class="custom-control-input charge" value="{{$Free_Delivery_Charge->name_localized}}"  >

                 <input type="hidden" name="delivery_free_charge_id"      value="{{$Free_Delivery_Charge->id}}">
                 <input type="hidden" name="delivery_free_charge_amount"  value="{{$Free_Delivery_Charge->value}}">
                 
                  <label class="custom-control-label text-success" for="free_charge" >   جيران الجرة (نضبط جيراننا)     </label>
                  
                  <span class="float-right text-success" >{{$Free_Delivery_Charge->value}} ر س</span>

               </div>


                <div class="custom-control custom-radio  py-2" id="normal_msg">

                  <input type="radio"  name="delivery_charge_name" id="normal_charge" class="custom-control-input charge"    value="{{$Normal_Delivery_Charge->name_localized}}"  oninvalid="this.setCustomValidity('الرجاء اختيار  نوع التوصيل')" onclick="this.setCustomValidity('')" required>

                 <input type="hidden" name="delivery_normal_charge_id"      value="{{$Normal_Delivery_Charge->id}}">
                 <input type="hidden" name="delivery_normal_charge_amount"  value="{{$Normal_Delivery_Charge->value}}">

                  <label class="custom-control-label" for="normal_charge" > الجره أقرب </label>
                 
                  <span class="float-right text-success" >{{$Normal_Delivery_Charge->value}}ر س</span>

               </div>





               <div class="custom-control custom-radio  py-2" id="speed_msg">
                  <input type="radio" name="delivery_charge_name" id="speed_charge" class="custom-control-input charge"   value="{{$Speed_Delivery_Charge->name_localized}}" >
                  
                  <input type="hidden" name="delivery_speed_charge_id"      value="{{$Speed_Delivery_Charge->id}}">
                 <input type="hidden" name="delivery_speed_charge_amount"  value="{{$Speed_Delivery_Charge->value}}">

                  <label class="custom-control-label" for="speed_charge" > طياره (اذا مرره جوعان) </label>
                  <span class="float-right text-success" >{{$Speed_Delivery_Charge->value}} ر س</span>
               </div>


               <div class="custom-control custom-radio  py-2" id="remote_msg"  style="display: none;">
                  <input type="radio"  name="delivery_charge_name" id="remote_charge" class="custom-control-input charge" value="{{$Remote_Delivery_Charge->name_localized}}"  >

                 <input type="hidden" name="delivery_remote_charge_id"      value="{{$Remote_Delivery_Charge->id}}">
                 <input type="hidden" name="delivery_remote_charge_amount"  value="{{$Remote_Delivery_Charge->value}}">
                 
                  <label class="custom-control-label text-success" for="remote_charge" >   التوصيل البعيد  </label>
                  
                  <span class="float-right text-success" >{{$Remote_Delivery_Charge->value}} ر س</span>

               </div>


                
             
            </div>

            <div class="shadow bg-white rounded p-3 clearfix" id="price_div">
               <p class="mb-1 text-success">رسوم التوصيل<span class="float-right text-success" id="fee">--</span></p>
               <hr>
               <p class="mb-1 text-dark">الإجمالي <span class="float-right  text-success" id="final_price">{{Session::get('order_price')}} ر س</span></p>
              
              
            </div>

           

<input type="hidden" name="type" value="{{$type}}">
          <div class="fixed-bottom"><button class="btn btn-success btn-lg btn-block" type="submit" > إرسال الطلب </button> </div>

         </form>
         @endif
         @endif
         </div>
         
      </div>
    </div>
    @else
    <script>window.location.href = "https://aljarrah.menugizer.com/";</script>

    @endif
  </div>
     
   </body>
@endsection


<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsga3CJ76gYq5zLuzHJD3kbXqNOLw5lyk&libraries=geometry&v=weekly"
      defer
    >
       
    </script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function () {

 $("input:radio.branch:first").attr('required', true);
 $("input:radio.branch:first").on('invalid', function() {
    this.setCustomValidity('الرجاء تحديد الفرع');   
});

$("input:radio.branch").on('click', function() {
   $("input:radio.branch:first").get(0).setCustomValidity('');
    
});
  
   var branches = {!! json_encode($branches) !!};
   var free_fee = {!! json_encode($Free_Delivery_Charge) !!};
   var normal_fee = {!! json_encode($Normal_Delivery_Charge) !!};
   var speed_fee = {!! json_encode($Speed_Delivery_Charge) !!};
   var remote_fee = {!! json_encode($Remote_Delivery_Charge) !!};
   var order_price = {!! json_encode(Session::get('order_price')) !!};
  
   var distance=[];
   

  $("input:radio.address:first").attr('required', true);
  $("input:radio.address:first").on('invalid', function() {
    this.setCustomValidity('الرجاء تحديد العنوان');   
  });
  $("input:radio.address").click(function(){
       $("input:radio.address:first").get(0).setCustomValidity('');
    

      var distance=[];
      document.getElementById("lat").value =$(this).data('lat');
      document.getElementById("lng").value =$(this).data('lng');

          
       var user_address = new google.maps.LatLng($(this).data('lat'), $(this).data('lng'));

     for(var i=0;i <branches.length;i++){
         if(branches[i].status == 'Open'){
            var branch_address = new google.maps.LatLng(branches[i].latitude, branches[i].longitude);

             distance.push([google.maps.geometry.spherical.computeDistanceBetween(user_address, branch_address)/1000,branches[i].id]);
         }
    
      }

      if(distance){
      var branch_id=distance[0][1];
         var low = distance[0][0];
         for (var i = 1; i < distance.length; i++) {
           if (distance[i][0] < low) {
             low = distance[i][0];
             branch_id = distance[i][1];
           }
         }
         document.getElementById("delivery_branch_id").value = branch_id;

console.log(low);


      if(low <= 1 ){
        
              document.getElementById("free_msg").style.display = "block";
              document.getElementById("normal_msg").style.display = "block";
              document.getElementById("speed_msg").style.display = "block";
              document.getElementById("remote_msg").style.display = "none";
               if(document.getElementById("remote_charge").checked ){
          document.getElementById("fee").innerHTML = '--';
          document.getElementById("final_price").innerHTML =order_price;
        }

              document.getElementById("remote_charge").checked=false; 
      }

      else if(low > 7 ){
         document.getElementById("free_msg").style.display = "none"; 
         document.getElementById("normal_msg").style.display = "none"; 
         document.getElementById("speed_msg").style.display = "none"; 
         document.getElementById("remote_msg").style.display = "block"; 
          if((document.getElementById("free_charge").checked ) || ( document.getElementById("normal_charge").checked) || ( document.getElementById("speed_charge").checked)){
          document.getElementById("fee").innerHTML = '--';
          document.getElementById("final_price").innerHTML =order_price;
        }
         document.getElementById("free_charge").checked=false;
         document.getElementById("normal_charge").checked=false;
         document.getElementById("speed_charge").checked=false;
         

      }
      else{
        document.getElementById("normal_msg").style.display = "block";
        document.getElementById("speed_msg").style.display = "block";
        document.getElementById("free_msg").style.display = "none";
        document.getElementById("remote_msg").style.display = "none";
        if((document.getElementById("free_charge").checked ) || ( document.getElementById("remote_charge").checked)){
          document.getElementById("fee").innerHTML = '--';
          document.getElementById("final_price").innerHTML =order_price;
        }
        document.getElementById("free_charge").checked=false; 
        document.getElementById("remote_charge").checked=false; 
        

      }
  
}

   });



  
    

$("input:radio.charge").click(function(){
document.getElementById("normal_charge").setCustomValidity('');

   if (document.getElementById("normal_charge").checked) {
        
          document.getElementById("fee").innerHTML = normal_fee.value + "ر  س " ;
          fee=normal_fee.value;
         }

         if (document.getElementById("speed_charge").checked) {
          document.getElementById("fee").innerHTML =speed_fee.value + " ر س " ;
          fee=speed_fee.value;
         }

         if (document.getElementById("free_charge").checked) {
            document.getElementById("fee").innerHTML =free_fee.value + " ر س  " ;
            fee=free_fee.value;
         }

          if (document.getElementById("remote_charge").checked) {
            document.getElementById("fee").innerHTML =remote_fee.value+ " ر س  " ;
            fee=remote_fee.value;
         }


            var total=order_price+ fee;

            total=total.toFixed(2);

            document.getElementById("final_price").innerHTML =total + " ر س  " ;
});
});


</script>