@extends('admin.layouts.app')

@section('content')


<?php
$is_read_access = VerifyAccess('orders','read');
$is_write_access = VerifyAccess('orders','write');
?>




<style type="text/css">
  .hide{
    display: none;
  }
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
                    <h4>List of Orders</h4>
                    <div style="text-align:right;padding-bottom: 20px"> 
                    <a  class="btn btn-info"  href="{{url('admin/exportTable')}}?module=Order">Export CSV </a>
                    
                    </div>
                    <div class="asset-inner">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Invoice # </th>
                                    <th>Name</th>
                                    <th>No.Of Items</th>
                                    <th>Billing / Shipping Address</th>
                                    <th>Vehicle</th>
                                    <th>Notes</th>
                                    <!-- <th>Subtotal</th> -->
                                    <th>Fees</th>
                                    <th>Tax</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th> 
                                </tr>
                            </thead> 
                            @forelse(@$orders as $key => $order) 
                            <tr>
                                <td>{{@$key+1}}</td>
                                <td>{{@$order->ordernumber}}</td>
                                <td>{{@$order->firstname}}</td>
                                <td class="td-center">

                                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#items{{$key}}">{{@$order->OrderItems->count()}} Items</button>
                                
                                                    <!-- model Start -->
                                                    <div class="modal fade " id="items{{$key}}" role="dialog">
                                                        <div class="items-modal modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title text-left">Ordered Items</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <h4 class="modal-title">
                                                                        <table class="table table-bordered"> 
                                                                          <tr>
                                                                            <th>Type</th>
                                                                            <th>Image</th>
                                                                            <th>Detail</th>
                                                                            <th>Each Price</th>
                                                                            <th>Quantity</th>
                                                                            <th>Total</th>
                                                                          </tr>
                                                                          @foreach($order->OrderItems as $orderKey =>$item)
                                                                          <tr>
                                                                            <td>{{ucfirst(@$item->producttype)}}</td>
                                                                            <td><img src="{{ViewImage(@$item->ProductDetail()->prodimage)}}"></td>
                                                                            <td>{{@$item->ProductDetail()->detailtitle}}</td>
                                                                            <td>{{roundCurrency(@$item->price)}}</td>
                                                                            <td  class="td-center">{{@$item->qty}}</td>
                                                                            <td>{{roundCurrency(@$item->total)}}</td>
                                                                          </tr>
                                                                          @endforeach
                                                                        </table>
                                                                </h4> 
                                                                        <div class="form-group has-success has-feedback text-center">
                                                                            <button class="btn btn-info btn-close" type="button" data-dismiss="modal" >Close</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Model End  -->                    
                                </td>
                                <td class="td-center">
                                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#billing{{$key}}">View</button>
                                                    <!-- model Start -->
                                                    <div class="modal fade " id="billing{{$key}}" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title text-left">Billing / Shipping Address</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <h4 class="modal-title">
                                                                  <?php $is_shipping=($order->same_shipping == 'yes')?'hide':''; ?>  
                                                                        <table class="table table-bordered"> 
                                                                          <tr>
                                                                            <th>#</th>
                                                                            <th>Billing Address</th> 
                                                                            <th class="{{$is_shipping}}">Shipping Address</th> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>First Name</td>
                                                                            <td>{{@$order->firstname}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_firstname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Last Name</td>
                                                                            <td>{{@$order->lastname}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_lastname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Company Name</td>
                                                                            <td>{{@$order->companyname}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_companyname}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Email</td>
                                                                            <td>{{@$order->email}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_email}}</td> 
                                                                          </tr>
                                                                          <tr>
                                                                            <td>Day Phone</td>
                                                                            <td>{{@$order->dayphone}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_dayphone}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Cell Phone</td>
                                                                            <td>{{@$order->cellphone}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_cellphone}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Address</td>
                                                                            <td>{{@$order->address}}<br>{{@$order->address2}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_address}}<br>{{@$order->shipping_address2}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>State</td>
                                                                            <td>{{@$order->state}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_state}}</td> 
                                                                          </tr>

                                                                          <tr>
                                                                            <td>Zip</td>
                                                                            <td>{{@$order->zip}}</td> 
                                                                            <td class="{{$is_shipping}}">{{@$order->shipping_zip}}</td> 
                                                                          </tr>
                                                                        </table>
                                                                </h4>  
                                                                        <div class="form-group has-success has-feedback text-center">
                                                                            <button class="btn btn-info btn-close" type="button" data-dismiss="modal" >Close</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Model End  -->
                                </td> 
                                <td>
                                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#vehicle{{$key}}">View</button>
                                                    <!-- model Start -->
                                                    <!-- model Start -->
                                                    <div class="modal fade " id="vehicle{{$key}}" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title text-left">Vehicle Information</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                <h4 class="modal-title">
<pre>
Make                    : {{@$order->make}},
Year                    : {{@$order->year}},
Model                   : {{@$order->model}},
Trim                    : {{@$order->trim}},

Is Vehicle Modified?    : {{@$order->vehicle_modified}}<br>
Big Brake Kit?          : {{@$order->big_brake_kit}}<br>
Raised or Lowered?      : {{@$order->raised_lowered}}<br>
Modified Please Explain : 
    {{@$order->modified_notes}}


</pre>
                                                                </h4> 
                                                                        <div class="form-group has-success has-feedback text-center">
                                                                            <button class="btn btn-info btn-close" type="button" data-dismiss="modal" >Close</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Model End  -->

                                </td>

                                <td><textarea class="form-control" cols="15" readonly="">{{@$order->notes}}
                                        </textarea></td>
                                <!-- <td>{{roundCurrency(@$order->subtotal)}}</td> -->
                                <td>{{roundCurrency(@$order->fees)}}</td>
                                <td>{{roundCurrency(@$order->tax)}}</td>
                                <td>{{roundCurrency(@$order->shipping)}}</td>
                                <td>{{roundCurrency(@$order->total)}}</td>
                                <td>{{@$order->payment_status?'Paid':'Not Paid'}}</td>
                                <td>
                                  @if($is_write_access)

                                                        <!-- <div class="dropdown"> -->
                                                            <select  name="order_status[]" class="form-group form-control order_status" data-order_id="{{@$order->id}}" data-invoice="{{@$order->ordernumber}}"> 
                                                                @foreach(OrderStatus() as $orderKey => $status)
                                                                <option value="{{$status}}" {{($order->status == $status)?'selected':''}}>{{$status}}</option>
                                                                @endforeach
                                                            </select>
                                                        <!-- </div> -->
                                  @else
                                  {{@OrderStatus($order->status,'greater')}}
                                  @endif
                                </td> 
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Orders found</td>
                            </tr>
                            @endforelse
                        </table>

                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
$('.order_status').each(function() {
    //Store old value
    $(this).data('lastValue', $(this).val());
});
$(".order_status").change(function(){
  var lastStatus = $(this).data('lastValue');
  var status = $(this).val();  
  var order_id = $(this).data('order_id');
  var invoice = $(this).data('invoice');
  var alertMsg = "Are you sure to change the status for Invoice : "+invoice+" to '"+status+"'";
  if(confirm(alertMsg)){
        $.ajax({
            url: "/admin/order/update/"+order_id,
            data:{"status":status  }, 
            success: function(result){  
              alert(result.msg);
                // console.log(typeof result)
                 $('#custom-msg').html(`
                  <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          `+result.msg+`
                  </div>`);

            },
            error: function (jqXHR, textStatus, errorThrown) {
            
                    // $loading.fadeOut("slow");
            }
        });  
  }else{

        $(this).val(lastStatus);
  }
     
});

    
</script>
@endsection