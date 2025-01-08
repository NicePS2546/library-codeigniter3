<!-- app/Views/loading.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
  
</head>
<body>
<div id="loading-container">
  <div class="divider" aria-hidden="true"></div>
  <p class="loading-text" aria-label="Loading">
    <span class="letter" aria-hidden="true">L</span>
    <span class="letter" aria-hidden="true">o</span>
    <span class="letter" aria-hidden="true">a</span>
    <span class="letter" aria-hidden="true">d</span>
    <span class="letter" aria-hidden="true">i</span>
    <span class="letter" aria-hidden="true">n</span>
    <span class="letter" aria-hidden="true">g</span>
  </p>
</div>

<!-- Include your CSS (either inline or linked externally) -->
<link rel="stylesheet" href="<?= base_url('public/assets/css/loading.css') ?>" />


    <script>
        setTimeout(() => {
            window.location.href = '<?= base_url(),$page ?>';
        }, <?= $timer ?>); // Redirect to the main page after 3 seconds
    </script>
</body>
</html>