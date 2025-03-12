<div class="d-flex  justify-content-center align-items-center gap-2 ">
            

            <a href="<?= base_url("index.php/admin/room/edit/$table/". $row['r_id'] ) ?>" class="btn btn-primary">
            <i class="bi bi-gear"></i>
            </a>

            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['r_id']; ?>">

                <button type="button" class="btn btn-danger btn-action delete-button"
                    data-r-id="<?= $row['r_id']; ?>"  ><i class="bi bi-x-square"></i></button>
            </div>
        </div>



