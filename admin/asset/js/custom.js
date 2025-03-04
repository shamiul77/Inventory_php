$(document).ready(function () {
    // Increment button click handler
    $(document).on('click', '.increment', function () {
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.proId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue)) {
            var qtyValue = currentValue + 1;
            $quantityInput.val(qtyValue);
            quantityIncDec(productId, qtyValue);
        }
    });

    // Decrement button click handler
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

    // Function to update quantity via AJAX
    function quantityIncDec(proId, qty) {
        $.ajax({
            type: "POST",
            url: "ordersBackend.php",
            data: {
                'productIncDec': true,
                'product_id': proId,
                'quantity': qty,
            },
            success: function (response) {
                var res = JSON.parse(response);

                if (res.status == 200) {
                    // Update the price in the table
                    updatePrice(proId, res.newTotalPrice);
                    alertify.success(res.message);
                } else {
                    alertify.error(res.message);
                }
            },
        });
    }

    // Function to update price in the table
    function updatePrice(proId, newTotalPrice) {
        // Find the row containing the product and update the price
        $("tr").each(function () {
            var $row = $(this);
            var productRowId = $row.find('.proId').val();
            if (productRowId == proId) {
                $row.find('.totalPrice').text(newTotalPrice); // Update total price in the table
            }
        });
    }
});
