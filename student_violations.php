<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

if (!empty($_GET['student_id'])) {
    $student_violations = getStudentViolations($_GET['student_id']);
} else {
    $student_violations = getStudentsViolations();
}

// متغيرات الصفحة
$title = "قائمة المخالفات";

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-2">
                <a href="create_violation.php" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    ضبط مخالفة
                </a>
            </div>
            <div class="col-md">
                <form action="student_violations.php" method="GET">
                    <label for="student_id">البحث عن مخالفات الطالب</label>
                    <input type="number" name="student_id" id="student_id" placeholder="ادخل رقم الطالب">
                    <button type="submit" name="search" class="btn btn-primary ms-2">
                        <i class="bi bi-plus"></i>
                        بحث
                    </button type="submit">
                </form>
            </div>
        </div>
        <?php if ($student_violations) : ?>
            <table class="table table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الطالب</th>
                        <th>اسم الطالب</th>
                        <th>مستوى المخالفة</th>
                        <th class="w-25">المخالفة</th>
                        <th>ملاحظات</th>
                        <th>pdf</th>
                        <th>تاريخ المخالفة</th>
                        <th>
                            تحرير
                            <a href="#" class="btn btn-sm d-inline" onclick="selectAll()" title="تحديد الكل"><i class="bi bi-check2-all"></i></a>
                        </th>
                    </tr>
                </thead>


                <tbody>
                    <?php foreach ($student_violations as $student_violation) : ?>
                        <tr>
                            <td><?= $student_violation[0] ?></td>
                            <td><?= $student_violation[7] ?></td>
                            <td><?= $student_violation[8] ?></td>
                            <td><?= $student_violation[19] ?></td>
                            <td><?= $student_violation[18] ?></td>
                            <td><?= $student_violation[3] ? $student_violation[3] : '' ?></td>
                            <td class="text-center">
                                <?php if (!empty($student_violation[4])) : ?>
                                    <a href="assets/pdf/<?= $student_violation[4] ?>" download>
                                        <i class="bi bi-filetype-pdf fs-5"></i>
                                    </a>
                                <?php else : ?>
                                    لا يوجد
                                <?php endif ?>

                            </td>
                            <td><?= $student_violation[5] ?></td>
                            <td>
                                <span>
                                    <button class="btn" onclick="del(<?= $student_violation[0] ?>)">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </span>
                                <input type="checkbox" value="<?= $student_violation[0] ?>" onchange="check()">
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <form action="inc/helper/remove_student_violation.php?multi_delete" method="POST">
                <input type="hidden" id="checked" name="checked">
                <button type="submit" class="btn btn-danger float-end">حذف المحدد</button>
            </form>
        <?php else : ?>
            <div class="row text-center">
                <span class="text-dark"> لم يتم اضافة مخالفات بعد </span>
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
                location.href = 'inc/helper/remove_student_violation.php?confirm_delete&id=' + id;
            }
        })
    }
</script>
<?php if (isset($_GET['del_success'])) : ?>
    <script>
        Swal.fire('تم حذف المخالفة')
    </script>
<?php endif; ?>

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

<?php
require "template/footer.php"; // محتوى الفوتير
?>