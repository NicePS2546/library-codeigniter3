<?php 
    
    $formatted_time = date('H:i', strtotime($time));
?>
<script>
            setTimeout(function() {
                Swal.fire({
                title: 'แจ้งเตือน',
                text: 'ไม่อยู่ในเวลาทำการ ระบบจะเปิดบริการอีกครั้งในเวลา <?= $formatted_time ?> น.',
                icon: 'warning',
                confirmButtonText: 'โอเค'
            });
            }, 1000);
</script>