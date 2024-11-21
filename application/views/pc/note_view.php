<!-- views/note_view.php -->
<div class="card h-100">
    <div class="card-header">
        <h5 class="mb-0">Note</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('SystemInfoController/save_note') ?>" method="post">
            <textarea class="form-control" name="note" rows="5" placeholder="Write your notes here..."></textarea>
            <button type="submit" class="btn btn-primary mt-3 w-100">Save</button>
        </form>
    </div>
</div>