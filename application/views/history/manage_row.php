<div class="d-flex  justify-content-center align-items-center gap-2 ">

            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['reserv_id']; ?>">
            <?php if($table == 'current_history'): ?>
                <button type="button" class="btn btn-danger btn-action  <?= $table == 'old_history' ? 'delete-button-old' : 'delete-button-current' ?>"
                    data-reserv-id="<?= $row['reserv_id']; ?>" data-total-pp="<?= $row['total_pp'] ?>" data-s-id="<?= $row['r_s_id'] ?>"  data-user-fullname="<?= $row['fullname']; ?> "><i class="bi bi-x-square"></i></button>
                <?php endif ?>
            </div>
        </div>



