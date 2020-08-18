
// Year based filters for VMakes 
$(document).on('change', '.VYear,.VMake,.VModel', function() {
    var changeBy = $(this).attr('name');

    var make = $('.VMake').val();
    var year = $('.VYear').val();
    var model = $('.VModel').val();
    var driverbody = $('.VDriveBody').val(); 
    filters(year, make, model, driverbody, changeBy);
});
$(document).ready(function() {
    var changeBy = '';

    var make = $('.VMake').val();
    var year = $('.VYear').val();
    var model = $('.VModel').val();
    var driverbody = $('.VDriveBody').val(); 
    filters(year, make, model, driverbody, changeBy);
}); 

function filters(year = '', make = '', model = '', driverbody = '', changeBy = '') {
    $.ajax({
        method: "GET",
        url: '/vehicledetails',
        data: {
            year: year,
            make: make,
            model: model,
            changeBy: changeBy
        }
    }).done(function(data) {

        $('.VDriveBody').empty().append('<option disabled selected>Select Drive/Body</option>');

        if (changeBy == '' || changeBy == 'year' || changeBy == 'make') {
            $('.VModel').empty().append('<option disabled selected>Select Model</option>');
        }
        if (changeBy == '' || changeBy == 'make') {
            $('.VYear').empty().append('<option disabled selected>Select Year</option>');
        }

        if (changeBy == '') {
            data.data['year'].map(function(value, key) {
                isSelected = (value.yr == year) ? 'selected' : '';
                $('.VYear').append('<option value="' + value.yr + '" ' + isSelected + '>' + value.yr + '</option>');
            });
            data.data['model'].map(function(value, key) {
                isSelected = (value.model == model) ? 'selected' : '';
                $('.VModel').append('<option value="' + value.model + '" ' + isSelected + '>' + value.model + '</option>');
            });
            data.data['driverbody'].map(function(value, key) {
                isSelected = (value.vif == driverbody) ? 'selected' : '';
                $('.VDriveBody').append('<option value="' + value.vif + '"' + isSelected + '>' + value.whls + ' ' + value.drs + ' ' + value.body + '</option>');
            });
        } else {
            data.data.map(function(value, key) {
                if (changeBy == 'make') {

                    isSelected = (value.yr == year) ? 'selected' : '';
                    $('.VYear').append('<option value="' + value.yr + '"' + isSelected + '>' + value.yr + '</option>');
                }
                if (changeBy == 'year') {
                    isSelected = (value.model == model) ? 'selected' : '';
                    $('.VModel').append('<option value="' + value.model + '"' + isSelected + '>' + value.model + '</option>');
                }
                if (changeBy == 'model') {
                    isSelected = (value.vif == driverbody) ? 'selected' : '';
                    $('.VDriveBody').append('<option value="' + value.vif + '"' + isSelected + '>' + value.whls + ' ' + value.drs + ' ' + value.body + '</option>');
                }
            });
        }

        // if(make != null && changeBy !=''){

        //     // $('.VMake').append('<option value="' + make + '" selected>' + make + '</option>');
        //     $('.VMake').trigger("chosen:updated");
        // }
         $('.VMake').trigger("chosen:updated");
            $('.VYear').trigger("chosen:updated");
            $('.VModel').trigger("chosen:updated");
            $('.VDriveBody').trigger("chosen:updated");
    }).fail(function(msg) {
        alert("fails");
    });
}

//  Driver / Body change your car 
$('.VDriveBody').on('change', function() {
    var car_id = $(this).val();
    if (car_id != '') {
        updateParamsToUrl('car_id', car_id);
    }
});
