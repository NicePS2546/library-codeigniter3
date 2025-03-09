<div class="card card-shadow text-center ani-element mx-auto mt-2">
    <img class="card-img-top" src="<?= base_url('public/assets/img/room_img/').$room['r_img'] ?>" alt="image room no.<?= $room['r_number'] ?>">
    <div class="card-body">
        <h5 class="card-title">ห้องที่ <?= $room['r_number']; ?></h5>

        <?php
        $room_dynamic = $page == "vdo" ? "service" : "reserv";        
        if ($room['r_status']) : ?>
            <p class="card-text <?= $room['isFree'] ? 'text-danger' : 'text-success' ?>">สถานะ: <?= $room['isFree'] ? 'ไม่ว่าง' : 'ว่าง' ?></p>

            <?php if ($room['isFree']) : 
                    if(!empty($exp_time)):
                ?>
                <p class="card-text text-success">เวลาที่สามารถจองได้: <?= $exp_time; ?> น.</p>
                <?php else : ?>
                <p class="card-text text-danger">ไม่เหลือช่วงเวลาให้จองแล้ว</p>
                <?php endif; ?>
            <?php else : ?>
                <p class="card-text"><?= $desc ?></p>
            <?php endif; ?>

        <?php else : ?>
            <p class="card-text"><?= $room['r_close_desc'] ?></p>
        <?php endif; ?>

        <div class="d-flex justify-content-center gap-3">
            <a href="<?= base_url() ?>index.php/<?= $url ?>/<?= $room_dynamic ?>/<?= $room['r_id'] ?>" id="card" class="btn <?= $room['r_status'] ? 'btn-success' : 'btn-danger disabled' ?>">
                <?= $room['r_status'] ? 'จองห้อง' : 'ห้องถูกปิด' ?>
            </a>
            
            <?php if ($room['r_status']) : ?>
                <a href="<?= base_url() ?>index.php/<?= $url ?>/check/<?= $room['r_id'] ?>" id="card" class="btn <?= $room['r_status'] ? 'btn-primary' : 'btn-danger' ?>">ตรวจสอบ</a>
            <?php endif; ?>
        </div>
    </div>
</div>
