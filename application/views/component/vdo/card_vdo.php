<div class="card ani-element card-shadow text-center mx-auto mt-4" >
  <img src="<?= base_url("public/assets/img/service_img/".$service['s_picture']) ?>" width="200" height="200" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= $service['name_TH'] ?></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary"><?= $service['name_EN'] ?></h6>
    <p class="card-text"><?= $service['desc'] ?></p>
    <a href="<?= base_url() ?>index.php/vdo/reserv/<?= $r_id ?>/<?= $service['service_id'] ?>" class="btn btn-primary">เลือก</a>
  </div>
</div>