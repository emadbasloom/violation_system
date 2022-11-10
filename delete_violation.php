<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');


// متغيرات الصفحة
$title = "حذف مخالفة";

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <h3>حذف مخالفة</h3>
                <span class="text-muted">عند حذف مخالفة من النظام سوف يتم حذف جميع المخالفات المرتبطة</span>
            </div>
        </div>
        <p class="text-danger mb-3">فقط مسؤول النظام يمكن ازالة المخالفة من النظام</p>
        <?php if (is_admin($_SESSION['user_email'])) : ?>
            <p>
                عزيز الأدمن يمكن حذف المخالفات من لائحة السلوك من 
                <a href="violations.php">هنا</a>
            </p>
        <?php endif ?>
    </section>
</main>
<?php
require "template/footer.php"; // محتوى الفوتير
?>