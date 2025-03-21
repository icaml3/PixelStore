$(document).ready(function() {
    $('.increase, .decrease').on('click', function() {
        var $button = $(this);
        var $input = $button.closest('.quantity-container').find('.quantity-amount');
        var oldValue = parseInt($input.val());
        var newValue = oldValue;

        if ($button.hasClass('increase')) {
            newValue = oldValue + 1;
        } else if ($button.hasClass('decrease')) {
            newValue = oldValue > 1 ? oldValue - 1 : 1;
        }

        $input.val(newValue);

        var itemId = $input.attr('name').match(/\d+/)[0];

        $.ajax({
            url: '/SellGames/updatecart/' + itemId,
            method: 'POST',
            data: { quantity: newValue },
            success: function(response) {
                // Parse the JSON response
                var data = JSON.parse(response);

                // Update the total price on the page
                var priceTotal = data.priceTotal;
                var priceQuantity = data.priceQuantity;
                $button.closest('tr').find('.product-total').text(priceQuantity + ' VNĐ');
                $('.cart-total').text(priceTotal + ' VNĐ');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    });
});
