<style>
  .red-toast {
    color: #ff5733;

  }

  .custom-toast {
    font-size: 18px;
  }
</style>

<?php
$status = 'success';
$message = null;
if ($this->session->flashdata('error')) {
  $status = 'error';
  $message = $this->session->flashdata('error');
} else {
  $status = 'success';
  $message = $this->session->flashdata('success');
}
// $message = "ข้อความการแจ้งเตือน";
// $status = 'error';
?>

<!-- <div id="toast" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11; ">
  <div id="liveToast" class="toast hide custom-toast <?= $this->session->flashdata('error') ? 'red-toast' : "" ?> " role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('public/assets/img/logo.png') ?>" width="50" height="50" class="rounded me-2" alt="...">
      <strong class="me-auto">แจ้งเตือน</strong>
      <small>ณ ขณะนี้</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" >
      Flash data error message will be here
      <?= $message ?>
    </div>
  </div>
</div> -->
<?php

if ($message): ?>
  <!-- <script>
        // Initialize the toast and show it
        var toast = new bootstrap.Toast(document.getElementById('liveToast'));
        toast.show();
    </script> -->
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });

    setTimeout(function () {
      Toast.fire({
        icon: false, // Disable default icon

        html: `<div class="<?= $status == 'error' ? "red-toast":"" ?>"><img src="<?= base_url("public/assets/img/logo.png") ?>" width="50" height="50" class="rounded me-2" alt="..."> <?= $message ?></div>`
      });
    }, 800);

  </script>

<?php endif; ?>