    calculateTotal();
    function calculateTotal(){
        var tot=0;
        $('.quantity').each(function(){

            var qty = $(this).val();
            var key = $(this).data('key');
            var price = $('.row'+key).find('.eachprice').data('price') * qty;
            tot =  tot+price;
        })
        text =  "$"+tot.toFixed(2);
        $('.finaltotal').text(text)

        if($("div").hasClass("cart-total-section")){
            $(".cart-total-section").find('.cart-subtotal').text(text);
            $(".cart-total-section").find('.cart-fees').text("$0.00");
            $(".cart-total-section").find('.cart-tax').text('TBD');
            $(".cart-total-section").find('.cart-shipping').text('TBD');
            $(".cart-total-section").find('.cart-total').text(text);
        }
    }

    function updateCart(qty,productid,producttype){
        // $(".se-pre-con").show(); 
        console.log(qty,productid,producttype)
        $.ajax({url: "/updateCart",data:{'qty':qty,'productid':productid,'producttype':producttype}, success: function(result){
            if(result =='success'){
                // $(modelid).find('.modal-msg').text(modalMsg);
                // $(modelid).modal("show");
                // $(".se-pre-con").hide(); 
            }
            // $(".se-pre-con").hide(); 
        }});
    }
    
    $('.quantity').change(function(){

        // var modelid = $(this).data('modelid');
        var qty = $(this).val();
        if(qty < 1){
            $(this).val(1); 
            qty=1;
        }
        var key = $(this).data('key');
        var productid =  $('.row'+key).find('.productid').val();
        var producttype = $('.row'+key).find('.producttype').val();
        var price = $('.row'+key).find('.eachprice').data('price') * qty;
        text =  "$"+price.toFixed(2);
        $('.row'+key).find('.eachtotal').text(text);
        updateCart(qty,productid,producttype);
        calculateTotal();



    })
