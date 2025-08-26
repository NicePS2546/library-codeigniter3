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
    'music' => 'fa-music',
    'vdo' => 'fa-play-circle',
    'mini' => 'fa-film'
];

$action_labels = [
    'create' => 'สร้างการจอง',
    'restore' => 'คืนค่าการจอง',
    'cancel' => 'ยกเลิกการจอง',
    'update' => 'อัพเดทการจอง'
];

$action_icons = [
    'create' => 'fa-plus-circle',
    'restore' => 'fa-undo',
    'cancel' => 'fa-times-circle',
    'update' => 'fa-edit'
];

$reason_labels = [
    'duplicate' => 'ข้อมูลซ้ำ',
    'switch' => 'เปลี่ยนแปลง',
    'wrong_time' => 'เวลาไม่ถูกต้อง',
    '' => 'ไม่ระบุเหตุผล'
];

$perform_labels = [
    'user' => 'ผู้ใช้งาน',
    'admin' => 'ผู้ดูแลระบบ'
];

// Function to format Thai date
function formatThaiDateTime($datetime) {
    $thai_months = [
        1 => 'ม.ค.', 2 => 'ก.พ.', 3 => 'มี.ค.', 4 => 'เม.ย.',
        5 => 'พ.ค.', 6 => 'มิ.ย.', 7 => 'ก.ค.', 8 => 'ส.ค.',
        9 => 'ก.ย.', 10 => 'ต.ค.', 11 => 'พ.ย.', 12 => 'ธ.ค.'
    ];
    
    $timestamp = strtotime($datetime);
    $day = date('d', $timestamp);
    $month = $thai_months[(int)date('m', $timestamp)];
    $year = date('Y', $timestamp) + 543;
    $time = date('H:i', $timestamp);
    
    return $day . ' ' . $month . ' ' . $year . ' เวลา ' . $time . ' น.';
}

function getTimeAgo($datetime) {
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
    <title>ข้อมูล Log การจองบริการ</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('public/assets/css/report_example.css') ?>?v=<?= time(); ?>" />
</head>
<body>
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header animate-fadeIn">
            <h1 class="page-title">
                <i class="fas fa-history"></i>
                ข้อมูล Log การจองบริการ
            </h1>
            <p class="text-muted mt-2 mb-0">ติดตามและจัดการข้อมูล Log การดำเนินการทั้งหมด</p>
        </div>

        <!-- Statistics Overview -->
        <div class="stats-overview">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--success-color), #059669);">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="stat-value">12</div>
                <div class="stat-label">การสร้างใหม่</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--warning-color), #d97706);">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="stat-value">8</div>
                <div class="stat-label">การอัพเดท</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--danger-color), #dc2626);">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-value">5</div>
                <div class="stat-label">การยกเลิก</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--secondary-color), #0891b2);">
                    <i class="fas fa-undo"></i>
                </div>
                <div class="stat-value">3</div>
                <div class="stat-label">การคืนค่า</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form id="filterForm">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
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
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary" onclick="applyFilters()">
                                <i class="fas fa-search me-1"></i>ค้นหา
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="resetFilters()">
                                <i class="fas fa-undo me-1"></i>รีเซ็ต
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Log Timeline -->
         <?php if(empty($logs)): ?>
            <?php else: ?>
        <div class="log-timeline" id="logTimeline">
            <?php foreach ($logs as $index => $log): ?>
            <div class="log-item" 
                 data-service="<?= $log['r_service'] ?>" 
                 data-action="<?= $log['action_type'] ?>" 
                 data-perform="<?= $log['perform_by'] ?>"
                 data-reserv-id="<?= $log['reserv_id'] ?>"
                 style="animation-delay: <?= $index * 0.1 ?>s;">
                
                <div class="log-header">
                    <div class="log-action">
                        <div class="action-icon action-<?= $log['action_type'] ?>">
                            <i class="fas <?= $action_icons[$log['action_type']] ?>"></i>
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
                                <i class="fas <?= $service_icons[$log['r_service']] ?>"></i>
                                <?= $service_labels[$log['r_service']] ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">ผู้ดำเนินการ</div>
                        <div class="detail-value">
                            <span class="perform-badge perform-<?= $log['perform_by'] ?>">
                                <i class="fas <?= $log['perform_by'] == 'admin' ? 'fa-user-shield' : 'fa-user' ?>"></i>
                                <?= $perform_labels[$log['perform_by']] ?>
                            </span>
                        </div>
                    </div>
                    
                    <?php if (!empty($log['reason'])): ?>
                    <div class="detail-item">
                        <div class="detail-label">เหตุผล</div>
                        <div class="detail-value">
                            <span class="reason-tag">
                                <i class="fas fa-info-circle"></i>
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
            <?php endif; ?>

        </div>

        <!-- Load More Button -->
        <div class="load-more">
            <button class="btn load-more-btn" onclick="loadMoreLogs()">
                <i class="fas fa-plus me-2"></i>โหลดข้อมูลเพิ่มเติม
            </button>
        </div>

        <!-- No Data Message -->
        <div class="no-data d-none" id="noDataMessage">
            <i class="fas fa-search"></i>
            <h3>ไม่พบข้อมูลที่ค้นหา</h3>
            <p class="text-muted">ลองเปลี่ยนเงื่อนไขการค้นหาใหม่</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

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