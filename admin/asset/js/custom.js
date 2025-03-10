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
                console.log(res);
                if (res.status == 200) {
                    
                    
                    alertify.success(res.message);

                } else {
                    alertify.error(res.message);
                }
            }
        });
    }
});
            



