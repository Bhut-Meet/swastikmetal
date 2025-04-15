<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>All Products</h3>
        <a href="<?= base_url('admin/product/add') ?>" class="btn btn-primary">+ Add Product</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><img src="<?= base_url('uploads/products/' . $p->main_image) ?>" height="50"></td>
                    <td><?= $p->name ?></td>
                    <td>₹<?= $p->price ?></td>
                    <td>₹<?= $p->discount_price ?></td>
                    <td><?= $p->size ?></td>
                    <td>
                        <a href="<?= base_url('admin/product/edit/' . $p->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('admin/product/delete/' . $p->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
