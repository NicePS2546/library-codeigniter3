<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>hi</div>
<div id="online_users">Loading...</div>

<script>
function updateOnlineUsers() {
    fetch("<?php echo base_url('index.php/online/count/user'); ?>")
        .then(response => response.text())
        .then(data => {
            document.getElementById("online_users").innerHTML = data;
        });
}

// Update online users count every 5 seconds
setInterval(updateOnlineUsers, 2000);
updateOnlineUsers();
</script>
</body>
</html>
