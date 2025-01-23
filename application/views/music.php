<!-- room style sheet -->
<link rel="stylesheet" href="<?= base_url('public/assets/css/card_room.css') ?>?v=<?= time(); ?>">
<!-- room style sheet -->

<?php

// $data = [
//     ['r_id'=>1,'r_number'=>1,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>1,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
//                 elit. Doloribus.'],
//     ['r_id'=>2,'r_number'=>2,'r_status'=>0,'r_desc'=> "" ,'r_reserved' =>0,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
//     elit. Doloribus.'],
//     ['r_id'=>3,'r_number'=>3,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>1,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
//     elit. Doloribus.'],
//     ['r_id'=>4,'r_number'=>4,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>0,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
//     elit. Doloribus.'],
//     ['r_id'=>5,'r_number'=>5,'r_status'=>1,'r_desc'=> "" ,'r_reserved' =>2,'end_time'=>'14:30:33','close_desc'=>'ห้องถูกปิดเนื่องจากต้องซ่อมดูแล.... Lorem ipsum dolor sit amet consectetur adipisicing
//     elit. Doloribus.'],

// ];
//     $rooms = $data;

if (!empty($rooms)) { ?>
    <section id="main" class="container">
        <div class="row justify-content-center">
            <?= $this->load->view('component/title_room', [], true) ?>
            <?php

            $date = date("Y-m-d");


            foreach ($rooms as $room):
                $row = $model->get_reserved_slots($date, $room['r_id']);
                $room['isFree'] = $model->get_reserv_in_Time_range($room['r_id']);
                $closest = $model->get_closest_time($room['r_id']);
                list($closestStartTime, $closestEndTime) = explode('-', $closest);
                ?>
                <div class="col-12 col-sm-6 pb-4 col-md-5 col-lg-5">
                    <?= $this->load->view('component/card_room', [
                        'room' => $room,
                        'url' => "music",
                        'desc' => 'ลงทะเบียนตั้งแต่ 4-7 คน',
                        'exp_time' => $closestStartTime
                    ], true) ?>
                </div>
            <?php endforeach ?>
            <?php

            $n = count($rooms);
            $i = $n % 2;
            if ($n !== 1 && $i !== 0) {

                echo $this->load->view('room_template', [], true);
            }
            ; ?>

        </div>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        setInterval(() => {
        const elements = document.querySelectorAll('.ani-element');
        elements.forEach((el, index) => {
          // Delay each element by a factor of its index (300ms = 0.3 second per element)
          setTimeout(() => {
            
            
            el.classList.add('visible','animate__animated', 'animate__fadeInUp');
          }, index * 300); // The delay increases for each element
        });
      }, 500);
    });
       
        // Reload the page every 60,000 milliseconds (1 minute)
        setInterval(() => {
            location.reload();
        }, 60000);
    </script>
<?php } else {

    echo $this->load->view('room_notFound', [], true);

}

?>