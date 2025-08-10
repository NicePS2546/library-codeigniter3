<div class="d-flex  justify-content-center align-items-center gap-2 ">
            <!-- <button class="btn btn-primary" data-h-date = "<?= $row['date'] ?>">
            <i class="bi bi-gear"></i>
            </button> -->

            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['reserv_id']; ?>">

                <button type="button" class="btn btn-danger btn-action delete-button"
                    data-date="<?= $row['date']; ?>" data-title="<?= $row['title'] ?>"><i class="bi bi-x-square delete-button"  data-date="<?= $row['date']; ?>" data-title="<?= $row['title'] ?>"></i></button>
            </div>
        </div>



