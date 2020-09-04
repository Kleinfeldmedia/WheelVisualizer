@extends('layouts.app') @section('shop_by_vehicle_css')
<link rel="stylesheet" href="{{asset('choosen/css/chosen.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/wheels.css') }}">
@endsection 
@section('metakeywords')
<?=@MetaViewer('Wheels');?>
@endsection 
@section('content')
<style>
   .modal_canvas{
   min-height: 427px !important;
   }
   .col-sm-12.wheel-des p
   {
   font-family: poppins !important;
   font-size: 12px !important;
   line-height: 30px !important;
   color: #000 !important;
   margin: 0px 0px !important;
   text-align:justify;
   }
   .col-sm-12.wheel-des b a
   {
   font-size: 12px !important;
   font-family: Montserrat !important;
   color: #0e1661 !important;
   }
   .wheel-des
   {
   padding: 20px 20px !important;
   }
   .modal-header {
   background: #0e1661 !important;
   color: #fff !important;
   }
   .btn.btn-info
   {
   background: #ecb23d !important;
   font-family:Montserrat !important;
   font-size:12px !important;
   }
   .btn.btn-info:hover {
   background: #0e1661 !important;
   }
   .reward-block .btn
   {
   width:100% !important;
   }
   .modal-dialog.tire-view {
   width: 300px !important;
   }
   .form-group.has-success.has-feedback {
   margin: 0px 0px !important;
   }
   .modal-dialog.tire-view.btn.btn-info {
   margin: 10px 0px !important;
   }
   .form-group.has-success.has-feedback {
   margin: 10px 0px !important;
   }
   .col-sm-5.control-label
   {
   color: #000 !important;
   font-family: Montserrat !important;
   font-size: 12px !important;
   }
   .modal-dialog.tire-view .modal-header
   {
   padding: 10px !important;
   border-bottom:none;
   }
</style>
@include('include.sizelinks')
<!-- BAnner Down Sestion Start -->
<section id="Visualiser-Products-Section"> </section>
<section id="Visualiser-Section"> </section>
@endsection
@section('custom_scripts')
<!-- <script src="{{ asset('js/ajax/jquery.min.js') }}"></script> -->
<script src="{{ asset('choosen/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('js/slick.js') }}"></script>
<script  src="{{ asset('js/opencv/opencv-3.3.1.js') }}" async></script>
<!-- 
   <script type="text/javascript">
       var boxes;
       var wheelwidth;
       var $loading = $('.se-pre-con');
       // $(".se-pre-con").bind('ajaxStart', function(){
       //     $(this).show();
       // }).bind('ajaxStop', function(){
       //     $(this).hide();
       // });
   
       if("{{@$zipcode==''}}" && "{{@Request::get('flag') != 'searchByVehicle'}}"){
   
               $("#wheelZipcodeModal").modal({
                   backdrop: 'static',
                   keyboard: false
               }); 
       }
   
       if("{{@$zipcode==''}}" && "{{@Request::get('flag') == 'searchByVehicle'}}"){
   
               $("#zipcodeModal").modal({
                   backdrop: 'static',
                   keyboard: false
               }); 
       }
   
   
       $("#wheelZipcodeSubmit").click(function() {
           $.ajax({
               url: "/zipcodeUpdate",
               method: 'POST',
               data: $('#wheelZipcodeForm').serialize(),
               success: function(result) {
                   console.log(result);
                   if (result == 'success') {
                       $("#wheelZipcodeModal").modal('hide');
                       window.location.reload();
                   }
               },
               error: function(jqXHR, textStatus, errorThrown) {
   
   
               }
           });
       }); 
   
    
   
       function getWheelPosition(key){  
           // $(".se-pre-con").show();
           imagePath = "{{public_path()}}/"+$('#car_image_name').val();
           // alert(imagePath)
           carid = $('#car_image_id').val(); 
           $loading.show();
           $.ajax({url: "/runPython",data:{'image':imagePath,'carid':carid}, 
               success: function(result){  
                   // console.log(typeof result)
                   console.log('After Response',new Date($.now()))
                   boxes = JSON.parse(result.toString())
                   console.log('Response Binded ')   
                   var delay = 1000;
                   setTimeout(function() 
                       {  
                       $loading.fadeOut("slow");
                       console.log('Waiting Time Closed')    
                       },
                       delay
                   ) ;    
                   // WheelMapping(JSON.parse(result));
                   // setWheelPosition(result,key);
               },
               error: function (jqXHR, textStatus, errorThrown) {
               
                       $loading.fadeOut("slow");
               }
           });  
       }
   
       if ("{{@$zipcode}}" && "{{@!empty($car_images)}}") {
           getWheelPosition('0');
   
       } else {
           $loading.fadeOut("slow");
       }
   
       function WheelMapping(key){
           if(boxes == 'undefined'){
               getWheelPosition(key)
           }
           console.log('boxes',boxes)
           if(boxes[0][0] < 400 ){
   
               f = boxes[0];
   
               b = boxes[1];
           }else{
   
               f = boxes[1];
   
               b = boxes[0];
           }
              // d=f[3]-f[2];
           // if(d > 21){
           //     f[3] = f[2]+14;//+(f[2]/2);
           // }
   
           // d = f[3]-f[2];
           var front = $('#image-diameter-front-'+key);
           front.css('left',f[0]-18+'px');
           front.css('top',f[1]-1+'px');
           // var extraWidth=0;
           // if(front.width() - f[2] > 4)
           // {
           //     extraWidth=(front.width() - f[2])/2;
           // }
           // console.log(extraWidth)
           // front.width(front.width()+extraWidth+'px');
           // ,front[0]['clientWidth'],f[2]);
           // back.css('width',front.clientWidth-20+'px');
           
   
           // var front = $('#image-diameter-front-'+key);
           // front.css('left',f[0]-19+'px'); //
           // front.css('top',f[1]+2+'px');
           // front.width(f[2]+'px');
           // front.height(f[3]+'px');
           // // front.css('padding','5px')
           // d=b[3]-b[2];
           // if(b[2] < 50){
           //     b[2] = 60;
           // }
           // if(d > 21){
           //     b[3] = b[3]-15;//+(b[2]/2);
           // }
   
           // var back = $('#image-diameter-back-'+key);
           // back.css('left',b[0]-12+'px'); //
           // back.css('top',b[1]+9+'px'); //
           // back.width(b[2]+'px');
           // back.height(b[3]+'px');
   
   
   
   
           var back = $('#image-diameter-back-'+key);
           back.css('left',b[0]-11.5+'px');
           back.css('top',b[1]+8.5+'px');
           // back.css('width',b[2]+'px');
   
   
   
   
   
   
       }
   
   </script> -->
@endsection