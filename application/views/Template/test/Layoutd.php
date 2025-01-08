<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ? : 'My Website'; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Tempus Dominus CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tempus-dominus@6.2.7/dist/css/tempus-dominus.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">

    <style>
        #app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <!-- Loading Animation -->
    <div id="loading">
        <div class="jumper">
            <div class="shadow-loading">
                <div class="loader"></div>
            </div>
        </div>
    </div>

    <header>
        <!-- Navbar -->
        <?= $layout['navbar']; ?>
    </header>

    <div id="app-container">
        <div class="content">
            <?= $layout['content'] ?>
        </div>
        <!-- Footer -->
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container text-center">
                <p>ฝ่ายบริการโสตทัศนวัสดุ ชั้น 6 อาคารบรรณราชนครินทร์</p>
                <p>สำนักวิทยบริการและเทคโนโลยีสารสนเทศ มหาวิทยาลัยราชภัฏนครปฐม</p>
                <p>&copy; 2019 ARIT LibraryNPRU</p>
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tempus Dominus JS -->
    <script src="https://cdn.jsdelivr.net/npm/tempus-dominus@6.2.7/dist/js/tempus-dominus.min.js"></script>

    <!-- Loading Scripts -->
    <script>
        // Page loading animation
        $(window).on('load', function () {
            $("#loading").animate({
                'opacity': '0'
            }, 900, function () {
                setTimeout(function () {
                    $("#loading").css("visibility", "hidden").fadeOut();
                }, 100);
            });
        });
    </script>

    <!-- Custom Script to Initialize Tempus Dominus -->
    <script>
        // Ensure Tempus Dominus initialization runs only when the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            const element = document.getElementById('datetimepicker');
            if (element) {
                // Initialize Tempus Dominus with both Date and Time Picker
                new tempusDominus.TempusDominus(element, {
                    display: {
                        components: {
                            calendar: true,
                            date: true,
                            month: true,
                            year: true,
                            clock: true,
                            hours: true,
                            minutes: true,
                            seconds: true, // You can omit this if you don't want seconds
                        }
                    },
                    localization: {
                        locale: 'th', // Optional: Set the locale to Thai or your desired language
                    },
                });
            } else {
                console.error('Datetime picker element not found.');
            }
        });
    </script>

    <!-- HTML Input for Date and Time Picker -->
    <div class="container my-5">
        <label for="datetimepicker" class="form-label">Select Date and Time:</label>
        <input type="text" id="datetimepicker" class="form-control" placeholder="Select Date and Time">
    </div>

</body>

</html>
