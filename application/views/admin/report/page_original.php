<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];

$nf = $statistic['nf_stats'];
$disney = $statistic['disney_stats'];
$streaming = $statistic['streaming'];

// echo "<pre>";
// print_r($music);
// echo "</pre>";
// exit();
$music_t_p = 0;
$music_rs = 0;

$vdo_t_p = 0;
$vdo_rs = 0;

$mini_t_p = 0;
$mini_rs = 0;

$nf_t_p = 0;
$nf_rs = 0;

$disney_t_p = 0;
$disney_rs = 0;

$streaming_t_p = 0;
$streaming_rs = 0;

// Create an array of Thai month and day names
$thai_days = [
    'Sunday' => 'อาทิตย์',
    'Monday' => 'จันทร์',
    'Tuesday' => 'อังคาร',
    'Wednesday' => 'พุธ',
    'Thursday' => 'พฤหัสบดี',
    'Friday' => 'ศุกร์',
    'Saturday' => 'เสาร์'
];
$thai_months = [
    1 => 'มกราคม',
    2 => 'กุมภาพันธ์',
    3 => 'มีนาคม',
    4 => 'เมษายน',
    5 => 'พฤษภาคม',
    6 => 'มิถุนายน',
    7 => 'กรกฎาคม',
    8 => 'สิงหาคม',
    9 => 'กันยายน',
    10 => 'ตุลาคม',
    11 => 'พฤศจิกายน',
    12 => 'ธันวาคม'
];
// Convert the date string into a timestamp
$start_date_val = $start_date;
$end_date_val = $end_date;
$get_start_date = strtotime($start_date);
$get_end_date = strtotime($end_date);

$start_date = [
    'day_name' => $thai_days[date('l', $get_start_date)],
    'day_nums' => date('d', $get_start_date),
    'month_name' => $thai_months[(int) date('m', $get_start_date)],
    'year' => date('Y', $get_start_date)
];

$end_date = [
    'day_name' => $thai_days[date('l', $get_end_date)],
    'day_nums' => date('d', $get_end_date),
    'month_name' => $thai_months[(int) date('m', $get_end_date)],
    'year' => date('Y', $get_end_date)
];
// format year christ to buddist
$ps_start_year = $start_date['year'] + 543;
$ps_end_year = $end_date['year'] + 543;

// Combine the formatted date
$formatted_start_date = $start_date['day_name'] . " ที่ " . $start_date['day_nums'] . " " . $start_date['month_name'] . " พ.ศ." . $ps_start_year;
$formatted_end_date = $end_date['day_name'] . " ที่ " . $end_date['day_nums'] . " " . $end_date['month_name'] . " พ.ศ." . $ps_end_year;

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
    .search-content {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        width: 300px;
    }

    .fixed-height {
        min-height: 100vh;
    }

    .chart-container {
        display: flex;
        justify-content: center;
    }

    @media (min-width: 992px) {

        /* Large devices (lg) and up */
        .col-lg-5 {
            flex: 0 0 35% !important;
            max-width: 35% !important;
        }


    }

    @media (min-width: 992px) and (max-width: 1199px) {
        .col-lg-3 {
            flex: 0 0 50%;
            /* 50% width for 2 cards in a row */
            max-width: 50%;
        }
    }
</style>
<meta charset="UTF-8">
<?php $card_res = "col-12 col-sm-6 col-md-6 col-lg-3"; ?>

<div class="col-md-12">
    <div class="info-box">
        <div method="post" class="info-box-content  title-container">
            <span class="info-box-text font-title">ข้อมูลถิติการเข้าใช้บริการ</span>
            <!-- <div class="search-content">
                <input name="day" class="form-control w-75 flatpickrDay" value="<?= $day ?>" type="date">
                <input name="year" class="form-control w-75" type="hidden">
            
            </div> -->
            <button class="btn my-auto btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal"
                style="width:120px">ค้นหาข้อมูล</button>


        </div>
    </div>

    <div class="col-md-12">
        <div class="info-box">
            <div class="info-box-content">

                <?php if ($statistic): ?>
                    <?php
                    foreach ($music as $stat) {
                        $music_t_p += (int) $stat['total_people'];
                        $music_rs += (int) $stat['reservation_count'];
                    }

                    foreach ($vdo as $stat) {
                        $vdo_t_p += (int) $stat['total_people'];
                        $vdo_rs += (int) $stat['reservation_count'];
                    }

                    foreach ($mini as $stat) {
                        $mini_t_p += (int) $stat['total_people'];
                        $mini_rs += (int) $stat['reservation_count'];
                    }

                    foreach ($nf as $stat){
                         $nf_t_p += (int) $stat['total_people'];
                        $nf_rs += (int) $stat['reservation_count'];
                    }

                    foreach ($disney as $stat){
                         $disney_t_p += (int) $stat['total_people'];
                        $disney_rs += (int) $stat['reservation_count'];
                    }

                    foreach ($streaming as $stat){
                         $streaming_t_p += (int) $stat['total_people'];
                        $streaming_rs += (int) $stat['reservation_count'];
                    }
                    ?>



                    <!-- <pre>
                        <?= var_dump($vdo) ?>
                      
                       </pre> -->
                    <h5 class="text-center mt-3 mb-3">จากวันที่ <?= $formatted_start_date ?> ถึงวันที่
                        <?= $formatted_end_date ?>
                    </h5>
                    <div class="d-flex" style=" flex-direction: column; justify-content: center; align-items: center;">
                        <div class="col-md-4 mb-4 text-center">
                            <h2>Music-Relax</h2>
                            <h5>จำนวนผู้เข้าใช้บริการทั้งหมด: <?= $music_t_p ?> คน</h5>
                            <h5>จำนวนการจองทั้งหมด: <?= $music_rs ?> ครั้ง</h5>
                            
                     
                           
                        </div>

                        <div class="col-md-4 mb-4 text-center">
                            <h2>Video On-Demand</h2>
                            <h5>จำนวนผู้เข้าใช้บริการทั้งหมด: <?= $vdo_t_p ?> คน</h5>
                            <h5>จำนวนการจองทั้งหมด: <?= $vdo_rs ?> ครั้ง</h5>
                            <h5 class="mt-2">จำนวนผู้ใช้บริการ Disney: <?= $disney_t_p ?> คน</h5>
                            <h5 class="">จำนวนการจอง Disney: <?= $disney_rs ?> ครั้ง</h5>

                            <h5 class="mt-2">จำนวนผู้ใช้บริการ Netflix: <?= $nf_t_p ?> คน</h5>
                            <h5 class="mt-2">จำนวนการจอง Netflix: <?= $nf_rs ?> ครั้ง</h5>

                            <h5 class="mt-2">จำนวนผู้ใช้บริการ Streaming: <?= $streaming_t_p ?> คน</h5>
                            <h5 class="mt-2">จำนวนการจอง Streaming: <?= $streaming_rs ?> ครั้ง</h5>
                        </div>

                        <!-- <div class="col-md-4 mb-4 text-center">
                            <h2>Mini-Theater</h2>
                            <h5>จำนวนผู้เข้าใช้บริการทั้งหมด: <?= $mini_t_p ?> คน</h5>
                            <h5>จำนวนการจองทั้งหมด: <?= $mini_rs ?> ครั้ง</h5>
                        </div> -->
                    </div>
                <?php else: ?>
                    <h4 class="text-center">ไม่มีข้อมูลให้รายงานในขณะนี้</h4>
                    
                    
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="info-box">
            <div class="info-box-content  title-container">
                <span class="info-box-text font-title">กราฟสถิติจำนวนผู้เข้าใช้งาน</span>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="info-box">
            <div class="info-box-content">
                <?php if ($statistic): ?>
                    <div class="chart-container "
                        style="position: relative; height:60vh; width:80vw; padding-top: 20px; padding-bottom: 20px;">
                        <canvas id="chart-day"></canvas>
                    </div>
                <?php else: ?>
                    <h4 class="text-center">ไม่กราฟให้แสดงในขณะนี้</h4>
                <?php endif ?>



            </div>
        </div>
    </div>

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="post" id="modal-form" action="<?= base_url() ?>index.php/admin/statistic/report"
            onsubmit="return find_data(event)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ค้นหาข้อมูล</h5>
                    </div>
                    <div class="modal-body  d-flex justify-content-center">
                        <div class="col-10 col-sm-10 pb-4 col-md-10 col-lg-10 text-start">
                            <div class="d-flex gap-4">
                                <div class="col-lg-6 position-relative" style="z-index: 2;">
                                    <label for="start_date">จากวันที่</label>
                                    <div class="input-group mt-2">
                                        <input name="start_date" id="start_date" class="form-control w-75 "
                                            value="<?= $start_date_val ? $start_date_val : date('Y-m-d') ?>"
                                            type="text">

                                    </div>
                                </div>

                                <div class="col-lg-6 position-relative" style="z-index: 1;">
                                    <label for="end_date">ถึงวันที่</label>
                                    <div class="input-group mt-2">
                                        <input name="end_date" id="end_date" class="form-control w-75 "
                                            value="<?= $end_date_val ? $end_date_val : date('Y-m-d') ?>" type="text">

                                    </div>

                                </div>
                            </div>


                            <!-- <div id="results" class="mt-3">
                          
                        </div> -->
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="modal" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" id="modal">ค้นหา</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Load jQuery First -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr">
    </script><script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>
    <script src="<?= base_url('public/cdn/chart/js/chart.js') ?>"></script>
    
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const reportModal = document.getElementById('reportModal');

        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            defaultDate: "today",
            locale: "th",
            appendTo: reportModal, 
            static: true // Useful in modal so it doesn’t float outside
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            defaultDate: "today",
            locale: "th",
            appendTo: reportModal,
            static: true
        });
    });
</script>
  
<script>
        const ctx = document.getElementById('chart-day');

        const data = {
            labels: [
                'Music-Relax',
                'Video On-Demand',
                'Mini-Theater',
            ],
            datasets: [{
                label: [],
                data: [<?= $music_t_p ? $music_t_p : 0 ?>, <?= $vdo_t_p ? $vdo_t_p : 0 ?>, <?= $mini_t_p ? $mini_t_p : 0 ?>],
                backgroundColor: [
                    'rgb(13, 110, 253)',
                    'rgb(220, 53, 69)',
                    'rgb(25, 135, 84)',

                ]
            }]
        };
        const config = {
            type: 'polarArea',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'สถิติการใช้บริการ จากวันที่ <?= $formatted_start_date ?> ถึงวันที่ <?= $formatted_end_date ?>',
                        font: {
                            size: 20
                        },
                        padding: {
                            top: 10,
                            bottom: 30
                        }
                    }
                },
                animation: {
                    duration: 2000, // Smooth 2-second animation
                    easing: 'easeOutQuart' // Smooth out animation
                }
            }
        };
        const myChart = new Chart(ctx, config);


    </script>



    <script>
        // Wait until the DOM is fully loaded before running the script
        document.addEventListener('DOMContentLoaded', function () {
            console.log("JavaScript is running"); // Check if script runs

            // Parse the JSON data from PHP
            var data_month = JSON.parse('<?= $data; ?>');
            console.log(data_month); // Check the value in the browser console

            // Chart.js setup
            const ctx_month = document.getElementById('chart-month'); // Make sure this is the correct element ID

            const labels_month = [
                "ม.ค", "ก.พ", "มี.ค", "เม.ย", "พ.ค", "มิ.ย",
                "ก.ค", "ส.ค", "ก.ย", "ต.ค", "พ.ย", "ธ.ค"
            ];

            // Create the chart data object using the parsed data
            const chartData = {
                labels: labels_month, // Month labels
                datasets: [
                    {
                        label: 'Music-Relax', // Label for the first service
                        data: data_month[0], // Data for Service 1 (first array)
                        backgroundColor: 'rgb(13, 110, 253)', // Blue
                        borderColor: 'rgb(13, 110, 253)',
                        borderWidth: 1
                    },
                    {
                        label: 'Video On-Demand', // Label for the second service
                        data: data_month[1], // Data for Service 2 (second array)
                        backgroundColor: 'rgb(220, 53, 69)', // Red
                        borderColor: 'rgb(220, 53, 69)',
                        borderWidth: 1
                    },
                    {
                        label: 'Mini-Theater', // Label for the third service
                        data: data_month[2], // Data for Service 3 (third array)
                        backgroundColor: 'rgb(25, 135, 84)', // Green
                        borderColor: 'rgb(25, 135, 84)',
                        borderWidth: 1
                    }
                ]
            };

            // Chart.js configuration
            const config_month = {
                type: 'bar', // Bar chart
                data: chartData, // Use the data defined above
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'สถิติการใช้บริการปี ค.ศ. <?= $year ?>',
                            font: {
                                size: 20
                            },
                            padding: {
                                top: 10,
                                bottom: 30
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true // Start y-axis at zero
                        }
                    }
                }
            };

            // Render the chart
            const myChart2 = new Chart(ctx_month, config_month);
        });
    </script>
    <script>

        function find_data(event) {
            event.preventDefault(); // Prevent default form submission

            const start_date = $('#start_date').val();
            const end_date = $('#end_date').val();
            console.log(start_date, end_date);

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });


            if (!start_date) {
                showSweet('warn', 'โปรดใส่วันที่เริ่ม')
                return false; // Stop execution if input is empty
            } else if (!end_date) {
                showSweet('warn', 'โปรดใส่วันสิ้นสุด')
                return false; // Stop execution if input is empty
            }

            Toast.fire({
                icon: "success",
                title: "กำลังดำเนินการ"
            });

            setTimeout(function () {
                document.getElementById('modal-form').submit(); // Submit the form
            }, 800); // Wait 2 seconds (2000ms)
            // document.getElementById('modal-form').submit(); // Submit the form


        }
    </script>