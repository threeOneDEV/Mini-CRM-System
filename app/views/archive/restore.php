<div class="modal fade" id="staticBackdropRestoreContact<?= $contact['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Restore contact (<?= $contact['name'] ?>)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/archive/update/<?= $contact['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="users_id" class="form-label">Manager</label>
                        <select name="users_id" class="form-select" aria-label="Default select example">
                            <?php 
                            foreach($users as $user){

                                if(!$user['is_admin'] && !$user['soft_delete']){

                                    echo "<option value=\"{$user['id']}\">{$user['login']}</option>";

                                }

                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="button_restore_contact">Restore</button>
                </div>
            </form>
        </div>
    </div>
</div>