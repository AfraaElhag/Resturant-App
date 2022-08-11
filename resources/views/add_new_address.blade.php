   @extends('layouts.app')
     @section('content')
   <body class="fixed-bottom-bar bg-light">
      <div class="osahan-profile">
         
           


<div class="bg-primary  px-3 pt-2 pb-5 d-flex align-items-center" >
            <a class="toggle" href="#"><span></span></a>
            <h4 class="m-0 text-white pl-5" style="width: 60%"> عناوين التوصيل</h4>
            <a href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 40%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
         </div>
         <!-- profile -->
         <div class="p-3 osahan-profile">
            <div class="bg-white rounded shadow mt-n5">               
              <div class="osahan-cart-item-profile bg-white rounded  p-3 ">
                  <div class="flex-column">
                    <h5 class="font-weight-bold mb-3">أضف عنوان جديد</h5>
                    <form action="{{route('addaddress')}}" method="post" id="add">
                      @csrf
                       <div class="mapouter " >
            <div class="gmap_canvas"  id="map" style="height: 250px; position: fixed; "></div>
           
         </div>
        
                      <div class="form-row">              
                        <div class="col-md-12 form-group mt-3"><label class="form-label">الإسم*</label><input  type="text" class="form-control" name="address_name" value="{{ old('address_name') }}" oninvalid="this.setCustomValidity('الرجاء إدخال هذا الحقل')" onchange="this.setCustomValidity('')" required></div>
                        @error('address_name')
               <p class="alert alert-danger mt-1">   الرجاء إدخال الإسم   </p>
              @enderror

                        <div class="col-md-12 form-group"><label class="form-label">الوصف*</label><input placeholder="العنوان الكامل ,رقم الشارع , رقم المنزل, علامة بارزة" type="text" class="form-control" name="address_description"  value="{{ old('address_description') }}" oninvalid="this.setCustomValidity('الرجاء إدخال هذا الحقل')" onchange="this.setCustomValidity('')" required ></div>
                         @error('address_description')
               <p class="alert alert-danger mt-1">   الرجاء إدخال وصف للعنوان </p>
              @enderror
                      </div>
                      
                      <input type="hidden" name="previous_url"  value="{{ request()->previous_url }}">
                      <input type="hidden" name="type"  value="{{ request()->type }}">
                      <input type="hidden" name="lat" id="lat" >
                      <input type="hidden" name="lng" id="lng">
                      <button class="btn btn-primary btn-block" type="SUBMIT">{{__('lang.SUBMIT')}}</button>
                           
 

              

               @error('lat')
               <p class="alert alert-danger mt-1">   الرجاء تحديد موقع علي الخريطة   </p>
              @enderror
             


                    </form>   
                  </div>
              </div>
            </div>       
          </div>
      </div>
     
   </body>
@endsection



<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsga3CJ76gYq5zLuzHJD3kbXqNOLw5lyk&callback=initMap&libraries=&v=weekly"
      defer>
       
    </script>
   
           
  <script type="text/javascript">

      var marker;
      var co_ordinates;
      var map;
      var lat;
      var lng;
      // Initialize and add the map
      function initMap() {

         if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {

    alert("Geolocation is not supported by this browser.");
  }

  function showPosition(position) {
 
co_ordinates = { lat: position.coords.latitude, lng: position.coords.longitude};
  document.getElementById("lat").value = position.coords.latitude;
  document.getElementById("lng").value = position.coords.longitude;
   map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: co_ordinates,
          panControl: false,
          mapTypeControl: false,
          streetViewControl: false,
          fullscreenControl: false,
           disableDefaultUI: true,
        
        });

       
         // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
   
  
       marker.setPosition( mapsMouseEvent.latLng);
       map.panTo(marker.position);
     
      document.getElementById("lat").value = mapsMouseEvent.latLng.lat();
      document.getElementById("lng").value = mapsMouseEvent.latLng.lng();

   
    
  });
       
         marker = new google.maps.Marker({
          position: co_ordinates,
          animation: google.maps.Animation.DROP,
          map: map,
         
        });
      }

}
</script>