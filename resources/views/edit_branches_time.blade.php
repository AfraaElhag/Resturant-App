  @extends('layouts.app')
     @section('content')
   <body class="fixed-bottom-bar bg-light">
      <div class="osahan-profile">
         <div class="bg-primary border-bottom px-3 pt-3 pb-5 d-flex align-items-center">
            <a class="toggle togglew toggle-2" href="#"><span></span></a>
            <h4 class="font-weight-bold m-0 text-white">الفترة الزمنية للمطاعم</h4>
         </div>
       
         <div class="p-3 osahan-profile">
            <div class="bg-white rounded shadow mt-n5">
              <div class="osahan-cart-item-profile bg-white rounded  p-3 mt-3">
                               <div class="flex-column">
                             <h6 class="font-weight-bold mt-3">عدل الفترة الزمنية  للمطاعم</h6>
                             <h6 class="small">فترة الاغلاق</h6>

                               @if(session()->has('message'))
                  <div class="alert alert-success">
                      {{ session()->get('message') }}
                  </div>
              @endif

               <form method="POST" action="{{route('branchestime')}}" id="edit_time">
               	@csrf
                  

                  <div class="form-group  mt-5">
                  	 <label for="Form" class="small font-weight-bold"  > From</label>
                     <select class="input w-full h-10 form-control"  name="opening_from"  id="Form">
                         <option value="00:00">00:00</option>
                         <option value="01:00">01:00</option>
                         <option value="02:00">02:00</option>
                         <option value="03:00">03:00</option>
                         <option value="04:00">04:00</option>
                         <option value="05:00">05:00</option>
                         <option value="06:00">06:00</option>
                         <option value="07:00">07:00</option>
                         <option value="08:00">08:00</option>
                         <option value="09:00">09:00</option>
                         <option value="10:00">10:00</option>
                         <option value="11:00">11:00</option>
                         <option value="12:00">12:00</option>
                         <option value="13:00">13:00</option>
                         <option value="14:00">14:00</option>
                         <option value="15:00">15:00</option>
                         <option value="16:00">16:00</option>
                         <option value="17:00">17:00</option>
                         <option value="18:00">18:00</option>
                         <option value="19:00">19:00</option>
                         <option value="20:00">20:00</option>
                         <option value="21:00">21:00</option>
                         <option value="22:00">22:00</option>
                         <option value="23:00">23:00</option>
                         </select>
                  </div>
                   <div class="form-group">
                  	 <label for="exampleFormControlInput3" class="small font-weight-bold"> To</label>
                     <select class="input w-full h-10 form-control" name="opening_to"  id="to">
                      
                         <option value="00:00">00:00</option>
                         <option value="01:00">01:00</option>
                         <option value="02:00">02:00</option>
                         <option value="03:00">03:00</option>
                         <option value="04:00">04:00</option>
                         <option value="05:00">05:00</option>
                         <option value="06:00">06:00</option>
                         <option value="07:00">07:00</option>
                         <option value="08:00">08:00</option>
                         <option value="09:00">09:00</option>
                         <option value="10:00">10:00</option>
                         <option value="11:00">11:00</option>
                         <option value="12:00">12:00</option>
                         <option value="13:00">13:00</option>
                         <option value="14:00">14:00</option>
                         <option value="15:00">15:00</option>
                         <option value="16:00">16:00</option>
                         <option value="17:00">17:00</option>
                         <option value="18:00">18:00</option>
                         <option value="19:00">19:00</option>
                         <option value="20:00">20:00</option>
                         <option value="21:00">21:00</option>
                         <option value="22:00">22:00</option>
                         <option value="23:00">23:00</option>
                         </select>
                  </div>
                  
                  <button class="btn btn-primary btn-block" type="SUBMIT">{{__('lang.SUBMIT')}}</button>
               </form>
               
            </div>
         </div>
        </div>
        
  </body>
   @endsection

   </div>
    </div>