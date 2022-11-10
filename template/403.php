<?php

// متغيرات الصفحة
$title = "خطأ 403";

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <p class="text-center">
                    <b class="text-danger">دخول غير مصرح به</b>
                    <br>
                    <a class="text-center text-decoration-none" href="index.php">العودة إلى الصفحة الرئيسية</a>
                </p>
            </div>
        </div>
    </section>
</main>
<?php
require "template/footer.php"; // محتوى الفوتير
die();
?>