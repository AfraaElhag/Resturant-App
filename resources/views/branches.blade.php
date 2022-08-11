



   @extends('layouts.app')
     @section('content')
   <body class="fixed-bottom-bar bg-light">
      <div class="osahan-profile">
        

        <div class="bg-primary  px-3 pt-2 pb-2 d-flex align-items-center" >
            <a class="toggle" href="#"><span></span></a>
            <h4 class=" m-0 text-white pl-5" style="width: 50%">الفروع</h4>
<a class=" text-white font-weight-bold  " href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 50%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
   </div>

         <!-- slider -->
         <div class="mapouter " >
            <div class="gmap_canvas"  id="map" style="height: 250px; "></div>
           
         </div>
        



      
 
        



   @foreach($branches as $branche)
    
             
         <div class="d-flex align-items-center bg-white  rounded border osahan-check overflow-hidden position-relative m-2 p-3 shadow-sm " onclick="changeMarkerPos('{{$branche->latitude}}', '{{$branche->longitude}}');" >
                               
                        
                        <div class=" " >
                           
                             <h5 class=""> {{$branche->name}} </b><span class="small text-success font-weight-bold"> @if($branche->status == 'Open')
                               مفتوح
                             @else
                             مغلق
                             @endif
                              </span> </h5>
                        
                        <p class="mb-1 mt-3 small font-weight-bold"><i class="feather-phone mr-2 mt-1 text-danger" style="float: right;" ></i> {{$branche->phone}}</p>
                        <p class=" mb-3 small font-weight-bold mt-2"><i class="feather-clock mr-2 mt-1 text-danger" style="float: right;"></i><span> {{$branche->opening_from}}  - {{date('H:i', strtotime($app_time->opening_from))}} </span> </br><i class="feather-clock mr-2 mt-1 text-danger" style="float: right;"></i><span>{{date('H:i', strtotime($app_time->opening_to))}} - {{$branche->opening_to}}  </span></p>

                          
                              
                          
                           
                        
                     </div>
                  </div>

            

            
         
   @endforeach
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



<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsga3CJ76gYq5zLuzHJD3kbXqNOLw5lyk&callback=initMap&libraries=&v=weekly"
      defer
    >
       
    </script>
   
           
  <script type="text/javascript">



 var branches = {!! json_encode($branches) !!};


  var lat=Number(branches[0].latitude);
  var lng=Number (branches[0].longitude);
 
      var marker;
      var co_ordinates;
      var map;
      // Initialize and add the map
      function initMap() {
        // The location of map
        co_ordinates = { lat: lat, lng: lng};
        // The map, centered at Uluru
        map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: co_ordinates,
          panControl: false,
          mapTypeControl: false,
          streetViewControl: false,
          fullscreenControl: false,
           disableDefaultUI: true,
	 gestureHandling: "greedy",
        
        });
        // The marker, positioned at Uluru
         marker = new google.maps.Marker({
          position: co_ordinates,
          animation: google.maps.Animation.DROP,
        //icon: 'https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/location-24-32.png',
          map: map,
        });
      }

function changeMarkerPos(lat, lon){
  
  $('#b1').toggleClass("bg-danger");
  var myLatLng = new google.maps.LatLng(lat, lon);
  
    marker.setPosition(myLatLng);
    map.panTo(marker.position);
  
}
</script>







