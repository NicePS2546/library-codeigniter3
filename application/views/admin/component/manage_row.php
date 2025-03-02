<div class="d-flex  justify-content-center align-items-center gap-2">
            <form action="<?= base_url() ?>" method="post">
                <input type="hidden" name="id" value="<?= $row['reserv_id']; ?>">
                <button type="submit" class="btn btn-primary">แก้ไข</button>
            </form>
            <div style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['reserv_id']; ?>">

                <button type="button" class="btn btn-secondary delete-button"
                    data-user-id="<?= $row['reserv_id']; ?>"  data-user-fullname="<?= $row['fullname']; ?>">ปิด</button>
            </div>
        </div>