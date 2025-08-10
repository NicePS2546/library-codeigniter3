<script src="<?= base_url('public/cdn/sweetalert.js') ?>"></script>

<script>
    const data = <?= json_encode($row) ?>;

    const titleText = data
        ? (data.title.includes("วัน")
            ? "หยุดทำการ" + data.title
            : "หยุดทำการวัน " + data.title)
        : "หยุดทำการวันเสาร์";
        
    setTimeout(() => {
        Swal.fire({
            position: "center",
            icon: "error",
            title: 'ขออภัยในความไม่สะดวก',
            text: titleText,

            showConfirmButton: true,
        });
    }, 1000);

</script>