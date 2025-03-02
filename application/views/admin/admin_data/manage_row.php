<?php

?>

<div class="d-flex  justify-content-center align-items-center gap-2 ">
            <button href="<?= base_url("index.php/admin/edit/admin_data/". $row['user_id'] ) ?>" class="btn custom-btn btn-primary">
                แก้ไข
            </button>

            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['reserv_id']; ?>">
                <button type="button" class="btn  <?= $row['admin_status'] == 1 ? 'btn-secondary' : 'btn-success' ?> custom-btn delete-button"
                    data-user-id="<?= $row['user_id']; ?>" data-status="<?= $row['admin_status'] ?>"  data-user-fullname="<?= $row['fullname']; ?>"><?= $row['admin_status'] == 1 ? 'ปิดการใช้งาน' : 'เปิดการใช้งาน' ?></button>
            </div>
        </div>



