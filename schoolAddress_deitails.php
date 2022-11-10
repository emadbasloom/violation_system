<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// متغيرات الصفحة
$title = "اضافة بيانات المدرسة";

require "template/header.php"; // محتوى الهيدر
?>
<main>
    <section class="container py-5">
        <h3>اضافة بيانات المدرسة</h3>
        <form action="inc/helper/school_deitails.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control mt-3" name="school_name" placeholder="اسم المدرسة" >
                    <input type="text" class="form-control mt-3" name="school_city" placeholder="المدينة" >
                    <input type="text" class="form-control mt-3" name="school_address" placeholder="عنوان المدرسة" >
                    <input type="text" class="form-control mt-3" name="school_email" placeholder="ايميل المدرسة" >
                    <input type="file" class="form-control mt-3" accept=".png, jpeg, .jpg" name="school_logo" placeholder="شعار المدرسة" >
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control mt-3" name="school_mobile_number" placeholder="جوال المدرسة" >
                    <input type="number" class="form-control mt-3" name="school_tel_number" placeholder="رقم الهاتف المدرسة"  >
                    <input type="text" class="form-control mt-3" name="school_website" placeholder="رابط موقع الويب للمدرسة" >
                </div>
            </div>     
            <button type="submit" class="btn btn-primary mt-3" name="add_address">إضافة</button>
        </form>
        

    </section>
</main>
<?php
require "template/footer.php"; // محتوى الفوتير
?>