                <div class="modal fade" id="zipcodeModal" role="dialog">
                    <div class="modal-dialog tire-view">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Zipcode</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="zipcodeForm">
                                    <div class="form-group has-success has-feedback">
                                        <label class="col-sm-5 control-label" for="inputSuccess">Your Zipcode</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  name="zipcode" required="">
                                            {{@csrf_field()}}
                                        </div>
                                    </div>
                                    <div style="text-align:center;">
                                        <button class="btn btn-info" id="zipcodeSubmit" type="button">Continue</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" id="offroadTypeModal" role="dialog">
                    <div class="modal-dialog tire-view">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Select any one for your vehicle</h4>
                            </div>
                            <div class="modal-body"  >
                                <!-- <div class="col-md-12"> -->
                                    
                                    <div style="text-align: center;">
                                        <a class="btn btn-info offroad-select" data-offroad="levelkit">
                                            <img src="{{asset('/image/lifttype.jpg')}}" >
                                            <br>
                                            <h3 style="color: white !important">Leveling Kit</h3>
                                        </a> 
                                    </div>

                                                       <br>                                 
                                    <div style="text-align: center;">    
                                        <button class="btn btn-info offroad-select" data-offroad="lift">
                                            <img src="{{asset('/image/lifttype.jpg')}}" >
                                            <br>
                                            <h3 style="color: white !important">Lift Kit</h3>
                                        </button>
                                    </div>
                                    <br>
                                    <div style="text-align: center;"> 
                                        <button class="btn btn-info offroad-select" data-offroad="stock">

                                            <img src="{{asset('/image/lifttype.jpg')}}" >
                                            <br>
                                            <h3 style="color: white !important">Stock</h3>
                                        </button>
                                    </div> 
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" id="liftsizeModal" role="dialog">
                    <div class="modal-dialog tire-view">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Please select your vehicle's lift:</h4>
                            </div>
                            <div class="modal-body"> 
                            </div>
                        </div>
                    </div>
                </div>