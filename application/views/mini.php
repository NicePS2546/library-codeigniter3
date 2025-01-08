<!-- room style sheet -->
<link rel="stylesheet" href="<?= base_url('public/assets/css/card_room.css') ?>">
<!-- room style sheet -->

<?php
    $data = [
        ['r_id'=>1,'r_number'=>1,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>0,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
        elit. Doloribus.'],
       
       
      
        
    ];
    $rooms = $data;


if(!empty($rooms)){  ?>
<section id="main" class="container">
    <div class="row justify-content-center">
      <?= $this->load->view('component/title_room') ?>
                <?php foreach ($rooms as $room): ?>
                    <div class="col-12 col-sm-6 pb-4 col-md-4 col-lg-5">
                    <div class="card card-shadow text-center mx-auto mt-2">
    <img class="card-img-top" src="<?= base_url() ?>/assets/img/room/15723436962.jpg"
        alt="image room no.<?= $room['r_number'] ?> ">
    <div class="card-body">
        <h5 class="card-title">ห้องที่ <?= $room['r_number']; ?></h5>
        <?php if ($room['r_status']) { ?>
                <p class="card-text <?= $room['r_reserved'] ? "text-danger" : "text-success" ?>">สถานะ:
                    <?= $room['r_reserved'] ? "ไม่ว่าง" : "ว่าง" ?></p>
            
        <?php } else { ?>
            <p class="card-text"><?= $room['close_desc'] ?></p>
        <?php } ?>
        <div class="d-flex justify-content-center gap-3">
            <a href="<?= base_url() ?>mini/reserv/<?= $room['r_id'] ?>"
                class="btn  <?= $room['r_status'] == true ? "btn-success" : "btn-danger disabled" ?>"><?= $room['r_status'] == true ? "ลงทะเบียน" : "ห้องถูกปิด" ?></a>
            
        </div>
    </div>
</div>
                </div>
                <?php endforeach ?>
                <?php 
                        $n = count($rooms);
                        $i = $n % 2;
                        if ($n !== 1 && $i !== 0 ){

                            echo $this->load->view('room_template');                      
                  }; ?>
            
    </div>
</section>

<?php }else{ echo $this->load->view('room_notFound'); } ?>