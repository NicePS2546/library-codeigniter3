<div class="d-flex  justify-content-center align-items-center gap-2 ">
            <button data-r-id="<?= $row['r_id']?>" data-table="<?= $table ?>"  class="btn btn-success btn-action view-room-button">
            <i class="bi bi-search"></i>
            </button>

            <a href="<?= base_url("index.php/admin/room/edit/$table/". $row['r_id'] ) ?>" class="btn btn-primary">
            <i class="bi bi-gear"></i>
            </a>

            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['r_id']; ?>">

                <button type="button" class="btn btn-danger btn-action delete-button"
                    data-r-id="<?= $row['r_id']; ?>"  ><i data-r-id="<?= $row['r_id']; ?>" class="bi delete-button bi-x-square"></i></button> 
            </div>
        </div>



