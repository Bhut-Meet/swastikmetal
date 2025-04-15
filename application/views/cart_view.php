<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cart_items)): ?>
            <?php foreach ($cart_items as $item): ?>
                <tr>
                <td><?= $item['user_id'] ?></td>
                    <td><?= $item['product_name'] ?></td>
                    <td><?= $item['size'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-secondary change-qty" data-cart-id="<?= $item['id'] ?>" data-action="decrease">-</button>
                        <span class="qty"><?= $item['quantity'] ?></span>
                        <button class="btn btn-sm btn-secondary change-qty" data-cart-id="<?= $item['id'] ?>" data-action="increase">+</button>
                    </td>
                    <td>₹<?= number_format($item['product_price'], 2) ?></td>
                    <td class="item-total" data-item-id="<?= $item['id'] ?>">₹<?= number_format($item['product_price'] * $item['quantity'], 2) ?></td>
                    <td>
                        <a href="<?= site_url('cart/remove/'.$item['id']) ?>" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Your cart is empty.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<p><strong>Total: ₹<span id="total"><?= isset($total) ? number_format($total, 2) : '0.00' ?></span></strong></p>

<script>
    $(document).ready(function() {
        // Change quantity buttons
        $('.change-qty').on('click', function() {
            var action = $(this).data('action');
            var cartId = $(this).data('cart-id');
            var qtyElement = $(this).siblings('.qty');
            var currentQty = parseInt(qtyElement.text());

            // Update quantity based on action
            if (action === 'increase') {
                currentQty++;
            } else if (action === 'decrease' && currentQty > 1) {
                currentQty--;
            }

            // Update the quantity on the frontend
            qtyElement.text(currentQty);

            // Send AJAX request to update quantity in the database
            $.ajax({
                url: '<?= site_url('cart/update_quantity') ?>',
                type: 'POST',
                data: {
                    cart_id: cartId,
                    quantity: currentQty
                },
                success: function(response) {
                    if (response.success) {
                        // Update the total price for the item
                        var itemPrice = parseFloat(response.item_price);
                        var itemTotal = itemPrice * currentQty;
                        $('td[data-item-id="' + cartId + '"]').text('₹' + itemTotal.toFixed(2));

                        // Update the overall total
                        var total = 0;
                        $('.item-total').each(function() {
                            total += parseFloat($(this).text().replace('₹', '').replace(',', ''));
                        });
                        $('#total').text('₹' + total.toFixed(2));
                    } else {
                        alert('Failed to update quantity.');
                    }
                },
                error: function() {
                    alert('Something went wrong');
                }
            });
        });
    });
</script>
