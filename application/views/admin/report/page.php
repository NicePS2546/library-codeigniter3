<?php

$music = $statistic['music']['0']['total_people'];
$vdo = $statistic['vdo']['0']['total_people'];
$mini = $statistic['mini']['0']['total_people'];

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
<pre>

</pre>
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
                    <div class="chart-container "
                        style="position: relative; height:60vh; width:80vw; padding-top: 20px; padding-bottom: 20px;">
                        <canvas id="chart-day"></canvas>

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
                <span class="info-box-text font-title">กราฟแสดงสถิติข้อมูล</span>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="info-box">
            <div class="info-box-content">
                <?php if ($statistic): ?>
                    <div class="chart-container "
                        style="position: relative; height:60vh; width:80vw; padding-top: 20px; padding-bottom: 20px;">
                        <canvas id="chart-month"></canvas>
                    </div>
                <?php else: ?>
                    <h4 class="text-center">ไม่กราฟให้แสดงในขณะนี้</h4>
                <?php endif ?>



            </div>
        </div>
    </div>
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="post" id="modal-form" action="<?= base_url() ?>index.php/admin/time/setting/submit"
            onsubmit="return find_data(event)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ค้นหาข้อมูล</h5>

                    </div>
                    <div class="modal-body  d-flex justify-content-center">
                        <div class="col-10 col-sm-10 pb-4 col-md-10 col-lg-10 text-start">

                            <div class="d-flex gap-4">
                                <div class="col-lg-6">
                                    <label for="st_id">จากวันที่</label>
                                    <div class="input-group mt-2">
                                        <input name="start_date" id class="form-control w-75 flatpickrDay"
                                            value="<?= $start_date ? $start_date : date('Y-m-d') ?>" type="date">

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="st_id">ถึงวันที่</label>
                                    <div class="input-group mt-2">
                                        <input name="end_date" id="end_date" class="form-control w-75 flatpickrDay"
                                            value="<?= $end_date ? $end_date : date('Y-m-d') ?>" type="date">

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

    <?php



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






    // Combine the formatted date
    $formatted_start_date = $start_date['day_name'] ." ที่ " .$start_date['day_nums'] . $start_date['month_name'] ."ค.ศ." . $start_date['year'];
    $formatted_end_date = $end_date['day_name'] ." ที่ " .$end_date['day_nums'] . $end_date['month_name'] ."ค.ศ." . $end_date['year'];




    ?>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?= base_url('public/cdn/chart/js/chart.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>
    <script>
        flatpickr(".flatpickrDay", {
            // You can add custom options here, for example:
            dateFormat: "Y-m-d",
            locale: "th",
        });


        const ctx = document.getElementById('chart-day');

        const data = {
            labels: [
                'Music-Relax',
                'Video On-Demand',
                'Mini-Theater',
            ],
            datasets: [{
                label: [],
                data: [<?= $music ? $music : 0 ?>, <?= $vdo ? $vdo : 0 ?>, <?= $mini ? $mini : 0 ?>],
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