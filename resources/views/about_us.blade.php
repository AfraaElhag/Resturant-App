   @extends('layouts.app')
     @section('content')
  
   <body style="background-image: url('{{ asset('img/im22.jpg') }}');  background-size: cover; background-repeat: no-repeat;" >
      <div class="osahan-faq vh-100">
      <div class="bg-primary  px-3 pt-2 pb-5 d-flex align-items-center" >
            <a class="toggle" href="#"><span></span></a>
            <h4 class=" text-white pl-5" style="width: 50%"> عن المطعم </h4>
<a class=" text-white font-weight-bold  " href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 50%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
      </div>



      <!-- checkout -->
      <div class="  p-3 mr-5 " >
         <div class="bg-white rounded shadow  d-flex align-items-center border-bottom p-3   mt-n5 bg-white" >
            <div id="intro" class="mb-0 text-danger" >
               <!-- Title -->
               <div class="mb-5 mt-3 ">
                  <h2 class="h5">نقدم ألذ فطور  ...</h2>
               </div>

                <div class="mb-5">
                  <h2 class="h5">وألذ خبز تنور  ...</h2>
               </div>

               <div class="mb-5">
                  <h2 class="h5">مو خفيف على البطن ...</h2>
               </div>

               <div class="mb-3">
                  <h2 class="h5">بس خفيف على الجيب  ...</h2>
               </div>
               
            </div>
           
           
           
         </div>
      </div>
      
   
   </body>
@endsection