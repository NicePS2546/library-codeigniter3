<style>
    .accordion{
        --bs-accordion-border-color: #7a7a7a !important;
    }
</style>
<div class="accordion mb-3" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        ระเบียบการใช้บริการ
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
       <?= $this->load->view('reservation/rule_content',[
        'page'=>$page
       ],true) ?>
        
       
      </div>
    </div>
  </div>
  </div>