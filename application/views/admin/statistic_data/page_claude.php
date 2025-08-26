<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #a29bfe;
            --success-color: #00b894;
            --danger-color: #e17055;
            --warning-color: #fdcb6e;
            --info-color: #74b9ff;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.1);
            --border-radius: 15px;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            margin: 20px;
            padding: 30px;
            box-shadow: var(--card-shadow);
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .stats-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9ff 100%);
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            border: none;
            padding: 20px 25px;
        }

        .card-title {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25);
        }

        .btn-search {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.4);
            color: white;
        }

        .chart-container {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            position: relative;
            min-height: 500px;
        }

        .service-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .icon-music { background: linear-gradient(135deg, var(--info-color) 0%, #0984e3 100%); }
        .icon-video { background: linear-gradient(135deg, var(--danger-color) 0%, #d63031 100%); }
        .icon-theater { background: linear-gradient(135deg, var(--success-color) 0%, #00a085 100%); }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }

        .search-group {
            flex: 1;
            min-width: 200px;
        }

        .search-group label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
            display: block;
        }

        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                margin: 10px;
                padding: 20px;
            }
            
            .search-form {
                flex-direction: column;
            }
            
            .search-group {
                min-width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .chart-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="dashboard-container fade-in">
            <h1 class="page-title">
                <i class="fas fa-chart-line"></i>
                Dashboard สถิติการใช้บริการ
            </h1>

            <!-- Daily Statistics Section -->
            <div class="stats-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-day"></i>
                        สถิติรายวัน
                    </h3>
                </div>
                <div class="card-body">
                    <div class="search-section">
                        <form method="post" action="#" class="search-form">
                            <div class="search-group">
                                <label for="day-picker">เลือกวันที่</label>
                                <input 
                                    name="day" 
                                    id="day-picker"
                                    class="form-control flatpickrDay" 
                                    value="2024-01-15" 
                                    type="date"
                                >
                                <input name="year" type="hidden">
                            </div>
                            <div class="search-group" style="flex: 0 0 auto;">
                                <button class="btn btn-search" type="submit">
                                    <i class="fas fa-search me-2"></i>ค้นหา
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="chart-container">
                        <div class="chart-title">สถิติการใช้บริการ วันจันทร์ ที่ 15 มกราคม ค.ศ. 2024</div>
                        <canvas id="chart-day" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Yearly Statistics Section -->
            <div class="stats-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt"></i>
                        สถิติรายปี
                    </h3>
                </div>
                <div class="card-body">
                    <div class="search-section">
                        <form method="post" action="#" class="search-form">
                            <div class="search-group">
                                <label for="year-picker">เลือกปี ค.ศ.</label>
                                <input 
                                    name="year" 
                                    id="year-picker"
                                    class="form-control flatpickrYear text-center" 
                                    value="2024" 
                                    placeholder="โปรดใส่ปี ค.ศ." 
                                    type="number"
                                    min="2020"
                                    max="2030"
                                >
                                <input name="day" type="hidden" value="2024-01-15">
                            </div>
                            <div class="search-group" style="flex: 0 0 auto;">
                                <button class="btn btn-search" type="submit">
                                    <i class="fas fa-search me-2"></i>ค้นหา
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="chart-container">
                        <div class="chart-title">สถิติการใช้บริการปี ค.ศ. 2024</div>
                        <canvas id="chart-month" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>

    <script>
        // Initialize Flatpickr
        flatpickr(".flatpickrDay", {
            dateFormat: "Y-m-d",
            locale: "th",
            theme: "light"
        });

        // Sample data - replace with your PHP variables
        const musicData = 150;
        const vdoData = 230;
        const miniData = 180;

        // Daily Chart
        const ctxDay = document.getElementById('chart-day');
        const dailyChart = new Chart(ctxDay, {
            type: 'polarArea',
            data: {
                labels: ['Music-Relax', 'Video On-Demand', 'Mini-Theater'],
                datasets: [{
                    data: [musicData, vdoData, miniData],
                    backgroundColor: [
                        'rgba(116, 185, 255, 0.8)',
                        'rgba(225, 112, 85, 0.8)',
                        'rgba(0, 184, 148, 0.8)'
                    ],
                    borderColor: [
                        '#74b9ff',
                        '#e17055',
                        '#00b894'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' คน';
                            }
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });

        // Monthly Chart Data (Sample)
        const monthlyData = {
            music: [120, 135, 140, 155, 170, 160, 150, 165, 175, 180, 160, 140],
            vdo: [200, 220, 210, 230, 245, 235, 220, 240, 250, 260, 240, 220],
            mini: [150, 165, 160, 175, 180, 170, 165, 175, 185, 190, 175, 160]
        };

        // Monthly Chart
        const ctxMonth = document.getElementById('chart-month');
        const monthlyChart = new Chart(ctxMonth, {
            type: 'bar',
            data: {
                labels: ['ม.ค', 'ก.พ', 'มี.ค', 'เม.ย', 'พ.ค', 'มิ.ย', 'ก.ค', 'ส.ค', 'ก.ย', 'ต.ค', 'พ.ย', 'ธ.ค'],
                datasets: [
                    {
                        label: 'Music-Relax',
                        data: monthlyData.music,
                        backgroundColor: 'rgba(116, 185, 255, 0.8)',
                        borderColor: '#74b9ff',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false
                    },
                    {
                        label: 'Video On-Demand',
                        data: monthlyData.vdo,
                        backgroundColor: 'rgba(225, 112, 85, 0.8)',
                        borderColor: '#e17055',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false
                    },
                    {
                        label: 'Mini-Theater',
                        data: monthlyData.mini,
                        backgroundColor: 'rgba(0, 184, 148, 0.8)',
                        borderColor: '#00b894',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' คน';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                }
            }
        });

        // Add loading states for form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('.btn-search');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>กำลังค้นหา...';
                submitBtn.disabled = true;
            });
        });

        // Add smooth transitions for chart updates
        function updateCharts(newData) {
            // This would be called when new data comes from PHP
            dailyChart.data.datasets[0].data = newData.daily;
            monthlyChart.data.datasets[0].data = newData.music;
            monthlyChart.data.datasets[1].data = newData.vdo;
            monthlyChart.data.datasets[2].data = newData.mini;
            
            dailyChart.update('active');
            monthlyChart.update('active');
        }
    </script>
</body>
</html>