<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// تسجيل الخروج من النظام
if (isset($_GET['logout'])) logout();

// متغيرات الصفحة
$title = "الرئيسية";

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2 class="section-title mb-5">
                    القائمة الرئيسية
                </h2>
            </div>
            <!-- topic-item -->
            <div class=" col-lg-5 col-sm-6 mb-5">
                <a href="create_violation.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                        ضبط مخالفة
                    </h3>
                    <button class="btn btn-primary mt-3">
                        ضبط مخالفة
                    </button>
                </a>
            </div>
            
            <div class="col-lg-5 col-sm-6 mb-5">
                <a href="student_violations.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                        عرض جميع المخالفات
                    </h3>
                    <button class="btn btn-primary mt-3">
                        عرض جميع المخالفات
                    </button>
                </a>
            </div>
           
            <div class="col-lg-5 col-sm-6 mb-5">
                <a href="addstudent.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                        اضافة طالب
                    </h3>
                    <button class="btn btn-primary mt-3">
                        اضافة طالب
                    </button>
                </a>
            </div>
            <div class="col-lg-5 col-sm-6 mb-5">
                <a href="students.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                        عرض الطلاب
                    </h3>
                    <button class="btn btn-primary mt-3">
                        عرض الطلاب
                    </button>
                </a>
            </div>

            <?php if (is_admin($_SESSION['user_email'])) : ?>
                <div class="col-lg-5 col-sm-6 mb-5">
                    <a href="users.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                        <h3 class="mb-3 mt-0">
                            المستخدمين
                        </h3>
                        <button class="btn btn-primary mt-3">
                            المستخدمين
                        </button>
                    </a>
                </div>
                <div class="col-lg-5 col-sm-6 mb-5">
                    <a href="violations.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                        <h3 class="mb-3 mt-0">
                            لائحة السلوك
                        </h3>
                        <button class="btn btn-primary mt-3">
                            لائحة السلوك
                        </button>
                    </a>
                </div>
                <div class="col-lg-5 col-sm-6 mb-5">
                <a href="schoolAddress_deitails.php" class="text-decoration-none text-reset card-section px-4 py-5 bg-white shadow text-center d-block match-height">
                    <h3 class="mb-3 mt-0">
                         اضافة بيانات المدرسة
                    </h3>
                    <button class="btn btn-primary mt-3">
                    اضافة بيانات المدرسة 
                    </button>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php
require "template/footer.php"; // محتوى الفوتير
?>