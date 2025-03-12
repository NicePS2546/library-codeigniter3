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
<pre>
<?php print_r($data) ?>
</pre>
<?php $card_res = "col-12 col-sm-6 col-md-6 col-lg-3"; ?>
<div class="col-md-12">
    <div class="info-box">
        <form method="post" class="info-box-content  title-container"
            action="<?= base_url('index.php/admin/statistic/service/netflix') ?>">
            <span class="info-box-text font-title">สถิติการชม Disney+</span>
            <div class="search-content">
                <input name="year" class="form-control w-75 flatpickrYear text-center" value="<?= $year ?>"
                    placeholder="โปรดใส่ปี ค.ศ." type="number">
                
                <button class="btn my-auto btn-primary" type="submit" style="width:100px">ค้นหา</button>

            </div>
        </form>
    </div>
</div>


<div class="col-md-12">
    <div class="info-box">
        <div class="info-box-content">
            <div class="chart-container "
                style="position: relative; height:60vh; width:80vw; padding-top: 20px; padding-bottom: 20px;">
                <canvas id="chart-month"></canvas>
            </div>


        </div>
    </div>
</div>

<!-- <div class="col-md-12">
  <div class="info-box">
    <div class="info-box-content">
     
      <div id="chart">
      </div>
      
    </div>
  </div>
</div> -->

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


// Format the day, month, and year

$year = date('Y');





?>
<script src="<?= base_url('public/cdn/chart/js/chart.js') ?>"></script>


<script>
    // Wait until the DOM is fully loaded before running the script
    document.addEventListener('DOMContentLoaded', function () {
        console.log("JavaScript is running"); // Check if script runs

        // Parse the JSON data from PHP
        var data_month = JSON.parse('<?= json_encode($data); ?>');
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
                    label: 'จำนวนคน', // Label for the first service
                    data: data_month[0], // Data for Service 1 (first array)
                    backgroundColor: 'rgb(13, 110, 253)', // Blue
                    borderColor: 'rgb(13, 110, 253)',
                    borderWidth: 1
                },
                {
                    label: 'จำนวนครั้ง', // Label for the second service
                    data: data_month[1], // Data for Service 2 (second array)
                    backgroundColor: 'rgb(220, 53, 69)', // Red
                    borderColor: 'rgb(220, 53, 69)',
                    borderWidth: 1
                },
                {
                    label: 'จำนวนชั่งโมง', // Label for the third service
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

<!-- <script>
       document.addEventListener("DOMContentLoaded", function () {
    const ctx_month = document.getElementById('chart-month').getContext('2d');

    // Pass PHP data directly into JavaScript
    const chartData = <?= $chart_data ?>;

    if (!chartData || chartData.length === 0) {
        console.error("No chart data available.");
        return;
    }

    // Extract unique labels (dates)
    const labels_month = [
    "ม.ค", "ก.พ", "มี.ค", "เม.ย", "พ.ค", "มิ.ย", 
    "ก.ค", "ส.ค", "ก.ย", "ต.ค", "พ.ย", "ธ.ค"
];


    // Group data by service_id
    const groupedData = {};
    chartData.forEach(item => {
        if (!groupedData[item.service_id]) {
            groupedData[item.service_id] = {
                label: labels_month,
                data: new Array(labels.length).fill(0), // Fill with 0 initially
                backgroundColor: getColorForService(item.service_id),
                borderColor: getColorForService(item.service_id),
                borderWidth: 1
            };
        }

        // Find index of stat_date in labels
        const index = labels.indexOf(item.stat_date);
        if (index >= 0) {
            groupedData[item.service_id].data[index] = item.total_reservations;
        }
    });

    // Convert object to array for Chart.js
    const datasets = Object.values(groupedData);

    // Initialize Chart.js
    new Chart(ctx_month, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

function getColorForService(serviceId) {
    const colors = {
        1: 'rgba(255, 99, 132, 0.6)', // Service 1 (Red)
        2: 'rgba(54, 162, 235, 0.6)', // Service 2 (Blue)
        3: 'rgba(255, 206, 86, 0.6)'  // Service 3 (Yellow)
    };
    return colors[serviceId] || 'rgba(153, 102, 255, 0.6)'; // Default color
}

    
</script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  var options = {
  series: [<?= $music['total_users'] ? $music['total_users'] : 0 ?>, <?= $vdo['total_users'] ? $vdo['total_users'] : 0 ?>, <?= $mini['total_users'] ? $mini['total_users'] : 0 ?>],
  chart: {
    type: 'polarArea',
    height: 450, // Set the height here
    width: '100%' // Optional: Adjust width as needed
  },labels: [
    "Music-Relax", 
    "Video On-Demand", 
    "Mini-Theater", 
    
  ], // Labels for each data point
  stroke: {
    colors: ['#fff']
  },
  fill: {
    opacity: 0.8
  },
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 250, // Adjust for small screens
        height: 300  // Adjust for small screens
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

    
</script> -->