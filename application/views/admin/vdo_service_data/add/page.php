<style>
    @keyframes bounceIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }

        50% {
            transform: scale(1.1);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    #result {
        animation: bounceIn 0.5s ease-out;
    }

    .ani-element {
        opacity: 0;
    }

    .ani-element.visible {
        opacity: 1;
        transition: opacity 0.3s ease-in;
    }
</style>

<div class="container">
    <div class="col-12 col-sm-8 pb-4 col-md-6 col-lg-10 mt-4 mx-auto ani-element">

        <form class="text-end" action="<?php echo base_url('index.php/admin/video/service/add/submit'); ?>"  id="formId"
            onsubmit="return update_service(event)" method="POST" enctype="multipart/form-data">
            
            
            <?= $this->load->view('admin/vdo_service_data/component/form_content', ['row' => $row], true) ?>

        </form>
    </div>
</div>


<script src="<?= base_url('public/cdn/jQuery/jquery-3.6.0.min.js') ?>"></script>




<script>

    document.addEventListener("DOMContentLoaded", function () {
        setInterval(() => {
            const className = '.ani-element';
            const elements = document.querySelectorAll(className);

            elements.forEach((el, index) => {
                // Delay each element by a factor of its index (300ms = 0.3 second per element)
                setTimeout(() => {
                    el.classList.add('visible');
                }, index * 300); // The delay increases for each element
            });
        }, 500);
    });

  
    function update_service(event) {
        event.preventDefault(); // Prevent default form submission

        const service_id = $('#service_id').val(); // Get input value
        const name_EN = $('#name_EN').val();
        const name_TH = $('#name_TH').val();
        const s_type = $('#s_type').val();
        const s_desc = $('#s_desc').val();
       

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

        if (!service_id) {
            showSweet('warn', 'โปรดใส่หมายเลขบริการ')
            return false; // Stop execution if input is empty
        } else if (!name_EN) {
            showSweet('warn', 'โปรดใส่ชื่อภาษาอังกฤษ')
            return false; // Stop execution if input is empty
        } else if (!name_TH) {
            showSweet('warn', 'โปรดใส่ชื่อภาษาไทย')
            return false; // Stop execution if input is empty
        } else if (!s_type) {
            showSweet('warn', 'โปรดใส่รูปแบบ')
            return false; // Stop execution if input is empty
        }
           
        Toast.fire({
            icon: "success",
            title: "กำลังดำเนินการ"
        });
        setTimeout(function () {
            document.getElementById('formId').submit(); // Submit the form
        }, 800); // Wait 2 seconds (2000ms)
      

    }

</script>

<script>
    function showSweet(status, msg, title) {
        if (status == 'success') {
            Swal.fire({
                title: title ? title : "สำเร็จ",
                text: msg,
                icon: 'success',
                confirmButtonText: 'โอเค'
            });
        } else if (status == 'warn') {
            Swal.fire({
                title: title ? title : "แจ้งเตือน",
                text: msg,
                icon: 'warning',
                confirmButtonText: 'โอเค'
            });
        } else {
            Swal.fire({
                title: title ? title : "ผิดพลาด",
                text: msg,
                icon: 'error',
                confirmButtonText: 'โอเค'
            });
        }
    }
</script>