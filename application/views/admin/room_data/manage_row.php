<div class="d-flex  justify-content-center align-items-center gap-2 ">
            <button data-r-id="<?= $row['r_id']?>"  class="btn btn-success btn-action view-reserved-button">
            <i class="bi bi-search"></i>
            </button>

            <a href="<?= base_url("index.php/admin/edit/room/$url/". $row['r_id'] ) ?>" class="btn btn-primary">
            <i class="bi bi-gear"></i>
            </a>

            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['r_id']; ?>">

                <button type="button" class="btn btn-danger btn-action delete-button"
                    data-r-id="<?= $row['r_id']; ?>"  ><i class="bi bi-x-square"></i></button>
            </div>
        </div>



