<div class="d-flex  justify-content-center align-items-center gap-2 ">
            <button data-r-id="<?= $row['r_id']?>" data-r-table="<?= $row['r_s_id'] == 1 ? 'music' : $row['r_s_id'] == 2 ? 'vdo' :'mini'  ?>" data-reserved-id="<?= $row['reserv_id']?>" class="btn btn-success btn-action view-expire-button">
            <i class="bi bi-search"></i>
            </button>


            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['reserv_id']; ?>">

                <button type="button" class="btn btn-secondary btn-action delete-button"
                    data-user-id="<?= $row['reserv_id']; ?>"  data-user-fullname="<?= $row['fullname']; ?> "><i class="bi bi-x-square"></i></button>
            </div>
        </div>



