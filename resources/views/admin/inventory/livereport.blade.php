@extends('admin.layouts.app')

@section('content')


<?php
$is_read_access = VerifyAccess('logs','read');
$is_write_access = VerifyAccess('logs','write');
?>




<style type="text/css">
    .req {
        color: red;
    }

    .edit_modal {
        margin: 6%;
        padding: 20px;
    }
    td.scrollable {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: auto !important;
    }
    .items-modal{
      width: 1000px !important;
    }
    .td-center{
        text-align: center !important;
    }
/*1131px*/
</style>

<div class="se-pre-con"></div>
<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap drp-lst">
                    <h4>Live Report for Inventories</h4>
                    <div style="text-align:right;padding-bottom: 20px"> 
                    <!-- <a  class="btn btn-info"  href="{{url('admin/exportTable')}}?module=Order">Export CSV </a> -->
                    
                    </div>
                    <div class="asset-inner">
                        <table id="livereportTable"> 
                              @include('admin.inventory.livedata')
                             
                        </table>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript"> 

</script>
@endsection
@section('custom_scripts')
<script type="text/javascript">  

        $(document).ready(function() {

            var table = $('#livereportTable').DataTable({
                dom: 't', // This shows just the table 
                paging: false
            });


            $('#data-table-search').on('keyup change', function() {
                table.search($('#data-table-search').val()).draw();
            });


        });


setInterval(function(){getLiveData();}, 6000);



function getLiveData(){
      console.log('getLiveData');
      $.ajax({
          url: "/admin/logs/vftp/",
          data:{}, 
          success: function(result){  
              // console.log(typeof result)
               $('#livereportTable').html(result); 
               $(".se-pre-con").fadeOut("slow");

          },
          error: function (jqXHR, textStatus, errorThrown) {
                $(".se-pre-con").fadeOut("slow");
                  // $loading.fadeOut("slow");
          }
      });  
}


    
</script>
@endsection