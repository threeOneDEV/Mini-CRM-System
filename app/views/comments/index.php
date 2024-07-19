<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom<?= $contact['id'] ?>" aria-labelledby="offcanvasBottomLabel" style="height: 40%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Submit comment (<?= $contact['name'] ?>)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between small">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 20%;">User</th>
                    <th style="width: 60%;">Description</th>
                    <th style="width: 20%;">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($comments as $comment): ?>
                    <?php if($comment['contacts_id'] == $contact['id']): ?>
                        <tr>
                            <td><?= $comment['user_login'] ?></td>
                            <td><?= $comment['description'] ?></td>
                            <td><?= $comment['date'] ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php include('create.php') ?>
    </div>
</div>