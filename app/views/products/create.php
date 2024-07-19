<div class="col-lg-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Add Product
        </div>
        <div class="card-body">
            <form id="productForm" method="post" action="/products/store">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" type="text" class="form-control" id="title" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input name="price" type="number" class="form-control" id="price" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="button_add_product">Add product</button>
            </form>
        </div>
    </div>
</div>