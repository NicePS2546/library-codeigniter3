<?php

$music = $statistic['music'];
$vdo = $statistic['vdo'];
$mini = $statistic['mini'];

$nf = $statistic['nf_stats'];
$disney = $statistic['disney_stats'];
$streaming = $statistic['streaming'];

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

// Thai date arrays
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

// Date processing
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

$ps_start_year = $start_date['year'] + 543;
$ps_end_year = $end_date['year'] + 543;

$formatted_start_date = $start_date['day_name'] . " ที่ " . $start_date['day_nums'] . " " . $start_date['month_name'] . " พ.ศ." . $ps_start_year;
$formatted_end_date = $end_date['day_name'] . " ที่ " . $end_date['day_nums'] . " " . $end_date['month_name'] . " พ.ศ." . $ps_end_year;

// Calculate totals if data exists
if ($statistic) {
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

    foreach ($nf as $stat) {
        $nf_t_p += (int) $stat['total_people'];
        $nf_rs += (int) $stat['reservation_count'];
    }

    foreach ($disney as $stat) {
        $disney_t_p += (int) $stat['total_people'];
        $disney_rs += (int) $stat['reservation_count'];
    }

    foreach ($streaming as $stat) {
        $streaming_t_p += (int) $stat['total_people'];
        $streaming_rs += (int) $stat['reservation_count'];
    }
}
?>
<?php
// Sample data - replace with your actual database query
// $logs = [
//     [
//         'id' => 1,
//         'reserv_id' => 1001,
//         'r_service' => 'music',
//         'action_type' => 'create',
//         'reason' => '',
//         'perform_by' => 'user',
//         'created_at' => '2025-08-23 14:30:25'
//     ],
//     [
//         'id' => 2,
//         'reserv_id' => 1002,
//         'r_service' => 'vdo',
//         'action_type' => 'cancel',
//         'reason' => 'duplicate',
//         'perform_by' => 'admin',
//         'created_at' => '2025-08-23 15:45:10'
//     ],
//     [
//         'id' => 3,
//         'reserv_id' => 1003,
//         'r_service' => 'mini',
//         'action_type' => 'update',
//         'reason' => 'wrong_time',
//         'perform_by' => 'user',
//         'created_at' => '2025-08-23 16:20:33'
//     ],
//     [
//         'id' => 4,
//         'reserv_id' => 1004,
//         'r_service' => 'music',
//         'action_type' => 'restore',
//         'reason' => '',
//         'perform_by' => 'admin',
//         'created_at' => '2025-08-23 17:15:42'
//     ],
//     [
//         'id' => 5,
//         'reserv_id' => 1005,
//         'r_service' => 'vdo',
//         'action_type' => 'cancel',
//         'reason' => 'switch',
//         'perform_by' => 'user',
//         'created_at' => '2025-08-23 18:05:18'
//     ],
//     [
//         'id' => 6,
//         'reserv_id' => 1006,
//         'r_service' => 'mini',
//         'action_type' => 'create',
//         'reason' => '',
//         'perform_by' => 'user',
//         'created_at' => '2025-08-23 19:12:55'
//     ]
// ];

// Thai translations
$service_labels = [
    'music' => 'Music-Relax',
    'vdo' => 'Video On-Demand',
    'mini' => 'Mini-Theater'
];

$service_icons = [
    'music' => 'bi-music-note-beamed',
    'vdo' => 'bi-camera-reels-fill',
    'mini' => 'fa-film'
];

$action_labels = [
    'create' => 'สร้างการจอง',
    'restore' => 'คืนค่าการจอง',
    'cancel' => 'ยกเลิกการจอง',
    'update' => 'อัพเดทการจอง'
];

$action_icons = [
    'create' => 'bi-file-earmark-plus',
    'restore' => 'bi-arrow-counterclockwise',
    'cancel' => 'bi-x',
    'update' => 'bi-floppy'
];

$reason_labels = [
    'duplicate' => 'จองใช้บริการได้แค่ กลุ่มละ 1 ครั้ง ต่อวัน เท่านั้น',
    'switch' => 'เปลี่ยนเครื่อง',
    'wrong_time' => 'เวลาไม่ถูกต้อง',
    '' => 'ไม่ระบุเหตุผล'
];

$perform_labels = [
    'user' => 'ผู้ใช้งาน',
    'admin' => 'ผู้ดูแลระบบ'
];

// Function to format Thai date
function formatThaiDateTime($datetime)
{
    $thai_months = [
        1 => 'ม.ค.',
        2 => 'ก.พ.',
        3 => 'มี.ค.',
        4 => 'เม.ย.',
        5 => 'พ.ค.',
        6 => 'มิ.ย.',
        7 => 'ก.ค.',
        8 => 'ส.ค.',
        9 => 'ก.ย.',
        10 => 'ต.ค.',
        11 => 'พ.ย.',
        12 => 'ธ.ค.'
    ];

    $timestamp = strtotime($datetime);
    $day = date('d', $timestamp);
    $month = $thai_months[(int) date('m', $timestamp)];
    $year = date('Y', $timestamp) + 543;
    $time = date('H:i', $timestamp);

    return $day . ' ' . $month . ' ' . $year . ' เวลา ' . $time . ' น.';
}

function getTimeAgo($datetime)
{
    $timestamp = strtotime($datetime);
    $now = time();
    $diff = $now - $timestamp;

    if ($diff < 60) {
        return 'เมื่อสักครู่';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' นาทีที่แล้ว';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' ชั่วโมงที่แล้ว';
    } else {
        $days = floor($diff / 86400);
        return $days . ' วันที่แล้ว';
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลสถิติการเข้าใช้บริการ</title>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('public/assets/css/report.css') ?>?v=<?= time(); ?>" />
</head>


<body>
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header animate-fadeIn">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h1 class="page-title">
                        ข้อมูลสถิติการเข้าใช้บริการ
                    </h1>
                    <?php if ($statistic): ?>
                        <div class="date-range">
                            <i class="bi bi-calendar-date"></i>
                            <?= $formatted_start_date ?> ถึง <?= $formatted_end_date ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button class="search-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal">
                    <i class="bi bi-search"></i> ค้นหาข้อมูล
                </button>
            </div>
        </div>

        <?php if ($statistic): ?>
            <!-- Statistics Cards -->
            <div class="stats-grid animate-slideUp">
                <!-- Music-Relax Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon music-icon">
                            <i class="bi bi-music-note-beamed"></i>
                        </div>
                        <h2 class="stat-title">Music-Relax</h2>
                    </div>
                    <div class="stat-numbers">
                        <div class="stat-item">
                            <span class="stat-value"><?= number_format($music_t_p) ?></span>
                            <div class="stat-label">ผู้เข้าใช้บริการ</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value"><?= number_format($music_rs) ?></span>
                            <div class="stat-label">จำนวนการจอง</div>
                        </div>
                    </div>
                </div>

                <!-- Video On-Demand Card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon video-icon">
                            <i class="bi bi-camera-reels-fill"></i>
                        </div>
                        <h2 class="stat-title">Video On-Demand</h2>
                    </div>
                    <div class="stat-numbers">
                        <div class="stat-item">
                            <span class="stat-value"><?= number_format($vdo_t_p) ?></span>
                            <div class="stat-label">ผู้เข้าใช้บริการ</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value"><?= number_format($vdo_rs) ?></span>
                            <div class="stat-label">จำนวนการจอง</div>
                        </div>
                    </div>

                    <div class="sub-services">
                        <div class="sub-service-grid">
                            <div class="sub-service">
                                <h6>Disney</h6>
                                <div class="value"><?= number_format($disney_rs) ?></div>
                                <small class="text-muted">จำนวนการจอง</small>
                            </div>
                            <div class="sub-service">
                                <h6>Netflix</h6>
                                <div class="value"><?= number_format($nf_rs) ?></div>
                                <small class="text-muted">จำนวนการจอง</small>
                            </div>
                            <div class="sub-service">
                                <h6>Streaming</h6>
                                <div class="value"><?= number_format($streaming_rs) ?></div>
                                <small class="text-muted">จำนวนการจอง</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mini-Theater Card (Currently hidden in original code) -->
                <!-- Uncomment if you want to show Mini-Theater data
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon mini-icon">
                            <i class="fas fa-film"></i>
                        </div>
                        <h2 class="stat-title">Mini-Theater</h2>
                    </div>
                    <div class="stat-numbers">
                        <div class="stat-item">
                            <span class="stat-value"><?= number_format($mini_t_p) ?></span>
                            <div class="stat-label">ผู้เข้าใช้บริการ</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value"><?= number_format($mini_rs) ?></span>
                            <div class="stat-label">จำนวนการจอง</div>
                        </div>
                    </div>
                </div>
                -->
            </div>

            <!-- Chart Section -->
            <div class="chart-container animate-slideUp" style="animation-delay: 0.3s;">
                <h3 class="chart-title">
                    <i class="bi bi-bar-chart"></i>
                    กราฟสถิติจำนวนผู้เข้าใช้งาน
                </h3>
                <div class="d-flex justify-content-center">
                    <div style="position: relative; height: 400px; width: 100%; max-width: 600px;">
                        <canvas id="chart-day"></canvas>
                    </div>
                </div>
            </div>






        </div>
    <?php else: ?>
        <!-- No Data State -->
        <div class="no-data animate-fadeIn">
            <i class="bi bi-bar-chart"></i>
            <h3>ไม่มีข้อมูลให้รายงานในขณะนี้</h3>
            <p class="text-muted">โปรดเลือกช่วงวันที่เพื่อดูข้อมูลสถิติ</p>
        </div>
    <?php endif; ?>
    <div class="page-sub-header animate-fadeIn mt-4 mb-4">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <h1 class="page-sub-title">
                    ข้อมูล Log การจองบริการ
                </h1>
            </div>
        </div>
    </div>
          
        
    <div class="stats-overview">
        <div class="stat-card-log">
            <div class="stat-icon bg-success">
                <i class="bi bi-file-earmark-plus"></i>
            </div>
            <div class="stat-value"><?= $count['create'] ? $count['create'] : 0 ?></div>
            <div class="stat-label">การสร้างใหม่</div>
        </div>
        <div class="stat-card-log">
            <div class="stat-icon bg-warning">
                <i class="bi bi-floppy"></i>
            </div>
            <div class="stat-value"><?= $count['update'] ? $count['update'] : 0 ?></div>
            <div class="stat-label">การอัพเดท</div>
        </div>
        <div class="stat-card-log">
            <div class="stat-icon bg-danger">
                <i class="bi bi-x"></i>
            </div>
            <div class="stat-value"><?= $count['cancel'] ? $count['cancel'] : 0 ?></div>
            <div class="stat-label">การยกเลิก</div>
        </div>
        <div class="stat-card-log">
            <div class="stat-icon bg-primary">
                <i class="bi bi-arrow-counterclockwise"></i>
            </div>
            <div class="stat-value"><?= $count['restore'] ? $count['restore'] : 0 ?></div>
            <div class="stat-label">การคืนค่า</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form id="filterForm">
            <div class="row custom-row g-3">
                <div class="col-md-3">
                    <div class="search-box">

                        <input type="text" class="form-control" id="searchInput" placeholder="ค้นหา Reservation ID">
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="serviceFilter">
                        <option value="">บริการทั้งหมด</option>
                        <option value="music">Music-Relax</option>
                        <option value="vdo">Video On-Demand</option>
                        <option value="mini">Mini-Theater</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="actionFilter">
                        <option value="">การกระทำทั้งหมด</option>
                        <option value="create">สร้าง</option>
                        <option value="update">อัพเดท</option>
                        <option value="cancel">ยกเลิก</option>
                        <option value="restore">คืนค่า</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" id="performFilter">
                        <option value="">ผู้ดำเนินการทั้งหมด</option>
                        <option value="user">ผู้ใช้งาน</option>
                        <option value="admin">ผู้ดูแลระบบ</option>
                    </select>
                </div>
                <div class="col-md-3 end-content-filter">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary" onclick="applyFilters()">
                            <i class="bi bi-search"></i> ค้นหา
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="resetFilters()">
                            <i class="bi bi-arrow-repeat"></i> รีเซ็ต
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Log Timeline -->

    <!-- <div class="log-wrapper">
                <div class="page-sub-header">
                    <h2 class="page-sub-title">ข้อมูล Log การจองบริการ</h2>
                </div> -->

    <?php if (!empty($logs)): ?>
        <div class="log-timeline" id="logTimeline">
            <?php foreach ($logs as $index => $log): ?>
                <div class="log-item" data-service="<?= $log['r_service'] ?>" data-action="<?= $log['action_type'] ?>"
                    data-perform="<?= $log['perform_by'] ?>" data-reserv-id="<?= $log['reserv_id'] ?>">
                    <!-- LOG CONTENT -->

                    <div class="log-header">
                        <div class="log-action">
                            <div class="action-icon action-<?= $log['action_type'] ?>">
                                <i class="bi <?= $action_icons[$log['action_type']] ?>"></i>
                            </div>
                            <div class="action-text">
                                <h4><?= $action_labels[$log['action_type']] ?></h4>
                                <small>ID: #<?= $log['reserv_id'] ?></small>
                            </div>

                        </div>
                        <div class="log-time">
                            <div class="time-ago"><?= getTimeAgo($log['created_at']) ?></div>
                            <small><?= formatThaiDateTime($log['created_at']) ?></small>
                        </div>
                    </div>
                    <div class="log-details">
                        <div class="detail-item">
                            <div class="detail-label">บริการ</div>
                            <div class="detail-value">
                                <span class="service-badge service-<?= $log['r_service'] ?>">
                                    <i class="bi <?= $service_icons[$log['r_service']] ?>"></i>
                                    <?= $service_labels[$log['r_service']] ?>
                                </span>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">ผู้ดำเนินการ</div>
                            <div class="detail-value">
                                <span class="perform-badge perform-<?= $log['perform_by'] ?>">
                                    <i class="bi <?= $log['perform_by'] == 'admin' ? 'bi-person-gear' : 'bi-person' ?>"></i>
                                    <?= $perform_labels[$log['perform_by']] ?>
                                </span>
                            </div>
                        </div>

                        <?php if (!empty($log['reason'])): ?>
                            <div class="detail-item">
                                <div class="detail-label">เหตุผล</div>
                                <div class="detail-value">
                                    <span class="reason-tag">
                                        <i class="bi bi-info-circle"></i>
                                        <?= $reason_labels[$log['reason']] ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="detail-item">
                            <div class="detail-label">Log ID</div>
                            <div class="detail-value">
                                <span class="text-primary fw-bold">#<?= $log['id'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-data d-none" id="noDataMessage">
            <i class="bi bi-search"></i>
            <h3>ไม่พบข้อมูล</h3>
            
        </div>
    <?php endif; ?>
    </div>
    </div>

    <!-- Load More Button -->
    <!-- <div class="load-more">
        <button class="btn load-more-btn" onclick="loadMoreLogs()">
            <i class="bi bi-arrow-repeat"></i> โหลดข้อมูลเพิ่มเติม
        </button>
    </div> -->

    <!-- No Data Message -->
    <div class="no-data d-none" id="noDataMessage">
        <i class="bi bi-search"></i>
        <h3>ไม่พบข้อมูลที่ค้นหา</h3>
        <p class="text-muted">ลองเปลี่ยนเงื่อนไขการค้นหาใหม่</p>
    </div>
    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
        <form method="post" id="modal-form" action="<?= base_url() ?>index.php/admin/statistic/report"
            onsubmit="return find_data(event)">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">
                            <i class="bi bi-search"></i> ค้นหาข้อมูล
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">จากวันที่</label>
                                <input type="text" class="form-control" id="start_date" name="start_date"
                                    value="<?= $start_date_val ? $start_date_val : date('Y-m-d') ?>"
                                    placeholder="เลือกวันที่เริ่มต้น">
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">ถึงวันที่</label>
                                <input type="text" class="form-control" id="end_date" name="end_date"
                                    value="<?= $end_date_val ? $end_date_val : date('Y-m-d') ?>"
                                    placeholder="เลือกวันที่สิ้นสุด">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            </i>ปิด
                        </button>
                        <button type="submit" class="btn btn-primary">
                            </i>ค้นหา
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/l10n/th.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    </script>

    <script>
        // Initialize Flatpickr
        document.addEventListener('DOMContentLoaded', function () {
            const reportModal = document.getElementById('reportModal');

            flatpickr("#start_date", {
                dateFormat: "Y-m-d",
                defaultDate: "<?= $start_date_val ? $start_date_val : date('Y-m-d') ?>",
                locale: "th",
                appendTo: reportModal,
                static: true
            });

            flatpickr("#end_date", {
                dateFormat: "Y-m-d",
                defaultDate: "<?= $end_date_val ? $end_date_val : date('Y-m-d') ?>",
                locale: "th",
                appendTo: reportModal,
                static: true
            });

            <?php if ($statistic): ?>
                // Initialize Chart
                initializeChart();
            <?php endif; ?>
        });

        <?php if ($statistic): ?>
            // Chart initialization
            function initializeChart() {
                const ctx = document.getElementById('chart-day');

                const data = {
                    labels: [
                        'Music-Relax',
                        'Video On-Demand'
                        // Add 'Mini-Theater' if you want to include it
                    ],
                    datasets: [{
                        label: 'จำนวนผู้ใช้งาน',
                        data: [
                            <?= $music_t_p ? $music_t_p : 0 ?>,
                            <?= $vdo_t_p ? $vdo_t_p : 0 ?>
                            // Add <?= $mini_t_p ? $mini_t_p : 0 ?> if including Mini-Theater
                        ],
                        backgroundColor: [
                            'rgba(83, 126, 247)',
                            'rgba(239, 68, 68, 0.8)'
                            // Add 'rgba(16, 185, 129, 0.8)' for Mini-Theater
                        ],
                        borderColor: [
                            'rgba(83, 126, 247)',
                            'rgba(239, 68, 68, 1)'
                            // Add 'rgba(16, 185, 129, 1)' for Mini-Theater
                        ],
                        borderWidth: 2
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
                                    size: 18,
                                    family: 'Kanit'
                                },
                                padding: {
                                    top: 10,
                                    bottom: 30
                                }
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    font: {
                                        family: 'Kanit',
                                        size: 14
                                    }
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            r: {
                                beginAtZero: true,
                                ticks: {
                                    font: {
                                        family: 'Kanit'
                                    }
                                }
                            }
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeOutQuart'
                        }
                    }
                };

                new Chart(ctx, config);
            }
        <?php endif; ?>

        // Your existing search function
        function find_data(event) {
            event.preventDefault();

            const start_date = $('#start_date').val();
            const end_date = $('#end_date').val();
            console.log(start_date, end_date);

            if (!start_date) {
                alert('โปรดใส่วันที่เริ่ม');
                return false;
            } else if (!end_date) {
                alert('โปรดใส่วันสิ้นสุด');
                return false;
            }

            // Add loading state to submit button
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            // submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>กำลังดำเนินการ...';
            submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise bi-spin"></i> กำลังดำเนินการ...';
            submitBtn.disabled = true;

            setTimeout(function () {
                document.getElementById('modal-form').submit();
            }, 800);

            return false;
        }
    </script>
    <script>
        // Filter and search functionality
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const serviceFilter = document.getElementById('serviceFilter').value;
            const actionFilter = document.getElementById('actionFilter').value;
            const performFilter = document.getElementById('performFilter').value;

            const logItems = document.querySelectorAll('.log-item');
            let visibleCount = 0;

            logItems.forEach(item => {
                const reservId = item.dataset.reservId.toLowerCase();
                const service = item.dataset.service;
                const action = item.dataset.action;
                const perform = item.dataset.perform;

                let showItem = true;

                // Search filter
                if (searchTerm && !reservId.includes(searchTerm)) {
                    showItem = false;
                }

                // Service filter
                if (serviceFilter && service !== serviceFilter) {
                    showItem = false;
                }

                // Action filter
                if (actionFilter && action !== actionFilter) {
                    showItem = false;
                }

                // Perform filter
                if (performFilter && perform !== performFilter) {
                    showItem = false;
                }

                if (showItem) {
                    item.style.display = '';
                    item.style.animationDelay = (visibleCount * 0.1) + 's';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show/hide no data message
            const noDataMessage = document.getElementById('noDataMessage');
            const loadMoreSection = document.querySelector('.load-more');

            if (visibleCount === 0) {
                noDataMessage.classList.remove('d-none');
                loadMoreSection.style.display = 'none';
            } else {
                noDataMessage.classList.add('d-none');
                loadMoreSection.style.display = '';
            }
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('serviceFilter').value = '';
            document.getElementById('actionFilter').value = '';
            document.getElementById('performFilter').value = '';
            applyFilters();
        }

        // Load more logs (demo only – here just hides button if no more logs)
        function loadMoreLogs() {
            const loadMoreSection = document.querySelector('.load-more');
            loadMoreSection.innerHTML = '<p class="text-muted">ไม่มีข้อมูลเพิ่มเติม</p>';
        }
    </script>