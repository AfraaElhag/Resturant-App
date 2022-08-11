<link rel="stylesheet" type="text/css" 
      href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
@extends('layouts.app')
     @section('content')
 <body style="background-image: url('{{ asset('img/im22.jpg') }}');  background-size: cover; background-repeat: no-repeat;" >
      <div class="osahan-contact vh-100">
     

      <div class="bg-primary  px-3 pt-2 pb-5 d-flex align-items-center" >
            <a class="toggle" href="#"><span></span></a>
            <h4 class=" m-0 text-white pl-5" style="width: 60%">{{__('lang.Contact Us')}} </h4>
<a class=" text-white font-weight-bold  " href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 40%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
   
         </div>
      <!-- checkout -->
         <div class=" mb-4 p-3  osahan-faq-item">
         <div class="osahan-privacy bg-white rounded shadow p-4 mt-n5 pb-5">
            <div id="intro" class="mb-4 " >
               <!-- Title -->
               <div class="mb-5 mt-5 ">
                <h2 class="h6">للإستفسارات عن طريق الواتساب :</h2>
                 <p class="text-black mb-3 "><i class="feather-phone float-left mr-2 mt-1 font-weight-bold"></i>966508555741+</p>
               </div>

                <div class="mb-5">
                   <h2 class="h6">للملاحظات والشكاوي على الايميل </h2>
                   <p class="text-black mb-3"><i class="feather-mail  float-left mr-2 mt-1 font-weight-bold"></i> aljaarh.alhejazyah@gmail.com
</p>
               </div>

                <div class=" p-4 d-flex  justify-content-center " >
                   <span class="font-weight-bold h4 m-2 ro"><a href="https://www.snapchat.com/add/aljarah-tabuk" class="fa fa-snapchat-ghost p-3 rounded" style="background: #fffc00;color: white;"></a></span>
                  
                   <span class=" font-weight-bold h4 m-2"><a href="https://twitter.com/aljarahtabuk?s=21" class="fa fa-twitter p-3 rounded" style=" background: #55ACEE;color: white;"></a></span>
                    <span class=" mb-3 font-weight-bold h4 m-2"><a href="https://instagram.com/aljarah_alhejazya_rest?igshid=c1oie0pkwk8q" class="fa fa-instagram p-3 rounded" style=" background: #F77737;;color: white;"></a></span>
                   <span class=" font-weight-bold h4 m-2"><a href="https://vm.tiktok.com/ZSwtfmtr/" class="fa p-3 rounded" style=" background: #EE1D52;color: white;"><img src="{{ asset('img/tik-tok.png') }}"></a></span>

                 
               </div>
            </div>
         </div>
      </div>

              
              
             
           
       
     
     
   
   </body>
 @endsection
 <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>