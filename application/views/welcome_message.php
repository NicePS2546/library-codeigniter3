<link rel="stylesheet" href="<?= base_url('public/cdn/boostrap5_3_0/css/bootstrap.min.css') ?>">
<style type="text/css">
html,body{
    margin:0;
    padding:0;

}
.carousel-item {
    position: relative;
    height: 800px; /* Set to whatever fits your design */
    background-size: cover;
    background-position: center;
    
}
.carousel-caption h5,
.carousel-caption p {
    color: white; /* Set text color to white */
    text-shadow: 2px 2px 4px black, -2px -2px 4px black, 2px -2px 4px black, -2px 2px 4px black; /* Create the black outline effect */
    padding: 10px; /* Optional: add padding around the text */
}
.carousel-caption {
    position: absolute;  /* Absolutely position the caption inside the carousel item */
    top: 50%;
    bottom: 50%;            /* Move it to the middle vertically */
    left: 50%;           /* Move it to the middle horizontally */
    transform: translate(-50%, -50%); /* Center it exactly */
    text-align: center;  /* Align text to the center */
    color: #fff;         /* Make sure the text is visible */
}
.carousel-indicators {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
}

.carousel-indicators li {
    background-color: #000; /* Or any color you prefer */
    border-radius: 50%;
    height: 10px; /* Adjust the size of the indicator dot */
    width: 10px;
}

.carousel-indicators .active {
    background-color: #007bff; /* Color of the active indicator */
}

.carousel-item .slide-img {
    background-size: cover; /* This ensures the whole image is visible */
    background-position: center;
    background-repeat: no-repeat;
    height: 100%;
    width: 100%;
    border-top-left-radius: 15px;    /* Top-left corner */
    border-top-right-radius: 15px;   /* Top-right corner */
    border-bottom-left-radius: 0; /* Bottom-left corner */
    border-bottom-right-radius: 0; /* Bottom-right corner */
}
.carousel-caption{
    top: 40%;
}

.blacksceen{
    background-color: rgba(0, 0, 0, 0.5);
    height: 100%;
}


.jumbotron{
    background: #2C3E50;
    color: #fff;
    padding: 10px 0px 10px 0px;
    border-top-left-radius: 0;    /* Top-left corner */
    border-top-right-radius: 0;   /* Top-right corner */
    border-bottom-left-radius: 15px; /* Bottom-left corner */
    border-bottom-right-radius: 15px; /* Bottom-right corner */
}

/*section timeline*/
.main-timeline{
    font-family: 'Sanchez', serif;
    position: relative;
}
.main-timeline:before{
    content: '';
    height: 100%;
    width: 2px;
    border: 3px dashed #999;
    transform: translateX(-50%);
    position: absolute;
    left: 50%;
    top: 0;
}
.main-timeline:after{
    content: '';
    display: block;
    clear: both;
}
.main-timeline .timeline{
    width: 50.05%;
    display:inline-block;
    float: left;
    position: relative;
    z-index: 1;
}
.main-timeline .timeline:before,
.main-timeline .timeline:after{
    content: '';
    background-color: #E53E35;
    height: 25px;
    width: 25px;
    border-radius: 50%;
    transform: translateY(-50%);
    position: absolute;
    top: 50%;
    right: -12px;
}
.main-timeline .timeline:after{
    height: 17px;
    width: 150px;
    border-radius: 0;
    right: 0;
}
.main-timeline .timeline-content{
    text-align: right;
    min-height: 155px;
    padding: 20px 230px 15px 12px;
    display:block;
}
.main-timeline .timeline-content:hover{ text-decoration: none; }
.main-timeline .timeline-year{
    color: #E53E35;
    background-color: #fff;
    font-size: 35px;
    font-weight: 600;
    text-align: center;
    line-height: 100px;
    height: 120px;
    width: 120px;
    border: 10px solid #E53E35;
    transform: translateY(-50%);
    position: absolute;
    right: 100px;
    top: 50%;
    z-index: 1;
}
.main-timeline .title{
    color: #E53E35;
    font-size: 22px;
    font-weight: 600;
    text-transform: capitalize;
    letter-spacing: 1px;
    margin: 0 0 5px;
}
.main-timeline .description{
    color: #101010;
    font-size: 15px;
    letter-spacing: 1px;
    margin: 0;
}
.main-timeline .timeline:nth-child(even){ float: right; }
.main-timeline .timeline:nth-child(even):before{
    right: auto;
    left: -12px;
}
.main-timeline .timeline:nth-child(even):after{
    right: auto;
    left: 0;
}
.main-timeline .timeline:nth-child(even) .timeline-content{
    padding: 20px 12px 15px 230px;
    text-align: left;
}
.main-timeline .timeline:nth-child(even) .timeline-year{
    right: auto;
    left: 100px;
}
.main-timeline .timeline:nth-child(5n+2):before,
.main-timeline .timeline:nth-child(5n+2):after{
    background-color: #934666;
}
.main-timeline .timeline:nth-child(5n+2) .timeline-year{
    color: #934666;
    border-color: #934666;
}
.main-timeline .timeline:nth-child(5n+2) .title{ color: #934666; }
.main-timeline .timeline:nth-child(5n+3):before,
.main-timeline .timeline:nth-child(5n+3):after{
    background-color: #1CA685;
}
.main-timeline .timeline:nth-child(5n+3) .timeline-year{
    color: #1CA685;
    border-color: #1CA685;
}
.main-timeline .timeline:nth-child(5n+3) .title{ color: #1CA685; }
.main-timeline .timeline:nth-child(5n+4):before,
.main-timeline .timeline:nth-child(5n+4):after{
    background-color: #F05386;
}
.main-timeline .timeline:nth-child(5n+4) .timeline-year{
    color: #F05386;
    border-color: #F05386;
}
.main-timeline .timeline:nth-child(5n+4) .title{ color: #F05386; }
@media screen and (max-width:990px){
    .main-timeline .timeline-year{ right: 30px; }
    .main-timeline .timeline-content{ padding: 15px 160px 15px 15px; }
    .main-timeline .timeline:nth-child(even) .timeline-year{ left: 30px; }
    .main-timeline .timeline:nth-child(even) .timeline-content{ padding: 15px 15px 15px 160px; }
}
@media screen and (max-width:767px){
    .main-timeline:before{
        transform: translateX(0);
        left: -3px;
    }
    .main-timeline .timeline{
        width: 100%;
        margin-bottom: 20px;
    }
    .main-timeline .timeline:before,
    .main-timeline .timeline:after,
    .main-timeline .timeline:nth-child(even):before,
    .main-timeline .timeline:nth-child(even):after{
        transform: translateY(0);
        top: 14px;
    }
 
    .main-timeline .timeline:before,
    .main-timeline .timeline:after{
        right: auto;
        left: -12px;
    }
    .main-timeline .timeline:after{ left: 0; }
    .main-timeline .timeline:after,
    .main-timeline .timeline:nth-child(even):after{
        width: 50px;
        top: 17px;
    }
    .main-timeline .timeline .timeline-content,
    .main-timeline .timeline:nth-child(even) .timeline-content{
        text-align: left;
        padding: 70px 10px 10px 20px;
    }
    .main-timeline .timeline .timeline-year,
    .main-timeline .timeline:nth-child(even) .timeline-year{
        line-height: 40px;
        height: 50px;
        width: 120px;
        border-width: 5px;
        transform: translateY(0);
        top: 0;
        left: 45px;
    }

    .carousel-item {
    height: 500px; /* Adjust the height as needed */
  }

  .slide-img {
    height: 100%; /* Take up full height of the carousel item */
    background-size: cover; /* Ensure the image covers the entire div */
    background-position: center; /* Center the image */
  }
}

</style>
<!-- carousel  -->

<!-- Carousel HTML -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <!-- First Slide -->
    <div class="carousel-item active">
      <div class="slide-img" style="background-image:url(<?= base_url('assets/img/karaoke.jpg');?>)">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="display-6 font-weight-bold">บริการห้อง Music Relax</h5>
          <p>ลงทะเบียนเข้าใช้งาน 4-7 คน</p>
          <a href="<?= base_url('index.php/music') ?>">
            <button type="button" class="btn btn-success btn-lg">ลงทะเบียน</button>
          </a>
        </div>
      </div>
    </div>

    <!-- Second Slide -->
    <div class="carousel-item">
      <div class="slide-img" style="background-image:url(<?php echo base_url('assets/img/movie-1.jpg');?>)">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="display-6 font-weight-bold">ชมภาพยนตร์ VDO on-demand</h5>
          <p>ลงทะเบียนเข้าใช้งาน 1-6 คน</p>
          <a href="<?= base_url('index.php/vdo') ?>">
            <button type="button" class="btn btn-success btn-lg">ลงทะเบียน</button>
          </a>
        </div>
      </div>
    </div>

    <!-- Third Slide -->
    <div class="carousel-item">
      <div class="slide-img" style="background-image:url(<?= base_url('assets/img/minitheater-1.jpg');?>)">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="display-6 font-weight-bold">บริการห้องมินิเธียเตอร์</h5>
          <p>ลงทะเบียนเข้าใช้งาน 8 คนขึ้นไป</p>
          <a href="<?= base_url('index.php/mini') ?>">
            <button type="button" class="btn btn-success btn-lg">ลงทะเบียน</button>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Carousel Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- /carousel -->

<!-- jumbotron -->
<header class="jumbotron text-center">
    <div class="container">
        <h1>ขั้นตอนการใช้บริการ</h1>
    </div>
</header>
<!-- /jumbothon -->

<!-- timeline -->
<section>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="main-timeline">
                <div class="timeline">
                    <a class="timeline-content">
                        <span class="timeline-year">1</span>
                        <h3 class="title">ขั้นตอนที่ 1</h3>
                        <p class="description">
                            เลือกบริการที่ต้องการ
                        </p>
                    </a>
                </div>
                <div class="timeline">
                    <a  class="timeline-content">
                        <span class="timeline-year">2</span>
                        <h3 class="title">ขั้นตอนที่ 2</h3>
                        <p class="description">
                            เลือกห้องที่ว่าง หรือ ห้องที่จะเข้าร่วม
                        </p>
                    </a>
                </div>
                <div class="timeline">
                    <a class="timeline-content">
                        <span class="timeline-year">3</span>
                         <h3 class="title">ขั้นตอนที่ 3</h3>
                        <p class="description">
                            เลือกรายการภาพยนต์ที่ต้องการรับชม(กรณีเลือกชมภาพยนต์)
                        </p>
                    </a>
                </div>
                <div class="timeline">
                    <a class="timeline-content">
                        <span class="timeline-year">4</span>
                        <h3 class="title">ขั้นตอนที่ 4</h3>
                        <p class="description">
                        กรอกรหัสนักศึกษา รหัสนักเรียน ตามจำนวนที่กำหนด
                           
                        </p>
                    </a>
                </div>
                <div class="timeline" >
                    <a class="timeline-content">
                        <span class="timeline-year">5</span>
                        <h3 class="title">ขั้นตอนที่ 5</h3>
                        <p class="description">
                           ตรวจสอบข้อมูลที่ลงทะเบียนแล้วกดปุ่มยืนยัน
                        </p>
                    </a>
                </div>
               
            </div>
        </div>
    </div>
</div>
</section>
<!-- /timeline -->
<footer class="footer" style="height:20%;  padding:20px; text-align: center;"> 
        <p class="arit d-inline-block m-1">หน่วยโสตทัศนวัสดุ ชั้น 6 อาคารบรรณราชนครินทร์</p>
        <p class="m-1">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ มหาวิทยาลัยราชภัฏนครปฐม</p>
        <p class="d-inline-block m-1">&copy; Copyright 2019 by Library NPRU & Information Technology</p>        
</footer> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
