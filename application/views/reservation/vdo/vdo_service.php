<!-- room style sheet -->
<link rel="stylesheet" href="<?= base_url('public/assets/css/card_room.css') ?>?v=<?= time(); ?>">
<!-- room style sheet -->

<style>
     
</style>
<?php
    // $data = [
    //     ['r_id'=>1,'r_number'=>1,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>1,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
    //     elit. Doloribus.'],
    //     ['r_id'=>3,'r_number'=>2,'r_status'=>0,'r_desc'=> "" ,'r_reserved' =>0,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
    //     elit. Doloribus.'],
    //     ['r_id'=>2,'r_number'=>3,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>0,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
    //     elit. Doloribus.'],
       
      
        
    // ];
    // $rooms = [];

if(!empty($services)){ ?>

<section id="main" class="container">
    <div class="row justify-content-center">
    <?= $this->load->view('component/title_room',[],true) ?>
                <?php foreach ($services as $service): ?>
                <div class="col-12 col-sm-6 pb-4 col-md-5 col-lg-3">
                    <?= $this->load->view('component/vdo/card_vdo', [
                        'service' => $service,
                       
                    ],true) ?>
                </div>
                <?php endforeach ?>
                <?php 
                        $n = count($services);
                        $i = $n % 2;
                        if ($n !== 1 && $i !== 0 ){
                            echo $this->load->view('room_template',[],true);
                             }; ?>
            
    </div>
</section>
<script>
    // Reload the page every 60,000 milliseconds (1 minute)
    setInterval(() => {
        location.reload();
    }, 400000);
</script>
<?php }else{
    
    echo $this->load->view('component/vdo/service_notFound',[],true);
 } ?>

