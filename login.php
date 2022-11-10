<?php

/**
 * اذا المستخدم مسجل دخول وجرب يدخل لهاذي الصفحة مرة تانية
 * بيرجع على الصفحة الرئيسية
 */
session_start();
if (isset($_SESSION['user_authenticated'])) {
    header("Location: index.php");
    exit();
}

// متغيرات الصفحة
$title = "تسجيل الدخول";
$error = isset($_GET['error']) ? "اسم المستخدم او كلمة المرور خطأ" : false; // شرط اذا في خطأ

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="py-5 container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h2 class="text-center mb-3">تسجيل الدخول</h2>
                <form action="inc/helper/login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">البريد الالكتروني</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="البريد الالكتروني" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">كلمة السر</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="كلمة السر" required>
                    </div>
                    <span class="text-danger"><b><?= $error ?></b></span>
                    <button type="submit" name="login" class="btn btn-primary w-100 mt-4">تسجيل الدخول</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php
require "template/footer.php"; // محتوى الفوتير
?>