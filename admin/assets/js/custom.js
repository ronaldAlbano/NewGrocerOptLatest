$(document).ready(function () {

    alertify.set('notifier','position', 'top-right');

    $(document).on('click', '.increment', function (event) {


        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if(!isNaN(currentValue)){
            var qtyVal = currentValue + 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);
        }

    });
    
    $(document).on('click', '.decrement', function (event) {
     
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if(!isNaN(currentValue) && currentValue > 1){
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);
        }
    });

    function quantityIncDec(prodId, qty){

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'quantity': qty,
            },
            success: function (response) {
                var res = JSON.parse(response);
    

                if(res.status == 200){
                    $('#productArea').load(' #productContent');
                    alertify.success(res.message);
                }
                else{
                    $('#productArea').load(' #productContent');
                    alertify.error(res.message);
                }
             }
            
        });

    }

    // proceed to place order button click

    $(document).on('click', '.proceedToPlace', function () {
        console.log('proceedToPlace');
    
        var data = {
            'proceedToPlaceBtn': true,
        };
    
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: data,
            dataType: 'json', // Specify that the expected response is JSON
            success: function (response) {
                console.log(response);
    
                if (response.status_type === 'success') {
                    window.location.href = "order-summary.php";
                }
            }
        });
    });

    $(document).on('click', '#saveOrder', function () {

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'saveOrder': true
            },
              success: function (response) {
                var res = JSON.parse(response);

                if (res.status == 200) {
                    swal(res.message, res.message, res.status_type);
                    $('#orderPlaceSuccessMessage').text(res.message);
                    $('#orderSuccessModal').modal('show');
                }else{
                    swal(res.message, res.message, res.status_type);
                }

            }

    });
});







});
