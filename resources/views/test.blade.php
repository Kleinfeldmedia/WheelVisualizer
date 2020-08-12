<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visualiser - Demo</title>

    <!-- Link CSS styles from Visualiser -->
    <link rel="stylesheet" href="http://web9.vtdns.net/css/ontheme/bootstrap.min.css">
    <link rel="stylesheet" href="http://web9.vtdns.net/css/wheel-api.css"> 

</head>

<body>
    <section> 
        <br>
          <div class="row container">
              <div class="col-sm-12">
                  <div class="col-sm-2">
                      <h1>Shop By Vehicle</h1>
                  </div>
                  <div class="col-sm-10">
                      <div class="vehicle-list"> 
                          <form id="WheelVehicleSearch"> 
                              <div class="dropdown">
                                  <select required="" class="form-control make" name="make">
                                      <option value="">Select Make</option> 
                                  </select>
                              </div>

                              <div class="dropdown">
                                  <select required="" class="form-control year" name="year">
                                      <option value="">Select Year</option> 
                                  </select>
                              </div>

                              <div class="dropdown">
                                  <select required="" class="form-control model" name="model">
                                      <option value="">Select Model</option> 
                                  </select>
                              </div>

                              <div class="dropdown">
                                  <select required="" class="form-control submodel" name="submodel"> 
                                  </select>
                              </div> 
                          </form>
                      </div>
                  </div>
              </div>
          </div> 
    </section>




    <section id="Visualiser-Section">
        <!-- Code of the modal will load here -->
    </section>
 

    <!-- Scrits for Visualiser API -->
    <script type="text/javascript">
        var data = {
            year: "{{$request->year?:'2015'}}",
            make: "{{$request->make?:'Volvo'}}",
            model: "{{$request->model?:'S60'}}",
            submodel: "{{$request->submodel?:'T6 Polestar-4 Dr Sedan'}}",
            wheelpartno: "{{$request->wheelpartno?:'2610Z20KOSAGB'}}",
            accesstoken: "{{$request->accesstoken?:'Ykc5allXeG9iM04w'}}",
        }
    </script>
    <!-- Javascript Start --> 
    <script src="http://web9.vtdns.net/js/jquery-2.1.1.min.js"></script>
    <script src="http://web9.vtdns.net/js/bootstrap.min.js"></script>
    <script src="http://web9.vtdns.net/js/wheel-api.js"></script> 
</body>

</html>