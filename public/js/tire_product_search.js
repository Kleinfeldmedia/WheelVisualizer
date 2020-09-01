
// ********************************************Tire Search By Size Started ***************************************************
// Year based filters for Makes 
$(document).on('change', '.NavWidth,.NavProfile', function() {
    var changeBy = $(this).attr('name');
    var width = $('.NavWidth').val();
    var profile = $('.NavProfile').val();
    NavTireFilters(width, profile, changeBy);
});

// $(document).ready(function() {
//     var width = $('.NavWidth').val();
//     var profile = $('.NavProfile').val();
//     NavTireFilters(width, profile);
// });

function NavTireFilters(width = '',profile = '', changeBy = '') {
    $.ajax({
        method: "GET",
        url: '/getFiltersByTire',
        data: {
            width: width,
            profile: profile,
            changeBy: changeBy
        }
    }).done(function(data) {

        $('.NavDiameter').empty().append('<option value="">Select Diameter</option>');

        if (changeBy == '' || changeBy == 'profile' ) {
            $('.NavDiameter').empty().append('<option value="">Select Diameter</option>');
        }
        if (changeBy == '' || changeBy == 'width') {
            $('.NavProfile').empty().append('<option value="">Select Profile</option>');
        }

        if (changeBy == '') {
            data.data['profile'].map(function(value, key) {
                isSelected = (value.tireprofile == profile) ? 'selected' : '';
                $('.NavProfile').append('<option value="' + value.tireprofile + '" ' + isSelected + '>' + value.tireprofile + '</option>');
            });
            data.data['diameter'].map(function(value, key) {
                isSelected = (value.tirediameter == diameter) ? 'selected' : '';
                $('.NavDiameter').append('<option value="' + value.tirediameter + '" ' + isSelected + '>' + value.tirediameter + '</option>');
            });
        } else {
            data.data.map(function(value, key) {
                if (changeBy == 'width') {
                    $('.NavProfile').append('<option value="' + value.tireprofile + '">' + value.tireprofile + '</option>');
                }
                if (changeBy == 'profile') {
                    $('.NavDiameter').append('<option value="' + value.tirediameter + '">' + value.tirediameter + '</option>');
                }
            });
        }

        // if(width != null && changeBy !=''){

        //     $('.NavWidth').append('<option value="' + width + '" selected>' + width + '</option>');
        //     // $('.NavWidth').trigger("chosen:updated");
        // }

        // $('.NavProfile').trigger("chosen:updated");
        // $('.NavDiameter').trigger("chosen:updated");

    }).fail(function(msg) {
        alert("fails");
    });
}


// ********************************************Tire Search By Vehicle Started ***************************************************



// Year based filters for Makes 
$(document).on('change', '.NavYear,.NavMake,.NavModel', function() {

    var changeBy = $(this).attr('name');

    var make = $('.NavMake').val();
    var year = $('.NavYear').val();
    var model = $('.NavModel').val();
    var submodel = $('.NavSubmodel').val();
    if($(this).val()!=''){
        NavFilters(year, make, model,submodel, changeBy);
    }
});


function NavFilters(year = '', make = '', model = '',submodel = '', changeBy = '') {
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

        $('.NavSubmodel').empty().append('<option value="">Select Trim</option>');

        if (changeBy == '' || changeBy == 'year' || changeBy == 'make') {
            $('.NavModel').empty().append('<option value="">Select Model</option>');
        }
        if (changeBy == '' || changeBy == 'make') {
            $('.NavYear').empty().append('<option value="">Select Year</option>');
        }

        if (changeBy == '') {
            data.data['year'].map(function(value, key) {
                isSelected = (value.year == year) ? 'selected' : '';
                $('.NavYear').append('<option value="' + value.year + '" ' + isSelected + '>' + value.year + '</option>');
            });
            data.data['model'].map(function(value, key) {
                isSelected = (value.model == model) ? 'selected' : '';
                $('.NavModel').append('<option value="' + value.model + '" ' + isSelected + '>' + value.model + '</option>');
            });
            data.data['submodel'].map(function(value, key) {
                isSelected = (value.submodel == submodel) ? 'selected' : '';
                $('.NavSubmodel').append('<option value="' + value.submodel + '"' + isSelected + '>' + value.submodel  + '</option>');
            });
        } else {

            var arrayData = $.map(data.data, function(value, index) {
                return [value];
            });

            arrayData.map(function(value, key) {
                console.log(value)
                if (changeBy == 'make') {
                    $('.NavYear').append('<option value="' + value.year + '">' + value.year + '</option>');
                }
                if (changeBy == 'year') {
                    $('.NavModel').append('<option value="' + value.model + '">' + value.model + '</option>');
                }
                if (changeBy == 'model') {
                    var submodelBody = value.submodel + '-' + value.body;
                    $('.NavSubmodel').append('<option value="'+ submodelBody+'">'+submodelBody+ '</option>');
                    // $('.NavSubmodel').append('<option value="' + value.submodel + '">' + value.submodel + ' </option>');
                }
            });
        }

        if(make != null && changeBy !=''){

            // $('.NavMake').append('<option value="' + make + '" selected>' + make + '</option>');
            // $('.NavMake').trigger("chosen:updated");
        }

        // $('.NavYear').trigger("chosen:updated");
        // $('.NavModel').trigger("chosen:updated");
        // $('.DriveBody').trigger("chosen:updated");
        // if (changeBy == 'make') {
        //     $('.NavYear').focus();
        //     $('.NavYear').childrens('option').show();
        // }
        // if (changeBy == 'year') {
        //     $('.NavModel').focus();
        //     $('.NavModel').childrens('option').show();
        // }
        // if (changeBy == 'model') {
        //     $('.NavSubmodel').focus();
        //     $('.NavSubmodel').childrens('option').show();
        // }
    }).fail(function(msg) {
        alert("fails");
    });
}
