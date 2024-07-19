<div class="col-lg-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Add Contact
        </div>
        <div class="card-body">
            <form id="contactForm" method="POST" action="/contacts/store/<?=$_SESSION['id']?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name = "name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name = "email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name = "phone" required>
                </div>
                
                <?php if($_SESSION['is_admin']): ?>
                    <div class="mb-3">
                        <label for="users_id" class="form-label">Manager</label>
                        <select class="form-select" id="users_id" name="users_id">

                            <?php
                            foreach($users as $user):
                                if(!$user['is_admin']):
                                    echo "<option value=\"{$user['id']}\">{$user['login']}</option>";
                                endif;
                            endforeach
                            ?>

                        </select>
                    </div>
                <?php endif ?>

                <button type="submit" class="btn btn-primary w-100" name = "button_add_contact">Add Contact</button>
                <p style="color: red"><?= $errorMessage ?></p>
            </form>
        </div>
    </div>
</div>