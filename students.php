<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

$students = select('students');

// متغيرات الصفحة
$title = "قائمة الطلاب";

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <a href="addstudent.php" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    إضافة طالب جديد
                </a>
            </div>
        </div>
        <?php if ($students) : ?>
            <table class="table table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th>رقم الطالب</th>
                        <th>اسم الطالب</th>
                        <th>اسم الأب</th>
                        <th>سنة الطالب</th>
                        <th>صورة</th>
                        <th>تاريخ الميلاد</th>
                        <th>بريد إلكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>رقم هاتف ولي الامر</th>
                        <th>العنوان</th>
                        <th>
                            تحرير
                            <a href="#" class="btn btn-sm d-inline" onclick="selectAll()" title="تحديد الكل"><i class="bi bi-check2-all"></i></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td><?= $student['student_id'] ?></td>
                            <td><?= $student['student_name'] ?></td>
                            <td><?= $student['student_father_name'] ?></td>
                            <td><?= $student['student_grade'] ?></td>
                            <td>
                                <?php if ($student['student_image']) : ?>
                                    <img class="img-thumbnail" src="assets/images/<?= $student['student_image'] ?>" alt="<?= $student['student_image'] ?>" width="75px">
                                <?php else : ?>
                                    <img class="img-thumbnail" src="assets/images/user.webp" width="75px">
                                <?php endif; ?>
                            </td>
                            <td><?= $student['student_birth'] ?></td>
                            <td><?= $student['student_email'] ?></td>
                            <td><?= $student['student_number'] ?></td>
                            <td><?= $student['student_parent_number'] ?></td>
                            <td><?= $student['student_address'] ?></td>
                            <td>
                                <button class="btn btn-sm" onclick="del(<?= $student['student_id'] ?>)">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                                <button class="btn btn-sm" onclick="edit(<?= $student['student_id'] ?>)">
                                    <i class="bi bi-pencil text-primary"></i>
                                </button>
                                <input type="checkbox" value="<?= $student['id'] ?>" onchange="check()">
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <form action="inc/helper/modify_student.php?multi_delete" method="POST">
                <input type="hidden" id="checked" name="checked">
                <button type="submit" class="btn btn-danger float-end">حذف المحدد</button>
            </form>
        <?php else : ?>
            <div class="row text-center">
                <span class="text-dark"> لم يتم اضافة طلاب بعد </span>
            </div>
        <?php endif; ?>
    </section>
</main>
<script>
    function del(id) {
        Swal.fire({
            title: 'هل انت متأكد ؟',
            text: "لا يمكن التراجع عن هذه الخطوة",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'إلغاء',
            confirmButtonText: 'تأكيد'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = 'inc/helper/modify_student.php?confirm_delete&student_id=' + id;
            }
        })
    }

    function edit(id) {
        location.href = 'editstudent.php?student_id=' + id;
    }
</script>


<script>
    function check() {
        var array = []
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

        for (var i = 0; i < checkboxes.length; i++) {
            array.push(parseInt(checkboxes[i].value))
        }

        document.getElementById('checked').value = array
        console.log(array)
        console.log(document.getElementById('checked').value)
    }

    function selectAll() {
        var allchecked = document.querySelectorAll('input[type=checkbox]:checked')
        var checkboxes = document.querySelectorAll('input[type=checkbox]')

        if (allchecked.length == checkboxes.length) {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = false;
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = true;
            }

        }

        check();
    }
</script>

<?php if (isset($_GET['del_success'])) : ?>
    <script>
        Swal.fire('تم الحذف')
    </script>
<?php endif; ?>

<?php
require "template/footer.php"; // محتوى الفوتير
?>