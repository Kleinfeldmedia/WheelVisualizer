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

<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap drp-lst">
                    <h4>List of Current Process</h4>
                    <div class="asset-inner">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Folder Name</th>
                                    <th>Dropshipper Name</th>
                                    <th>Read Count</th> 
                                    <th>Started At</th> 
                                </tr>
                            </thead> 
                            @forelse(@$processes as $key => $process) 
                            <tr>
                                <td>{{@$key+1}}</td>
                                <td>{{@$process->foldername}}</td>
                                <td>{{@$process->dropshipper}}</td>
                                <td>{{@$process->loopcount}}</td> 
                                <td>{{@$process->started_at}}</td>  
                            </tr> 
                            @empty 
                            @endforelse
                        </table>

                        {{$processes->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">

// $(".form-control-file").click(function(){
//     // $new = $(this).clone().removeClass('dropify');
//     // $(this).after($new);

//   $(this).parent().closest('.dropify-wrapper').find('.hidden-file-input').click();
// });

    
</script>
@endsection