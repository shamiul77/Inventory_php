$(document).ready(function () {
    $(document).on('click', '.increment', function () {
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue)) {
            var qtyValue = currentValue + 1;
            $quantityInput.val(qtyValue);
            quantityIncDec(productId, qtyValue);
        }
    });

    $(document).on('click', '.decrement', function () {
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.proId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue) && currentValue > 1) {
            var qtyValue = currentValue - 1;
            $quantityInput.val(qtyValue);
            quantityIncDec(productId, qtyValue);
        }
    });


    function quantityIncDec(prodId, qty) {

        $.ajax({
            type: "POST",
            url: "ordersBackend.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'quantity': qty,
            },
            success: function (response) {
                var res = JSON.parse(response);

                if (res.status == 200) {
                    
                    
                    alertify.success(res.message);

                } else {
                    alertify.error(res.message);
                }
            }
        });
    }



    //Place order
    
$(document).on('click', '.placeOrder', function () {

    var paymentMethod = $('#payment_method').val();
    var customerPhone = $('#customerPhone').val();

    if (paymentMethod == '') {
        Swal.fire("Select Payment Method", "Select Your Payment Method", "warning");
        return false;
    }

    if (customerPhone == '' && !$.isNumeric(customerPhone)) {
        Swal.fire("Enter Customer Phone Number", "Enter valid Phone Number", "warning");
        return false;
    }


    var data = {
        'placeOrder': true,
        'customerPhone': customerPhone,
        'payment_method': paymentMethod

    };
    $.ajax({
            type: "POST",
            url: "ordersBackend.php",
        data: data,
        success: function (response) {
    var res = JSON.parse(response);
    if (res.status == 200) {
        window.location.href = "orderSummery.php";
    } else if (res.status == 404) {
        Swal.fire({
            title: res.message,
            text: res.message,
            icon: res.status_type,
            showCancelButton: true,
            confirmButtonText: "Add Customer",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#addCustomerModal').modal('show');
            }
        });
    } else {
        Swal.fire(res.message, res.message, res.status_type);
    }
}


    });
    


}); 
}); 
            


