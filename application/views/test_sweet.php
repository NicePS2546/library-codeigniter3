<?php

$sweet = "
<script>
        Swal.fire({
            title: 'Error!',
            text: 'Do you want to continue',
            icon: 'success',
            confirmButtonText: 'Cool'
        });
        </script>
";


echo "<script src='" . base_url('public/cdn/sweetaleart2@11.js') . "'></script>";
echo '<link rel="stylesheet" href="'.base_url("public/assets/cdn/sweet2.min.css").'" >';
echo $sweet;

?>