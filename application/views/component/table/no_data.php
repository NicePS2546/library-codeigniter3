<style>
  .not-found{
    margin-bottom: 26.5% !important;
  }
  .card{
    opacity: 0;
  }
  .card.visible{
    opacity: 1;
    transition: opacity 1s ease-in-out;
  }
  #main1 {
      height: 50vh; /* Full viewport height */
      display: flex;
      justify-content: center; /* Center horizontally */
      align-items: center; /* Center vertically */
  }
</style>
<?php
  if($table == 'music'){
    $msg = 'Music';
  }elseif($table == 'vdo'){
    $msg = 'Video On-Demand';
  }else{
    $msg = 'Mini-Theater';
  }
?>

<section id="main1" class="container not-found">
    <div class="row justify-content-center">   
    <div class="card notFound " style="width: 18rem;">
  <div class="card-body text-center">
    <h5 class="card-title ">ยังไม่มีการจองในขณะนี้</h5>
    <h6 class="card-subtitle mb-2 text-body-secondary"></h6>
    <p class="card-text">ท่านสามารถจองได้ที่หน้า <a href="<?= base_url("index.php/$page") ?>"><?= $msg ?></a></p>
    
  </div>
</div>
    </div>
</section>