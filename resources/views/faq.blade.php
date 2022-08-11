@extends('layouts.app')
     @section('content')
      


 <body style="background-image: url('{{ asset('img/im22.jpg') }}');  background-size: cover; background-repeat: no-repeat;" >
      <div class="osahan-faq vh-100">
    
    <div class="bg-primary  px-3 pt-2 pb-5 d-flex align-items-center" >
            <a class="toggle" href="#"><span></span></a>
            <h4 class="m-0 text-white pl-5" style="width: 60%"> {{__('lang.FAQ')}} </h4>
<a class=" text-white font-weight-bold  " href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 40%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
     
         </div>
            <div id="basics" class="p-3" >
                 <div class="bg-white rounded shadow mt-n5 d-flex align-items-center border-bottom p-3 pb-5">
              
               <div id="basicsAccordion">
                
                 <div class="box shadow-sm text-justify">
                     <div id="accountHeadingOne">
                        <h5 class="mb-0">
                           <button class="shadow-none btn btn-block d-flex justify-content-between card-btn p-3" data-toggle="collapse" data-target="#accountCollapseOne" aria-expanded="false" aria-controls="accountCollapseOne">
                           {{__('lang.Question1')}}
                           <span class="card-btn-arrow">
                           <span class="feather-chevron-down"></span>
                           </span>
                           </button>
                        </h5>
                     </div>
                     <div id="accountCollapseOne" class="collapse show" aria-labelledby="accountHeadingOne" data-parent="#basicsAccordion">
                        <div class="card-body border-top p-3 text-muted">
                           <p>{{__('lang.Answer1')}}<br>{{__('lang.Answer2')}} </p>
                          <p>{{__('lang.Answer3')}}<br>{{__('lang.Answer4')}} </p> 
                        </div>
                     </div>
                  </div>
                  <div class="box shadow-sm rounded bg-white mb-2 text-justify">
                     <div id="basicsHeadingTwo">
                        <h5 class="mb-0">
                           <button class="shadow-none btn btn-block d-flex justify-content-between card-btn p-3 collapsed" data-toggle="collapse" data-target="#basicsCollapseTwo" aria-expanded="false" aria-controls="basicsCollapseTwo">
                           {{__('lang.Question2')}}
                           <span class="card-btn-arrow">
                           <span class="feather-chevron-down"></span>
                           </span>
                           </button>
                        </h5>
                     </div>
                     <div id="basicsCollapseTwo" class="collapse" aria-labelledby="basicsHeadingTwo" data-parent="#basicsAccordion" style="">
                        <div class="card-body border-top p-3 text-muted">
                         <p>{{__('lang.Answer5')}}<br>{{__('lang.Answer6')}} </p>
                          <p>{{__('lang.Answer7')}}<br>{{__('lang.Answer8')}} </p> 
                        </div>
                     </div>
                  </div>
                  <div class="box shadow-sm rounded bg-white mb-2 text-justify">
                     <div id="basicsHeadingThree">
                        <h5 class="mb-0">
                           <button class="shadow-none btn btn-block d-flex justify-content-between card-btn p-3 collapsed" data-toggle="collapse" data-target="#basicsCollapseThree" aria-expanded="false" aria-controls="basicsCollapseThree">
                           {{__('lang.Question3')}}
                           <span class="card-btn-arrow">
                           <span class="feather-chevron-down"></span>
                           </span>
                           </button>
                        </h5>
                     </div>
                     <div id="basicsCollapseThree" class="collapse" aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion" style="">
                        <div class="card-body border-top p-3 text-muted">
                         <p>{{__('lang.Answer9')}}<br>{{__('lang.Answer10')}} </p>
                          <p>{{__('lang.Answer11')}}<br>{{__('lang.Answer12')}} </p> 
                          <p>{{__('lang.Answer13')}}<br>{{__('lang.Answer14')}} </p>
                          <p>{{__('lang.Answer15')}}<br>{{__('lang.Answer16')}} </p> 
                          <p>{{__('lang.Answer17')}} </p> 
                        </div>
                     </div>
                  </div>
                  <div class="box shadow-sm rounded bg-white mb-2 text-justify">
                     <div id="basicsHeadingFour">
                        <h5 class="mb-0">
                           <button class="shadow-none btn btn-block d-flex justify-content-between card-btn collapsed p-3" data-toggle="collapse" data-target="#basicsCollapseFour" aria-expanded="false" aria-controls="basicsCollapseFour">
                          {{__('lang.Question4')}}
                           <span class="card-btn-arrow">
                           <span class="feather-chevron-down"></span>
                           </span>
                           </button>
                        </h5>
                     </div>
                     <div id="basicsCollapseFour" class="collapse" aria-labelledby="basicsHeadingFour" data-parent="#basicsAccordion">
                        <div class="card-body border-top p-3 text-muted">
                           {{__('lang.Answer18')}}
                        </div>
                     </div>
                  </div>
                  <!-- End Card -->
               </div>
               <!-- End Basics Accordion -->
            </div>
           
         </div>
      </div>
     
     
      
   </body>
 @endsection