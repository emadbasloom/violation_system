<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');
error403();


// متغيرات الصفحة
$title = "الصفحة الافتراضية";

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <form action="inc/helper/new_user.php" method="POST">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">اسم المستخدم</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="اسم المستخدم" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="البريد الالكتروني" required>
                    </div>
                    <div class="mb-3">
                        <label for="school_email" class="form-label">البريد الالكتروني للمدرسة</label>
                        <input type="school_email" class="form-control" id="school_email" name="school_email" placeholder=" البريد الالكتروني للمدرسة" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="كلمة المرور" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="make_admin" name="make_admin">
                        <label class="form-check-label" for="make_admin">اعطاء صلاحيات الادمن</label>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_user">إنشاء</button>
                </form>
            </div>
        </div>

    </section>
</main>
<?php
require "template/footer.php"; // محتوى الفوتر
?>