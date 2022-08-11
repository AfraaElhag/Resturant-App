@extends('layouts.app')
@section('content')
   <body class="bg-light fixed-bottom-bar">
      <div class="osahan-payment">
       <div class="bg-primary  px-3 pt-2 pb-5 d-flex align-items-center" >
            <a class="toggle" href="#"><span></span></a>
            <h4 class=" m-0 text-white pl-5" style="width: 60%">العناوين</h4>
 <a href="javascript:javascript:history.go(-1)" style="position: relative; direction: ltr; display: inline-flex; width: 40%"> <h2 class="font-weight-bold  text-white ml-0 mt-1 "   ><i class="feather-chevron-left"> </i></h2></a>
        
         </div>

         <!-- checkout -->
         <div class="p-3 osahan-cart-item">
            <div class="osahan-cart-item-profile bg-white rounded shadow p-3 mt-n5">
               <div class="d-flex flex-column">
                  <h6 class="mb-2 font-weight-bold">عنوان التوصيل</h6>
                  @foreach($addresses as $address)
                  <div class=" mb-2 px-0 border osahan-check p-3 w-100 rounded border-danger">
                   
                        <b><i class="feather-home mr-2 "></i>{{$address->name}} <span ><a href="{{route('deleteaddress',['id' =>$address->id])}}"><i class="feather-trash float-right text-danger"></i></a></span></b> <br>
                        <p class="small mb-0 pl-4">{{$address->description}} </p>

                     
                  </div>
                  @endforeach
                 
               <a class="btn btn-primary" href="{{route('add_new_address',['previous_url'=>'address'])}}"  > أضف عنوان جديد </a>  
               </div>
            </div>
         </div>
       
         
       
      </div>
     
   </body>
@endsection