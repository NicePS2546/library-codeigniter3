<script src="<?= base_url('public/cdn/sweetalert.js') ?>"></script>
			<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการ หยุดวันเสาร์",
                    showConfirmButton: true,
                });
            }, 1000);
</script>