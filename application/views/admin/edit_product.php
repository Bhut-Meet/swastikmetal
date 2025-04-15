<div class="container">
    <h2>Edit Product</h2>
    
    <?php echo form_open_multipart('admin/product/update/' . $product->id); ?>
    
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $product->name ?>" required>
    </div>
    
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= $product->description ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= $product->price ?>" required>
    </div>
    
    <div class="form-group">
        <label for="discount_price">Discount Price</label>
        <input type="number" class="form-control" id="discount_price" name="discount_price" value="<?= $product->discount_price ?>">
    </div>
    
    <div class="form-group">
        <label for="size">Size</label>
        <input type="text" class="form-control" id="size" name="size" value="<?= $product->size ?>">
    </div>
    
    <div class="form-group">
        <label for="main_image">Main Image</label>
        <input type="file" class="form-control" id="main_image" name="main_image">
    </div>
    
    <div class="form-group">
        <label for="additional_images">Additional Images</label>
        <input type="file" class="form-control" id="additional_images" name="additional_images[]" multiple>
    </div>
    
    <button type="submit" class="btn btn-success mt-3">Update Product</button>
    
    <?php echo form_close(); ?>
</div>
