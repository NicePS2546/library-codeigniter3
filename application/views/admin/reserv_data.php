<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];
$card_res = "col-12 col-sm-2 col-md-2 col-lg-1";
?>

<style>
    .font-title {
        font-size: 32px;
        text-align: start;
    }

    .fixed-height {
        min-height: 100vh;
    }

    .chart-container {
        display: flex;
        justify-content: center;
    }

    .type-selector {
        display: flex !important;

        align-items: center;
    }

    @media (min-width: 992px) {

        /* Large devices (lg) and up */
        .col-md-2 {
            flex: 0 0 7% !important;
            max-width: 7% !important;
        }

        .col-lg-1 {
            flex: 0 0 10% !important;
            max-width: 10% !important;
        }

        .col-sm-2 {
            flex: 0 0 10% !important;
            max-width: 10% !important;
        }
    }

    @media (max-width: 575px) {
        /* Large devices (lg) and up */

        .col-md-2 {
            flex: 0 0 20% !important;
            max-width: 20% !important;
        }

        .col-sm-2 {
            flex: 0 0 20% !important;
            max-width: 20% !important;
        }
    }

    @media (max-width: 450px) {
        /* Large devices (lg) and up */

        .col-md-2 {
            flex: 0 0 30% !important;
            max-width: 30% !important;
        }

    }

    .info-box-icon {
        position: relative;
        /* Needed for absolute positioning */
    }

    /* Tooltip text (hidden by default) */
    .info-box-icon::after {
        content: attr(data-label);
        /* Get text from data-label */
        position: absolute;
        bottom: 120%;
        /* Position above button */
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.75);
        color: #fff;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out;
    }

    /* Show tooltip on hover */
    .info-box-icon:hover::after {
        opacity: 1;
        visibility: visible;
    }
</style>

<div class="info-box">
    <div class="info-box-content">
        <span class="info-box-text font-title"><?= $title ?></span>
    </div>
</div>

<div class="col-md-12 ">
    <div class="info-box ">
        <div class="info-box-content">
            <div class="row d-flex pt-4 pb-4 justify-content-center align-items-center">
                <!-- <div class="<?= $card_res ?> text-center">
                    <a class="info-box btn">
                        <span class="info-box-icon text-bg-primary shadow-sm">
                            <i class="bi bi-music-note-beamed"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Music Relax</span>
                            </span>
                            <div class="overlay">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </a>
                  
                </div>
               
                <div class="<?= $card_res ?> text-center">
                    <a class="info-box btn">
                        <span class="info-box-icon text-bg-danger shadow-sm">
                            <i class="bi bi-camera-reels-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Video On-Demand</span>

                        </div>
                        
                    </a>
                   
                </div>
               
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 text-center">
                    <a class="info-box btn">
                        <span class="info-box-icon text-bg-success shadow-sm">
                            <i class="bi bi-film"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mini-Theater</span>

                        </div>
                       
                    </a>
                    
                </div> -->


                <a href="<?= base_url('index.php/admin/check/reserv/music') ?>" class="<?= $card_res ?> text-center">
                    <span class="info-box-icon text-bg-primary shadow-sm btn-shadow" data-label="Music-Relax">
                        <i class="bi bi-music-note-beamed"></i>
                    </span>
                </a>

                <a href="<?= base_url('index.php/admin/check/reserv/vdo') ?>" class="<?= $card_res ?> text-center">
                    <span class="info-box-icon text-bg-danger shadow-sm btn-shadow" data-label="Video On-Demand">
                        <i class="bi bi-camera-reels-fill"></i>
                    </span>
                </a>
                <a href="<?= base_url('index.php/admin/check/reserv/mini') ?>" class="<?= $card_res ?> text-center">
                    <span class="info-box-icon text-bg-success shadow-sm btn-shadow" data-label="Mini-Theater">
                        <i class="bi bi-film"></i>
                    </span>
                </a>
            </div>
            <div>
                <?= $this->load->view('admin/component/base_table', ['table' => $table], true) ?>
            </div>
        </div>
    </div>

</div>
<!-- /.col -->

<!-- <div class="col-md-12">
  <div class="info-box">
    <div class="info-box-content">
     
      <div id="chart">
      </div>
      
    </div>
  </div>
</div> -->