<style>
  .not-found{
    margin-bottom: 26.5% !important;
  }
</style>


<section id="main" class="container  not-found">
    <div class="row justify-content-center">   
    <div class="card notFound mt-fixed" style="width: 18rem;">
  <div class="card-body text-center">
    <h5 class="card-title">ยังไม่มีห้องที่ให้บริการขณะนี้</h5>
    <h6 class="card-subtitle mb-2 text-body-secondary"></h6>
    <p class="card-text">โปรดรอให้เจ้าหน้าที่เปิดห้องบริการ</p>
    
  </div>
</div>
    </div>
</section>

<script>
        document.addEventListener("DOMContentLoaded", function () {
            setInterval(() => {
                const elements = document.querySelectorAll(".notFound");
                console.log("Selected elements:", elements);
            elements.forEach((el, index) => {
              // Delay each element by a factor of its index (300ms = 0.3 second per element)
              setTimeout(() => {
                el.classList.add('visible','animate__animated', 'animate__fadeInUp');
              }, index * 300); // The delay increases for each element
            });
          }, 500);
        });
    
            
            setInterval(() => {
                location.reload();
            }, 60000);
       
</script>