<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');
error403();

$users = select('users');
// متغيرات الصفحة
$title = "قائمة المستخدمين";

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <a href="adduser.php" class="btn btn-primary">
                    <i class="bi bi-plus"></i>
                    إضافة مستخدم جديد
                </a>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الالكتروني</th>
                    <th>الصلاحية</th>
                    <th>تحرير</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['full_name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['is_admin']  ? 'أدمن' : 'عادي' ?></td>
                        <td class="w-25">
                            <form action="inc/helper/make_admin.php" method="get">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <select name="user_type">
                                    <option value="">اختيارات</option>
                                    <option value="0">مستخدم عادي</option>
                                    <option value="1">أدمن</option>
                                </select>
                                <button class="btn btn-sm btn-primary" type="submit" name="make_admin">تأكيد</button>
                            </form>
                            <span>
                                <button class="btn" onclick="del(<?= $user['id'] ?>)">
                                    <i class="bi bi-trash text-danger"></i>
                                    حذف المستخدم
                                </button>
                            </span>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
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
                location.href = 'inc/helper/remove_user.php?confirm_delete&id=' + id;
            }
        })
    }
</script>

<?php
require "template/footer.php"; // محتوى الفوتير
?>