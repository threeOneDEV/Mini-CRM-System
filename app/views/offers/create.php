<div class="modal fade" id="staticBackdropMakeOffer<?= $contact['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Make offer (<?= $contact['name'] ?>)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/offers/store/<?= $contact['users_id'] ?>/<?= $contact['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product" class="form-label">Product</label>
                        <select name="product" class="form-select" aria-label="Default select example">
                            <?php 
                            foreach($products as $product){
        
                            echo "<option value=\"{$product['id']}\">{$product['title']} - {$product['price']}р.</option>";

                            } 
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <select name="discount" class="form-select" aria-label="Default select example">
                            <option value="">Without discount</option>
                            <option value="5">5%</option>
                            <option value="10">10%</option>
                            <option value="15">15%</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="button_make_offer">Make offer</button>
                </div>
            </form>
        </div>
    </div>
</div>