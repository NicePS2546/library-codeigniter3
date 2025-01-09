<div class="card card-shadow text-center mx-auto mt-2">
    <img class="card-img-top" src="<?= base_url() ?>/assets/img/room/15723436962.jpg" alt="image room no.<?= $room['r_number'] ?>">
    <div class="card-body">
        <h5 class="card-title">ห้องที่ <?= $room['r_number']; ?></h5>

        <?php if ($room['r_status']) : ?>
            <p class="card-text <?= $room['r_reserved'] ? 'text-danger' : 'text-success' ?>">สถานะ: <?= $room['r_reserved'] ? 'ไม่ว่าง' : 'ว่าง' ?></p>

            <?php if ($room['reserve_today']) : ?>
                <p class="card-text text-danger">สิ้นสุดประมาณ: <?= $room['end_time']; ?></p>
            <?php else : ?>
                <p class="card-text"><?= $desc ?></p>
            <?php endif; ?>

        <?php else : ?>
            <p class="card-text"><?= $room['r_close_desc'] ?></p>
        <?php endif; ?>

        <div class="d-flex justify-content-center gap-3">
            <a href="<?= base_url() ?>index.php/<?= $url ?>/reserv/<?= $room['r_number'] ?>" id="card" class="btn <?= $room['r_status'] ? 'btn-success' : 'btn-danger disabled' ?>">
                <?= $room['r_status'] ? 'จองห้อง' : 'ห้องถูกปิด' ?>
            </a>
            
            <?php if ($room['r_status']) : ?>
                <a href="<?= base_url() ?><?= $url ?>/reserv/check" id="card" class="btn <?= $room['r_status'] ? 'btn-primary' : 'btn-danger' ?>">ตรวจสอบ</a>
            <?php endif; ?>
        </div>
    </div>
</div>
