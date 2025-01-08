
<?php
$value = 2;
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Room number ' . $value . ' already exists.",
            showConfirmButton: true
        }).then(() => {
            window.location.href = "' . base_url('debug') . '";
        });
    });
</script>';

?>