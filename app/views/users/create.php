<div class="col-lg-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Add User
        </div>
        <div class="card-body">
            <form id="userForm" method="post" action="/users/store">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input name="login" type="text" class="form-control" id="login" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="conform_password" class="form-label">Confirm password</label>
                    <input name="confirm_password" type="password" class="form-control" id="confirm_password" required>
                </div>
                <div class="mb-3">
                    <label for="is_admin" class="form-label">Role</label>
                    <select name = "is_admin" class="form-select" id="is_admin" required>
                        <option value="0">Manager</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <button name="button_add_user" type="submit" class="btn btn-primary w-100">Add User</button>
                <p style="color: red"><?= $errorMessage ?></p>
            </form>
        </div>
    </div>
</div>