<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/profile/update/<?= $_SESSION['id'] ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_login" class="form-label">New login</label>
                        <input type="text" class="form-control" name="login">
                    </div>
                    <div class="mb-3">
                        <label for="new_email" class="form-label">New email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="previous_password" class="form-label">Previous password</label>
                        <input type="password" class="form-control" name="previous_password">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" name="confirm_password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="button_edit_profile_info">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>