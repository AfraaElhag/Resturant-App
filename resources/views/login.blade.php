@extends('layouts.app')
     @section('content')
   <body style="background-image:url('img/bg.jpg'); background-size: cover;   background-repeat: no-repeat;
">
      <div class="login-page vh-100">
       

        <div class=" px-3 pt-2 pb-1 d-flex align-items-center" >
            <h5 class=" m-0 text-white pl-2 " style="width: 50%">تسجيل الدخول </h5>
            <a class=" text-white font-weight-bold  " href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 50%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
         </div>



         <div class="p-4">
           


            <form class="mt-5 mb-4" action="{{ route('generateOtp') }}"   method="POST" id="login">
               @csrf

                <div class="form-group row">
                     <label for="name" class="text-white col-12" >الإسم</label>
                     

                     <input type="text" placeholder="أدخل الإسم" class="form-control col-12 bold" id="name"  style="color: red; font-weight: bold;" name="name"  value="{{ old('name') }}" oninvalid="this.setCustomValidity('الرجاء إدخال هذا الحقل')" onchange="this.setCustomValidity('')" required>
                    
                  </div>
                @error('name')
                     <p class="alert alert-danger">عذرا يوجد خطأ  بالإسم  أو الحقل فارغ</p>
                  @enderror

              <div class="form-group row">
                     <label for="exampleInputNumber1" class="text-white col-12">{{__('lang.Mobile Number')}}</label>
                     
                     <input type="tel" placeholder="{{__('lang.Enter Mobile')}}" class="form-control col-8 bold"  name="phone" style="color: red; " id="exampleInputNumber1" value="{{ old('phone') }}" oninvalid="this.setCustomValidity('الرجاء إدخال هذا الحقل')" onchange="this.setCustomValidity('')" required>
                     <input class="form-control col-4 text-left bold" type="text" name="" value="966+">
                  </div>
                  @error('phone')
                     <p class="alert alert-danger"> عذرا يوجد خطأ بالرقم أو الحقل فارغ</p>
                  @enderror
              
               <button class="btn btn-primary btn-lg btn-block">{{__('lang.SIGN IN')}}</button>
               
            </form>
           
         </div>

          @if(session()->has('message'))
    <div class="alert alert-danger mt-2">
        {{ session()->get('message') }}
    </div>
@endif
         <div class="fixed-bottom d-flex align-items-center justify-content-center  " id="foot">
            <a href="{{ route('signupform')}}">
               <p class="text-center text-white m-0">{{__("lang.Don't have an account? Sign up")}}</p>
            </a>
         </div>
      </div>
   
      
   </body>
 @endsection
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script type="text/javascript">
        document.write( '<style>#foot{visibility:hidden}@media(min-height:' + ($( window ).height() - 10) + 'px){#foot{visibility:visible}}</style>' );
    </script>

