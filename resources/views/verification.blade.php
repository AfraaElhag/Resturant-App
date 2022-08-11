@extends('layouts.app')
     @section('content')
   <body>
      <div class="osahan-verification">
         <div class="p-3 border-bottom">
         </div>
         <div class="verify_number p-4">
            <h2 class="mb-3">تحقق من رقم جوالك</h2>
            <h6 class="text-black-50">أدخل رمز التحقق هنا </h6>
            <form action="{{ route('validateOtp')}}" method="POST" id="inputform">
               @csrf
               <div class="row my-5 mx-0">
                  <div class="col pr-1 pl-0">
                  <input type="text" maxlength="6"  inputmode="numeric" class="form-control form-control-sm" name="token"  oninvalid="this.setCustomValidity('الرجاء إدخال هذا الحقل')" onchange="this.setCustomValidity('')" autofocus  required>
                  </div>
                 
               </div>

               @if ($errors->any())
    <div class="alert alert-danger">
        
            
               <p class="">   عفوا  يوجد خطأ !</p>
            
        
    </div>
@endif
               <button class="btn btn-lg btn-primary btn-block">إدخال</button>
            </form>

             
         </div>
      </div>
      
      
   </body>
 @endsection
