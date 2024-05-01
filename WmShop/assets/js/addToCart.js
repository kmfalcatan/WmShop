$(document).ready(function () {
    // Handle checkbox click event
    $('.checkBox').on('click', function () {
        updateTotalPrice();
    });

    // Handle delete button click event
    $('.deleteIcon').on('click', function () {
        // Get the cart ID from the data attribute
        let CartID = $(this).data('cart-id');
        
        // Send an AJAX request to delete the item from the cart table
        $.ajax({
            type: 'POST',
            url: '../function/deleteCartItem.php', // Create a new PHP file (deleteCartItem.php) to handle the deletion
            data: { CartID: CartID },
            success: function (response) {
                // Update the page after successful deletion
                location.reload();
            },
            error: function (error) {
                console.error('Error deleting item:', error);
            }
        });
    });

    // Function to update total price based on selected items
    function updateTotalPrice() {
        let totalPrice = 0;
        // Loop through all checkboxes
        $('.checkBox').each(function () {
            if ($(this).prop('checked')) {
                // Get the price and quantity from data attributes
                let price = parseFloat($(this).data('price'));
                let quantity = parseInt($(this).data('quantity'));
                // Check if price and quantity are valid numbers
                if (!isNaN(price) && !isNaN(quantity)) {
                    // Add price * quantity to total price
                    totalPrice += price * quantity;
                }
            }
        });
        // Display the total price
        $('#totalPrice span').text(totalPrice.toFixed(2)); // Format to two decimal places
    }
});
