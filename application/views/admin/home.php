<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];

?>
<style>
  .font-title {
    font-size: 32px;
  }

  .fixed-height {
    min-height: 100vh;
  }

  .chart-container {
    display: flex;
    justify-content: center;
  }

@media (min-width: 992px) { /* Large devices (lg) and up */
    .col-lg-5 {
        flex: 0 0 35% !important;
        max-width: 35% !important;
    }

    
}

@media (min-width: 992px) and (max-width: 1199px) {
    .col-lg-3 {
        flex: 0 0 50%; /* 50% width for 2 cards in a row */
        max-width: 50%;
    }
}
  
</style>
<?php $card_res = "col-12 col-sm-6 col-md-6 col-lg-3"; ?>
<div class="col-md-12">
  <div class="info-box">
    <div class="info-box-content">
      <span class="info-box-text font-title">สถิติประจำวัน</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="<?= $card_res ?>">
    <div class="info-box">

      <span class="info-box-icon text-bg-primary shadow-sm">
        <i class="bi bi-music-note-beamed"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Music Relax</span>
        <span class="info-box-number">
          <?= $music['total_users'] ? $music['total_users'] : 0 ?>
          <small>คน</small>
        </span>
        <div class="overlay">
          <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="<?= $card_res ?>">
    <div class="info-box">
      <span class="info-box-icon text-bg-danger shadow-sm">
      <i class="bi bi-camera-reels-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Video On-Demand</span>
        <span class="info-box-number"> <?= $vdo['total_users'] ? $vdo['total_users'] : 0 ?> คน</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <!-- fix for small devices only -->
  <!-- <div class="clearfix hidden-md-up"></div> -->
  <div class="<?= $card_res ?>">
    <div class="info-box">
      <span class="info-box-icon text-bg-success shadow-sm">
      <i class="bi bi-film"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Mini-Theater</span>
        <span class="info-box-number"><?= $mini['total_users'] ? $mini['total_users'] : 0 ?> คน</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="<?= $card_res ?>">
    <div class="info-box">
      <span class="info-box-icon text-bg-warning shadow-sm">
        <i class="bi bi-people-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">จำนวนผู้ใช้ที่ออนไลน์</span>
        <span id="online_users" class="info-box-number">Loading</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>


<div class="col-md-12">
  <div class="info-box">
    <div class="info-box-content">
      <div class="chart-container " style="position: relative; height:60vh; width:80vw; padding-top: 20px; padding-bottom: 20px;">
        <canvas id="chart2"></canvas>
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
<script>
  function updateOnlineUsers() {
    fetch("<?php echo base_url('index.php/online/count/user'); ?>")
      .then(response => response.text())
      .then(data => {
        console.log(data);
        document.getElementById("online_users").innerHTML = data;
      });
  }

  // Update online users count every 5 seconds
  setInterval(updateOnlineUsers, 2000);
  updateOnlineUsers();
</script>


<script src="<?= base_url('public/cdn/chart/js/chart.js') ?>"></script>

<script>
  const ctx = document.getElementById('chart2');

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

      animation: {
      duration: 2000, // Smooth 2-second animation
      easing: 'easeOutQuart' // Smooth out animation
    }
    }
  };
  const myChart = new Chart(ctx, config);

 
</script>




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