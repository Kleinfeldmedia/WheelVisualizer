
// Year based filters for Makes 
$(document).on('change', '.ProductWheelDiameter,.ProductWheelWidth,.BoltPattern,.MinOffset', function() {
    var changeBy = $(this).attr('name');
    var wheeldiameter = $('.ProductWheelDiameter').val();
    var wheelwidth = $('.ProductWheelWidth').val();
    var boltpattern = $('.BoltPattern').val();
    var minoffset = $('.MinOffset').val(); 
    ProductWheelSizeFilters(wheeldiameter, wheelwidth,boltpattern, minoffset,changeBy);
});

function ProductWheelSizeFilters(wheeldiameter = '',wheelwidth = '',boltpattern = '',minoffset = '', changeBy = '') { 
    
    $.ajax({
        method: "GET",
    url: '/getFiltersByProductWheelSize',
        data: {
            wheeldiameter: wheeldiameter,
            wheelwidth: wheelwidth,
            boltpattern: boltpattern,
            minoffset: minoffset,   
            changeBy: changeBy
        }
    }).done(function(data) {

        if (changeBy == '' || changeBy == 'wheeldiameter') {
            $('.ProductWheelWidth').empty().append('<option value="">Select Width</option>');
        }
        if (changeBy == '' || changeBy == 'wheelwidth' || changeBy == 'wheeldiameter') {
            $('.BoltPattern').empty().append('<option value="">Select BoltPattern</option>');
        }
        if (changeBy == '' || changeBy == 'wheeldiameter'|| changeBy == 'wheelwidth'|| changeBy == 'boldpattern') {
            $('.MinOffset').empty().append('<option value="">Select MinOffset</option>');
        }
        if (changeBy == '' || changeBy == 'wheeldiameter'|| changeBy == 'wheelwidth'|| changeBy == 'boldpattern'|| changeBy == 'minoffset') {
            $('.MaxOffset').empty().append('<option value="">Select MaxOffset</option>');
        }
                    // console.log('changeBy',changeBy);
        if (changeBy == '') {
            data.data['wheelwidth'].map(function(value, key) {
                isSelected = (value.wheelwidth == wheelwidth) ? 'selected' : '';
                $('.ProductWheelWidth').append('<option value="' + value.wheelwidth + '" ' + isSelected + '>' + value.wheelwidth + '</option>');
            });
            // data.data['wheeldiameter'].map(function(value, key) {
            //     isSelected = (value.wheeldiameter == wheeldiameter) ? 'selected' : '';
            //     $('.WheelDiameter').append('<option value="' + value.wheeldiameter + '" ' + isSelected + '>' + value.wheeldiameter + '</option>');
            // });
            data.data['boltpattern'].map(function(value, key) {
                isSelected = (value.boltpattern1 == boltpattern) ? 'selected' : '';
                $('.BoltPattern').append('<option value="' + value.boltpattern1 + '" ' + isSelected + '>' + value.boltpattern1 + '</option>');
            });
            data.data['minoffset'].map(function(value, key) {
                isSelected = (value.offset1 == minoffset) ? 'selected' : '';
                $('.MinOffset').append('<option value="' + value.offset1 + '" ' + isSelected + '>' + value.offset1 + '</option>');
            });
            data.data['maxoffset'].map(function(value, key) {
                isSelected = (value.offset1 == maxoffset) ? 'selected' : '';
                $('.MaxOffset').append('<option value="' + value.offset1 + '" ' + isSelected + '>' + value.offset1 + '</option>');
            });
        } else {
            // console.log(data.data)
            data.data.map(function(value, key) {
                if (changeBy == 'wheeldiameter' && value.wheelwidth != null) {
                    $('.ProductWheelWidth').append('<option value="' + value.wheelwidth + '">' + value.wheelwidth + '</option>');
                }
                if (changeBy == 'wheelwidth' && value.boltpattern1 != null) {
                    // alert(value.boltpattern1)
                    $('.BoltPattern').append('<option value="' + value.boltpattern1 + '">' + value.boltpattern1 + '</option>');
                }
                if (changeBy == 'boltpattern' && value.offset1 != null) {
                    // alert(value.boltpattern1)
                    $('.MinOffset').append('<option value="' + value.offset1 + '">' + value.offset1 + '</option>');
                }
                if (changeBy == 'minoffset' && value.offset1 != null) {
                    // alert(value.boltpattern1)
                    $('.MaxOffset').append('<option value="' + value.offset1 + '">' + value.offset1 + '</option>');
                }

            });
        }

        // if(wheeldiameter != null && changeBy !=''){

        //     $('.ProductWheelDiameter').append('<option value="' + wheeldiameter + '" selected>' + wheeldiameter + '</option>');
        // }


    }).fail(function(msg) {
        alert("fails");
    });
}


// ************************************Search By Vehicle Filters Started********************************************


// Year based filters for Makes 
$(document).on('change', '.WheelNavYear,.WheelNavMake,.WheelNavModel', function() {
    var changeBy = $(this).attr('name');

    var make = $('.WheelNavMake').val();
    var year = $('.WheelNavYear').val();
    var model = $('.WheelNavModel').val();
    var submodel = $('.WheelNavSubmodel').val();
    WheelNavFilters(year, make, model,submodel, changeBy);
});

function WheelNavFilters(year = '', make = '', model = '',submodel = '', changeBy = '') {
    $.ajax({
        method: "GET",
        url: '/getFiltersByVehicle',
        data: {
            year: year,
            make: make,
            model: model,
            changeBy: changeBy
        }
    }).done(function(data) {

        $('.WheelNavSubmodel').empty().append('<option value="">Select Trim</option>');

        if (changeBy == '' || changeBy == 'year' || changeBy == 'make') {
            $('.WheelNavModel').empty().append('<option value="">Select Model</option>');
        }
        if (changeBy == '' || changeBy == 'make') {
            $('.WheelNavYear').empty().append('<option value="">Select Year</option>');
        }

        if (changeBy == '') {
            data.data['year'].map(function(value, key) {
                isSelected = (value.year == year) ? 'selected' : '';
                $('.WheelNavYear').append('<option value="' + value.year + '" ' + isSelected + '>' + value.year + '</option>');
            });
            data.data['model'].map(function(value, key) {
                isSelected = (value.model == model) ? 'selected' : '';
                $('.WheelNavModel').append('<option value="' + value.model + '" ' + isSelected + '>' + value.model + '</option>');
            });
            data.data['submodel'].map(function(value, key) {
                isSelected = (value.submodel == submodel) ? 'selected' : '';
                $('.WheelNavSubmodel').append('<option value="' + value.submodel + '"' + isSelected + '>' + value.submodel  + '</option>');
            });
        } else {
            var arrayData = $.map(data.data, function(value, index) {
                return [value];
            });

            arrayData.map(function(value, key) {
                if (changeBy == 'make') {
                    $('.WheelNavYear').append('<option value="' + value.year + '">' + value.year + '</option>');
                }
                if (changeBy == 'year') {
                    $('.WheelNavModel').append('<option value="' + value.model + '">' + value.model + '</option>');
                }
                if (changeBy == 'model') {
                    // $('.WheelNavSubmodel').append('<option value="' + value.submodel + '">' + value.submodel + '</option>');

                    var submodelBody = value.submodel + '-' + value.body;
                    $('.WheelNavSubmodel').append('<option value="'+ submodelBody+'">'+submodelBody+ '</option>');
                }
            });
        }

        if(make != null && changeBy !=''){

            $('.WheelNavMake').append('<option value="' + make + '" selected>' + make + '</option>');
            // $('.WheelNavMake').trigger("chosen:updated");
        }

        // $('.WheelNavYear').trigger("chosen:updated");
        // $('.WheelNavModel').trigger("chosen:updated");
        // $('.DriveBody').trigger("chosen:updated");
        // if (changeBy == 'make') {
        //     $('.WheelNavYear').focus();
        //     $('.WheelNavYear').childrens('option').show();
        // }
        // if (changeBy == 'year') {
        //     $('.WheelNavModel').focus();
        //     $('.WheelNavModel').childrens('option').show();
        // }
        // if (changeBy == 'model') {
        //     $('.WheelNavSubmodel').focus();
        //     $('.WheelNavSubmodel').childrens('option').show();
        // }
    }).fail(function(msg) {
        alert("fails");
    });
}



// ************************************Checkout Page VehicleFilters Started********************************************


// Year based filters for Makes 
$(document).on('change', '.CheckoutYear,.CheckoutMake,.CheckoutModel', function() {
    var changeBy = $(this).attr('name');

    var make = $('.CheckoutMake').val();
    var year = $('.CheckoutYear').val();
    var model = $('.CheckoutModel').val();
    var submodel = $('.CheckoutSubmodel').val();
    CheckoutNavFilters(year, make, model,submodel, changeBy);
});

function CheckoutNavFilters(year = '', make = '', model = '',submodel = '', changeBy = '') {
    $.ajax({
        method: "GET",
        url: '/getFiltersByVehicle',
        data: {
            year: year,
            make: make,
            model: model,
            changeBy: changeBy
        }
    }).done(function(data) {

        $('.CheckoutSubmodel').empty().append('<option value="">Select Trim</option>');

        if (changeBy == '' || changeBy == 'year' || changeBy == 'make') {
            $('.CheckoutModel').empty().append('<option value="">Select Model</option>');
        }
        if (changeBy == '' || changeBy == 'make') {
            $('.CheckoutYear').empty().append('<option value="">Select Year</option>');
        }

        if (changeBy == '') {
            data.data['year'].map(function(value, key) {
                isSelected = (value.year == year) ? 'selected' : '';
                $('.CheckoutYear').append('<option value="' + value.year + '" ' + isSelected + '>' + value.year + '</option>');
            });
            data.data['model'].map(function(value, key) {
                isSelected = (value.model == model) ? 'selected' : '';
                $('.CheckoutModel').append('<option value="' + value.model + '" ' + isSelected + '>' + value.model + '</option>');
            });
            data.data['submodel'].map(function(value, key) {
                isSelected = (value.submodel == submodel) ? 'selected' : '';
                $('.CheckoutSubmodel').append('<option value="' + value.submodel + '"' + isSelected + '>' + value.submodel  + '</option>');
            });
        } else {
            var arrayData = $.map(data.data, function(value, index) {
                return [value];
            });

            arrayData.map(function(value, key) {
                if (changeBy == 'make') {
                    $('.CheckoutYear').append('<option value="' + value.year + '">' + value.year + '</option>');
                }
                if (changeBy == 'year') {
                    $('.CheckoutModel').append('<option value="' + value.model + '">' + value.model + '</option>');
                }
                if (changeBy == 'model') {
                    // $('.CheckoutSubmodel').append('<option value="' + value.submodel + '">' + value.submodel + '</option>');

                    var submodelBody = value.submodel + '-' + value.body;
                    $('.CheckoutSubmodel').append('<option value="'+ submodelBody+'">'+submodelBody+ '</option>');
                }
            });
        }

        if(make != null && changeBy !=''){

            // $('.CheckoutMake').append('<option value="' + make + '" selected>' + make + '</option>');
            // $('.CheckoutMake').trigger("chosen:updated");
        }

        // $('.CheckoutYear').trigger("chosen:updated");
        // $('.CheckoutModel').trigger("chosen:updated");
        // $('.DriveBody').trigger("chosen:updated");
        // if (changeBy == 'make') {
        //     $('.CheckoutYear').focus();
        //     $('.CheckoutYear').childrens('option').show();
        // }
        // if (changeBy == 'year') {
        //     $('.CheckoutModel').focus();
        //     $('.CheckoutModel').childrens('option').show();
        // }
        // if (changeBy == 'model') {
        //     $('.CheckoutSubmodel').focus();
        //     $('.CheckoutSubmodel').childrens('option').show();
        // }
    }).fail(function(msg) {
        alert("fails");
    });
}


