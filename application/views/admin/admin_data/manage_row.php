<?php

?>

<div class="d-flex  justify-content-center align-items-center gap-2 ">
            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['reserv_id']; ?>">
                <button type="button" class="btn  <?= $row['admin_status'] == 1 ? 'btn-secondary' : 'btn-success' ?> custom-btn delete-button"
                    data-user-id="<?= $row['user_id']; ?>" data-status="<?= $row['admin_status'] ?>"  data-user-fullname="<?= $row['fullname']; ?>"><?= $row['admin_status'] == 1 ? 'ปิดการใช้งาน' : 'เปิดการใช้งาน' ?></button>
            </div>
        </div>



