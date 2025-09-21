<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?php echo isset($product_data) ? 'Edit Product' : 'Add Product'; ?></h5>
                </div>
                <div class="card-body">
                    <form name="product_form" action="<?php echo site_url('Product/save_product'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">

                        <input type="hidden" id="hdn_productid" name="hdn_productid" class="form-control" value="<?php echo isset($product_data['id']) ? $product_data['id'] : ''; ?>">

                        <div class="row g-3">
                            <!-- Basic Information -->
                            <div class="col-md-4">
                                <label class="form-label" for="code">Product Code <span class="text-danger">*</span></label>
                                <input type="text" id="code" name="code" class="form-control" placeholder="Product Code"
                                       value="<?php echo isset($product_data['code']) ? $product_data['code'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="name">Product Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Product Name"
                                       value="<?php echo isset($product_data['name']) ? $product_data['name'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="brand_id">Brand <span class="text-danger">*</span></label>
                                <select id="brand_id" name="brand_id" class="form-select" required>
                                    <option value="">--Select Brand--</option>
                                    <?php if(isset($brand_data)) foreach ($brand_data as $brand) { ?>
                                        <option value="<?php echo $brand->id; ?>"
                                                <?php echo (isset($product_data['brand_id']) && $product_data['brand_id'] == $brand->id) ? 'selected' : ''; ?>>
                                            <?php echo $brand->name; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="category_id">Category <span class="text-danger">*</span></label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">--Select Category--</option>
                                    <?php if(isset($category_data)) foreach ($category_data as $category) { ?>
                                        <option value="<?php echo $category->id; ?>"
                                                <?php echo (isset($product_data['category_id']) && $product_data['category_id'] == $category->id) ? 'selected' : ''; ?>>
                                            <?php echo $category->name; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Additional Details -->
                            <div class="col-md-4">
                                <label class="form-label" for="rate">Purchase Price <span class="text-danger">*</span></label>
                                <input type="number" id="rate" name="purchase_price" class="form-control" placeholder="Purchase Price" step="0.01" min="0"
                                       value="<?php echo isset($product_data['purchase_price']) ? $product_data['purchase_price'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="sales_price">Sales Price <span class="text-danger">*</span></label>
                                <input type="number" id="sales_price" name="sales_price" class="form-control" placeholder="Sales Price" step="0.01" min="0"
                                       value="<?php echo isset($product_data['sales_price']) ? $product_data['sales_price'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="stock">Stock Quantity</label>
                                <input type="number" id="stock" name="stock" class="form-control" placeholder="Stock" min="0"
                                       value="<?php echo isset($product_data['stock']) ? $product_data['stock'] : '0'; ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="min_order_qty">Minimum Order Qty</label>
                                <input type="number" id="min_order_qty" name="min_order_qty" class="form-control" placeholder="Min Order Qty" min="0"
                                       value="<?php echo isset($product_data['min_order_qty']) ? $product_data['min_order_qty'] : '1'; ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="hsn_sac_code">HSN/SAC Code</label>
                                <input type="text" id="hsn_sac_code" name="hsn_sac_code" class="form-control" placeholder="HSN/SAC Code"
                                       value="<?php echo isset($product_data['hsn_sac_code']) ? $product_data['hsn_sac_code'] : ''; ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="product_type">Product Type</label>
                                <select id="product_type" name="product_type" class="form-select">
                                    <option value="SALES" <?php echo (isset($product_data['product_type']) && $product_data['product_type'] == 'SALES') ? 'selected' : ''; ?>>Sales</option>
                                    <option value="PURCHASE" <?php echo (isset($product_data['product_type']) && $product_data['product_type'] == 'PURCHASE') ? 'selected' : ''; ?>>Purchase</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="status">Status</label>
                                <select id="status" name="status" class="form-select">
                                    <option value="ACTIVE" <?php echo (isset($product_data['status']) && $product_data['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                    <option value="INACTIVE" <?php echo (isset($product_data['status']) && $product_data['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label class="form-label" for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                          placeholder="Product description"><?php echo isset($product_data['description']) ? $product_data['description'] : ''; ?></textarea>
                            </div>

                            <!-- File Upload -->
                            <div class="col-md-12">
                                <label class="form-label" for="product_image">Product Image</label>
                                <input type="file" id="product_image" name="product_image" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF. Max size: 2MB</small>
                                <?php if(isset($product_data['image']) && !empty($product_data['image'])): ?>
                                    <div class="mt-2">
                                        <img src="<?php echo base_url('public/uploads/products/' . $product_data['image']); ?>" class="img-thumbnail" width="100" alt="Current Image">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end">
                            <a href="<?php echo site_url('Product'); ?>" class="btn btn-label-secondary me-2">
                                <i class="ti ti-arrow-left me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i><?php echo isset($product_data) ? 'Update Product' : 'Save Product'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>