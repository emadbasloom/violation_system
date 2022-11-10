<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');
error403();

$violations = select('violations');

// متغيرات الصفحة
$title = "لائحة السلوك";
$i = 0; // من اجل ترقيم اسطر الجدول

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <a href="addviolation.php" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    إضافة مخالفة جديدة على النظام
                </a>
            </div>
        </div>
        <?php if ($violations) : ?>
            <table class="table table-striped table-hover mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المخالفة</th>
                        <th>مستوى المخالفة</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($violations as $violation) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $violation['violation_name'] ?></td>
                            <td><?= $violation['violation_level_number'] ?></td>
                            <td>
                                <button class="btn btn-sm" onclick="del(<?= $violation['id'] ?>)">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                                <button class="btn btn-sm" onclick="edit(<?= $violation['id'] ?>)">
                                    <i class="bi bi-pencil text-primary"></i>
                                </button>
                                <input type="checkbox" value="<?= $violation['id'] ?>" onchange="check()">
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <form action="inc/helper/remove_violation.php?multi_delete" method="POST">
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
<?php if (isset($_GET['del_success'])) : ?>
    <script>
        Swal.fire('تم حذف المخالفة')
    </script>
<?php endif; ?>
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
                location.href = 'inc/helper/remove_violation.php?confirm_delete&id=' + id;
            }
        })
    }

    function edit(id) {
        location.href = 'editviolation.php?id=' + id;
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
</script>

<?php
require "template/footer.php"; // محتوى الفوتير
?>