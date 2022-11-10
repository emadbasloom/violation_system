<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');
error403();

$violation_levels = select('violation_levels');

// متغيرات الصفحة
$title = "إضافة مخالفة";
$violation = selectWhere('violations', 'id = ' . $_GET['id']);

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <form action="inc/helper/update_violation.php" method="POST">
                    <input type="hidden" name="violation_id" value="<?= $violation->id ?>">
                    <div class="mb-3">
                        <label for="violation_name" class="form-label">نص المخالفة</label>
                        <textarea type="text" class="form-control" id="violation_name" name="violation_name" placeholder="نص المخالفة" required><?= $violation->violation_name ?></textarea>
                    </div>
                    <div class="mb-3">
                        <select class="form-select form-select-lg mb-3" name="violation_level" aria-label=".form-select-lg example">
                            <option selected>مستوى المخالفة</option>
                            <?php foreach ($violation_levels as $violation_level) : ?>
                                <option value="<?= $violation_level['level_number'] ?>"
                                    <?= $violation->violation_level_number == $violation_level['level_number'] ? 'selected' : '' ?>>
                                    <?= $violation_level['level_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_violation">حفظ التعديل</button>
                </form>
            </div>
        </div>

    </section>
</main>
<?php
require "template/footer.php"; // محتوى الفوتير
?>