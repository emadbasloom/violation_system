<?php 
include_once "../inc/functions.php";

// مثقير يتم فيه جلب بيانات المدرسة من قاعدة البيانات
$getschod =selectWherefooter('school_deitails',1);

error_reporting(0);

?>


<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
    </div>
    <!-- Left -->

  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h4 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i> مدرسة <?php echo  $getschod->school_name ?>
          </h4>
          
          <p><i class="fas fa-home me-3"></i> العنوان : <?php echo $getschod->school_address; ?></p>
          <p><i class="fas fa-home me-3"></i> المدينة : <?php echo $getschod->school_city; ?></p>

        
        </div>
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <img class="img-thumbnail" src="assets/images/<?php echo $getschod->school_logo; ?>" alt="<?= $getschod->school_logo; ?>" width="210px">
        </div>

       
        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">معلومات الاتصال</h6>
          <p><i class="fas fa-envelope me-3">الايميل: <?php echo $getschod->school_email; ?></i></p>
          <p><i class="fas fa-phone me-3"></i> رقم الجوال : <?php echo $getschod->school_mobile_number; ?></p>
          <p><i class="fas fa-print me-3"></i> رقم الهاتف : <?php echo $getschod->school_tel_number; ?></p>
          <p><i class="fas fa-print me-3"></i> الموقع الاكتروني: <?php echo $getschod->school_website; ?></p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © <?php echo "20".date("y"); ?> Copyright: 
    <a class="text-reset fw-bold" href="">yasser & rashad & emad</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->