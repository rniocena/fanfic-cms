$(document).on('click', '.manageInventory', function(e) {
    e.preventDefault();

    var href = $(this).data('href');

    $.ajax({
        url: $(this).data('href'),
        type: 'GET',
        success: function (data, index) {

            var html = $(data);

            var modal = $('.generic');

            modal
                .find('.modal-content')
                .html(html)
            ;

            $('.btn-save-item').data('href', href);

            modal.modal('show');

            console.log('status selected successfully');
        },
        error: function (jqXHR) {
            console.log("Failed to select status");
        }
    });
});

$(document).on('click', '.btn-save-item', function(e) {
    e.preventDefault();

    var href = $(this).data('href');
    var item_name = $('#itemName').val();
    var quantity = $('#quantity').val();
    var price = $('#price').val();
    var unit = $('#unit').val();

    if(!item_name || !quantity || !price) {
        if(!item_name) {
            $('.itemNameError').show();
        } else {
            $('.itemNameError').hide();
        }

        if(!quantity) {
            $('.quantityError').show();
        } else {
            $('.quantityError').hide();
        }

        if(!price) {
            $('.priceError').show();
        } else {
            $('.priceError').hide();
        }
    } else {
        $('.itemNameError').hide();
        $('.quantityError').hide();
        $('.priceError').hide();

        $.ajax({
            url: href,
            type: 'POST',
            data: {
                item_name: item_name,
                quantity: quantity,
                price: price,
                unit_id: unit
            },
            success: function (data, index) {
                window.location.reload();
            },
            error: function (jqXHR) {
                console.log("Failed to change status");
            }
        });
    }
});