<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visualiser - Demo</title>

    <!-- Link CSS styles from Visualiser -->
    <link rel="stylesheet" href="http://web9.vtdns.net/css/ontheme/bootstrap.min.css">
    <link rel="stylesheet" href="http://web9.vtdns.net/css/wheel-api.css"> 
    <link rel="stylesheet" href="http://web9.vtdns.net/css/wheels.css"> 

</head>

<body>
    <section> 
        <br>
          <div class="row container">
              <div class="col-sm-12">
                  <div class="col-sm-2">
                      <h4>Shop By Vehicle</h4>
                  </div>
                  <div class="col-sm-10">
                      <div class="vehicle-list">  
                          <div class="col-sm-3">
                            <label>Make</label>
                              <div class="dropdown">
                                  <select required="" class="form-control make" name="make">
                                      <option value="">Select Make</option> 
                                  </select>
                              </div>
                          </div>

                          <div class="col-sm-3">
                            <label>Year</label>
                              <div class="dropdown">
                                  <select required="" class="form-control year" name="year">
                                      <option value="">Select Year</option> 
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-3">
                            <label>Model</label>
                              <div class="dropdown">
                                  <select required="" class="form-control model" name="model">
                                      <option value="">Select Model</option> 
                                  </select>
                              </div>
                          </div>

                          <div class="col-sm-3">
                            <label>Submodel</label>
                              <div class="dropdown">
                                  <select required="" class="form-control submodel" name="submodel"> 
                                  </select>
                              </div>  
                          </div>
                      </div>
                  </div>
              </div>
          </div> 
    </section>




    <section id="Visualiser-Section">
        <!-- Code of the modal will load here -->
    </section>
 
<br>

    <section id="Visualiser-Products-Section">
        <!-- Code of the modal will load here -->
    </section>


    <br>


    <!-- Scrits for Visualiser API -->
    <script type="text/javascript"> 
            var accesstoken= "{{$request->accesstoken?:'ZDJWaU5pNTJkR1J1Y3k1dVpYUT0='}}"
    </script>
    <!-- Javascript Start --> 
    <script src="http://web9.vtdns.net/js/jquery-2.1.1.min.js"></script>
    <script src="http://web9.vtdns.net/js/bootstrap.min.js"></script>
    <script src="http://localhost:8001/js/wheel-api.js"></script> 
</body>

</html>