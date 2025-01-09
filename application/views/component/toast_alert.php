  
<style>

.red-toast{
    color: #ff5733;
    
}
.custom-toast{
    font-size: 18px;
}



</style>

  <?php
    $message = null;
  if($this->session->flashdata('error')){
    $message = $this->session->flashdata('error');
  }else{
    $message = $this->session->flashdata('success');
  } ?>
    <div id="toast" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11; ">
  <div id="liveToast" class="toast hide custom-toast <?= $this->session->flashdata('error') ? 'red-toast' : "" ?> " role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('public/assets/img/logo.png') ?>" width="50" height="50" class="rounded me-2" alt="...">
      <strong class="me-auto">แจ้งเตือน</strong>
      <small>ณ ขณะนี้</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" >
      <!-- Flash data error message will be here -->
      <?= $message ?>
    </div>
  </div>
</div>
<?php 

if ($message): ?>
        <script>
        // Initialize the toast and show it
        var toast = new bootstrap.Toast(document.getElementById('liveToast'));
        toast.show();
    </script>
       
   
<?php endif; ?>