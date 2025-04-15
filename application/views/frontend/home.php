

<div class="container mt-4">
    <h3 class="mb-3">Latest Products</h3>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= base_url('uploads/products/' . $product->main_image) ?>" class="card-img-top" alt="<?= $product->name ?>" height="220">
                    <div class="card-body text-center">
                        <h6><?= $product->name ?></h6>
                        <p class="text-muted"><del>₹<?= $product->price ?></del></p>
                        <p class="text-danger fw-bold">₹<?= $product->discount_price ?></p>
                        <p class="text-secondary">Size: <?= $product->size ?></p>
                        <a href="<?= base_url('product/details/' . $product->id) ?>" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
