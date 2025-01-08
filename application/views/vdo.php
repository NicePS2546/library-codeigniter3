<!-- room style sheet -->
<link rel="stylesheet" href="<?= base_url('public/assets/css/card_room.css') ?>">
<!-- room style sheet -->

<style>
     
</style>
<?php
    $data = [
        ['r_id'=>1,'r_number'=>1,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>1,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
        elit. Doloribus.'],
        ['r_id'=>3,'r_number'=>2,'r_status'=>0,'r_desc'=> "" ,'r_reserved' =>0,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
        elit. Doloribus.'],
        ['r_id'=>2,'r_number'=>3,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>0,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
        elit. Doloribus.'],
       
      
        
    ];
    $rooms = $data;

if(!empty($rooms)){ ?>

<section id="main" class="container">
    <div class="row justify-content-center">
    <?= $this->load->view('component/title_room') ?>
                <?php foreach ($rooms as $room): ?>
                <div class="col-12 col-sm-6 pb-4 col-md-4 col-lg-3">
                    <?= $this->load->view('component/card_room', [
                        'room' => $room,
                        'url'=>"vdo",
                        'desc' => 'ลงทะเบียนต้องแต่ 1-6 คน'
                    ]) ?>
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

<?php }else{
    
    echo $this->load->view('room_notFound');
 } ?>

