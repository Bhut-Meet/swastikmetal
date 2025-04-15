<?php foreach ($products as $product): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="<?= base_url('uploads/products/thumb/' . $product->main_image) ?>" class="card-img-top" alt="<?= $product->name ?>">
            <div class="card-body text-center">
                <h6><?= $product->name ?></h6>
                <p class="text-muted"><del>₹<?= $product->price ?></del></p>
                <p class="text-danger">₹<?= $product->discount_price ?></p>
                <p>Size: <?= $product->size ?></p>
                <a href="<?= base_url('product/details/' . $product->id) ?>" class="btn btn-sm btn-primary">View</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
