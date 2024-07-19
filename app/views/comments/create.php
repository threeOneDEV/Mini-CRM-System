<form action="<?= $_SERVER['REQUEST_URI'] ?>/store/<?= $_SESSION['id'] ?>/<?= $contact['id'] ?>" method="POST">
    <div class="form-comment">
        <label for="comment" class="form-label">Comment</label>
        <div class="input-group">
            <textarea class="form-control" name="description" placeholder="Enter your comment" autocomplete="FALSE"></textarea>
            <button class="btn btn-primary" type="submit" name="button_submit_comment">Submit</button>
        </div>
    </div>
</form>