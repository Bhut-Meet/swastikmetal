<!-- product_details.php -->
<div class="container mt-5">
    <div class="row">
        <!-- Product Image & Info -->
        <div class="col-md-6">
            <img src="<?= base_url('uploads/products/' . $product->main_image) ?>" class="img-fluid rounded shadow">
        </div>

        <div class="col-md-6">
            <h2><?= $product->name ?></h2>
            <p><?= $product->description ?></p>
            <h4>₹<?= $product->discount_price ?> 
                <small><del class="text-danger">₹<?= $product->price ?></del></small>
            </h4>

            <div class="my-3">
                <label><strong>Size:</strong></label>
                <select class="form-select w-50" id="product-size">
                    <?php foreach (explode(',', $product->size) as $size): ?>
                        <option value="<?= trim($size) ?>"><?= trim($size) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label><strong>Quantity:</strong></label>
                <input type="number" id="product-qty" value="1" min="1" class="form-control w-25">
            </div>

            <button class="btn btn-success" onclick="addToCart()">🛒 Add to Cart</button>
        </div>
    </div>
</div>

<!-- SweetAlert2 & jQuery -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function addToCart() {
    const product_id = <?= $product->id ?>;
    const size = $('#product-size').val();
    const qty = $('#product-qty').val();

    $.ajax({
        url: '<?= base_url("cart/add") ?>',
        method: 'POST',
        data: {
            product_id: product_id,
            size: size,
            qty: qty
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Product added to cart!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '<?= base_url("cart") ?>';
                });
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function() {
            Swal.fire('AJAX Error', 'Something went wrong', 'error');
        }
    });
}
</script>

