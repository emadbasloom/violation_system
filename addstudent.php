<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// متغيرات الصفحة
$title = "انشاء طالب";

require "template/header.php"; // محتوى الهيدر
?>
<main>
    <section class="container py-5">
        <h3>إضافة طالب جديد</h3>
        <form action="inc/helper/add_students.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <input type="number" class="form-control mt-3" name="student_id" placeholder="رقم الطالب" required>
                    <input type="text" class="form-control mt-3" name="student_name" placeholder="اسم الطالب" required>
                    <input type="text" class="form-control mt-3" name="student_father_name" placeholder="اسم ولي امر الطالب" required>
                    <input type="text" class="form-control mt-3" name="student_grade" placeholder="سنة الطالب" required>
                    <input type="file" class="form-control mt-3" accept=".png, jpeg, .jpg" name="student_image" placeholder="صورة الطالب" >
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control mt-3" name="student_birth" placeholder="تاريخ الميلاد" required>
                    <input type="email" class="form-control mt-3" name="student_email" placeholder="الايميل " required>
                    <input type="number" class="form-control mt-3" name="student_number" placeholder="رقم ولي امر الطالب" required>
                    <input type="number" class="form-control mt-3" name="student_parent_number" placeholder="رقم الهاتف" required>
                    <input type="text" class="form-control mt-3" name="student_address" placeholder="العنوان" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="create_student">إضافة</button>
        </form>
        <hr>
        <div class="row">
            <div class="col-md">
                <h3>رفع معلف CSV</h3>
                <small class="text-muted">
                    جيب ان يكون ترتيب الملف كما يلي
                    <br>
                    `student_id`, `student_name`, `student_father_name`, `student_grade`, `student_image`, `student_birth`, `student_email`, `student_number`, `student_parent_number`, `student_address`
                </small>
                <small class="text-muted">ملاحظة: يجب ان يكون ترميز ملف CSV في حال وجود نصوص عربية هو utf8</small>
                <br>
                <a href="assets/csv_example.csv" download>تحميل نموذج CSV</a>
                <form class="mt-3 w-25" method="POST" action="inc/helper/add_students.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="file" class="form-control" accept=".csv" required>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="SubmitCSV" class="btn btn-primary">
                            رفع ملف
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php
require "template/footer.php"; // محتوى الفوتير
?>