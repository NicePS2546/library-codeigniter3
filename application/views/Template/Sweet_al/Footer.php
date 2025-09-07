<!-- footer -->

<!-- <footer class="footer" style="height:20%;  padding:20px; text-align: center;"> 

        <p class="arit d-inline-block m-1">ฝ่ายบริการโสตทัศนวัสดุ ชั้น 6 อาคารบรรณราชนครินทร์</p>

        <p class="m-1">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ มหาวิทยาลัยราชภัฏนครปฐม</p>

        <p class="d-inline-block m-1">&copy; Copyright 2019 by ARIT LibraryNPRU</p>        

</footer> -->

<!-- /footer -->

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

<script src="<?= base_url(); ?>assets/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>



<script>

    $('.owl-carousel').owlCarousel({

        loop: true,

        margin: 10,

        nav: false,

        responsive: {

            0: {

                items: 1

            },



            800: {

                items: 1

            },

            900: {

                items: 5

            },

            1500: {

                items: 6

            }



        }

    })

</script>

<script>

    $(document).ready(function () {



        if ($(window).width() <= 700) {

            $("img#movie").addClass("img-movie2");

            $("img#movie").removeClass("img-movie");



        } else {

            $("img#movie").addClass("img-movie");

            $("img#movie").removeClass("img-movie2")

        }



        $(window).resize(function () {

            if ($(this).width() <= 700) {

                $("img#movie").addClass("img-movie2");

                $("img#moviee").removeClass("img-movie");



            } else {

                $("img#movie").addClass("img-movie");

                $("img#movie").removeClass("img-movie2")

            }

        });

    });

</script>

<script>

    $(document).ready(function () {

        $("#inputdata").val("");

        $("#inputdataid").val("");

        $("#inputdataname").val("");

    });

</script>



<script>

    //Get the button

    var mybutton = document.getElementById("myBtn");



    // When the user scrolls down 20px from the top of the document, show the button

    window.onscroll = function () { scrollFunction() };



    function scrollFunction() {

        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {

            mybutton.style.display = "block";

        } else {

            mybutton.style.display = "none";



        }

    }



    // When the user clicks on the button, scroll to the top of the document

    function topFunction() {

        document.body.scrollTop = 0;

        document.documentElement.scrollTop = 0;



    }

</script>





<script>

    $(document).ready(function () {

        setInterval(function () {

            $('#refmusic').load('<?php echo site_url('musicrelax'); ?>');



        }, 10000);



    });





    $(document).ready(function () {

        setInterval(function () {

            $('#refvdo').load('<?php echo site_url('vdo'); ?>');



        }, 10000);



    });



    $(document).ready(function () {

        setInterval(function () {

            $('#refminitheater').load('<?php echo site_url('minitheater'); ?>');



        }, 10000);



    });

</script>


</body>

</html>