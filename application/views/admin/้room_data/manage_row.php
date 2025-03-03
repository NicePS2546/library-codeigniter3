<div class="d-flex  justify-content-center align-items-center gap-2 ">
            <button data-r-id="<?= $row['r_id']?>" data-reserved-id="<?= $row['reserv_id']?>" class="btn btn-success btn-action view-reserved-button">
            <i class="bi bi-search"></i>
            </button>

            <a href="<?= base_url("index.php/admin/edit/reserv/$url/". $row['reserv_id'] ) ?>" class="btn btn-primary">
            <i class="bi bi-gear"></i>
            </a>

            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['reserv_id']; ?>">

                <button type="button" class="btn btn-secondary btn-action delete-button"
                    data-user-id="<?= $row['reserv_id']; ?>"  data-user-fullname="<?= $row['fullname']; ?> "><i class="bi bi-x-square"></i></button>
            </div>
        </div>



