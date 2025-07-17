<!-- room style sheet -->
<link rel="stylesheet" href="<?= base_url('public/assets/css/card_room.css') ?>?v=<?= time(); ?>">
<!-- room style sheet -->

<?php


if (!empty($rooms)) {
    ?>
    <section id="main" class="container">
        <div class="row justify-content-center">
            <?= $this->load->view('component/title_room', [], true) ?>
            <?php

            $date = date("Y-m-d");


            foreach ($rooms as $room):
                
                $row = $model->get_reserved_slots($date, $room['r_id']);
                // print_r($row);
                $room['isFree'] = $model->get_reserv_in_Time_range($room['r_id']);
                $closest = $model->get_closest_time($room['r_id']);
                list($closestStartTime, $closestEndTime) = explode('-', $closest);
                ?>
                <div class="col-12 col-sm-6 pb-4 col-md-5 col-lg-5">
                    <?= $this->load->view('component/mini/card_room', [
                        'room' => $room,
                        'url' => "mini",
                        'desc' => $room['r_desc'],
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






