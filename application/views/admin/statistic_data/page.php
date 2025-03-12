<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];

?>
<style>
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
        <div class="info-box-content">

            <span class="info-box-text font-title">สถิติรายวัน</span>
            
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="info-box">
        <div class="info-box-content">
        
            <div class="chart-container "
                style="position: relative; height:60vh; width:80vw; padding-top: 20px; padding-bottom: 20px;">
                <canvas id="chart-day"></canvas>
            </div>


        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="info-box">
        <div class="info-box-content">
            <?php print_r($chart_data) ?>
            <span class="info-box-text font-title">สถิติรายเดือน</span>
        </div>
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

$date = '2025-03-10';

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
$timestamp = strtotime($date);

// Format the day, month, and year
$day_name = $thai_days[date('l', $timestamp)];
$day_number = date('d', $timestamp);
$month_name = $thai_months[(int)date('m', $timestamp)];
$year = date('Y', $timestamp);
$year += 543;
// Combine the formatted date
$formatted_date = "$day_name ที่ $day_number $month_name พ.ศ. $year";



?>

<script src="<?= base_url('public/cdn/chart/js/chart.js') ?>"></script>

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
            data: [<?= $music['total_users'] ? $music['total_users'] : 0 ?>, <?= $vdo['total_users'] ? $vdo['total_users'] : 0 ?>, <?= $mini['total_users'] ? $mini['total_users'] : 0 ?>],
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
                text: 'สถิติการใช้บริการ วัน<?= $formatted_date ?>',
                font:{
                    size:20
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

<!-- <script>
   
   

    const ctx_month = document.getElementById('chart-month');

    document.addEventListener('DOMContentLoaded', function() {
    console.log("JavaScript is running"); // Check if script runs
    var data_month = JSON.parse('<?= $data; ?>'); 
    console.log(data_month); // Check the value in the browser console
});

    const labels_month = [
        "ม.ค", "ก.พ", "มี.ค", "เม.ย", "พ.ค", "มิ.ย",
        "ก.ค", "ส.ค", "ก.ย", "ต.ค", "พ.ย", "ธ.ค"
    ];

    // Dataset with 3 bars per month

    console.log(data_music)
    const data_month = {
        labels: labels_month,
        datasets: [
            {
                label: 'Music-Relax',
                data: data_month[0], // Data for Category A
                backgroundColor: 'rgb(13, 110, 253)', // Blue
                borderColor: 'rgb(13, 110, 253)',
                borderWidth: 1
            },
            {
                label: 'Video On-Demand',
                data: data_month[1], // Data for Category B
                backgroundColor: 'rgb(220, 53, 69)', // Purple
                borderColor: 'rgb(220, 53, 69)',
                borderWidth: 1
            },
            {
                label: 'Mini-Theater',
                data: data_month[2], // Data for Category C
                backgroundColor: 'rgb(25, 135, 84)', // Green
                borderColor: 'rgb(25, 135, 84)',
                borderWidth: 1
            }
        ]
    };

    const config_month = {
        type: 'bar',
        data: data_month,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Render the chart
    const myChart2 = new Chart(ctx_month, config_month);
</script> -->


<script>
    // Wait until the DOM is fully loaded before running the script
    document.addEventListener('DOMContentLoaded', function() {
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
                text: 'สถิติการใช้บริการปี พ.ศ. <?= $year ?>',
                font:{
                    size:20
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