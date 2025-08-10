<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];
$card_res = "col-12 col-sm-2 col-md-2 col-lg-1";
?>




<style>
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
        transition: all 0.5s ease-in-out;
    }


    .info-box-icon::after {
        content: attr(data-label);
        position: absolute;
        bottom: 120%;

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


    .info-box-icon:hover::after {
        opacity: 1;
        visibility: visible;
        transition: all 0.5s ease-in-out;
    }
</style>

<div class="info-box">
    <div class="info-box-content title-container">
        <span class="info-box-text font-title"><?= $title ?></span>
        <div class="my-auto">
            <button class="btn my-auto btn-primary fetch-btn" id="fetch-btn"  data-bs-toggle="modal"
                data-bs-target="#AddDate"
               >เพิ่มวันหยุด</button>
        </div>
    </div>
</div>

<div class="col-md-12 ">
    <div class="info-box">
        <div class="container">
            <?= $this->load->view('admin/no_service_date/table/base_table', [], true) ?>
        </div>
    </div>
</div>


