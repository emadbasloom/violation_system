<?php
require "inc/functions.php";

redirectNotAuthenticated('login.php');

// متغيرات الصفحة
$title = "ضبط مخالفة";
$violation_levels = select('violation_levels');
$violations = false;

if (isset($_GET['vid'])) {
    $violations = selectWhere('violations', 'violation_level_number = ' . $_GET['vid'], true);
}

require "template/header.php"; // محتوى الهيدر

?>
<main>
    <section class="container py-5">
        <div class="row">
            <div class="col-md-5">
                <h3>ضبط مخالفة</h3>
            </div>
        </div>
        <form action="inc/helper/create_violation.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <label class="mt-3" for="violation_level">مستوى المخالفة</label>
                    <select class="form-select mt-1" id="violation_level" name="violation_level" onchange="location = 'create_violation.php?vid=' + this.value;" required>
                        <option value="" selected disabled>مستوى المخالفة</option>
                        <?php foreach ($violation_levels as $violation_level) : ?>
                            <option value="<?= $violation_level['level_number'] ?>" <?php if (isset($_GET['vid'])) : ?> <?= $violation_level['level_number'] == $_GET['vid'] ? 'selected' : '' ?> <?php endif; ?>>
                                <?= $violation_level['level_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="ui-widget">
                        <label class="mt-3" for="student_name">اسم الطالب ( الطلاب )</label>
                        <input type="text" id="student_name" class="form-control mt-3" placeholder="اسم الطالب" autocomplete="off" required>
                        <input type="hidden" id="student_id" name="student_id">
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if ($violations) : ?>
                        <label class="text-dark mb-3">قائمة المخالفات</label>
                        <?php foreach ($violations as $violation) : ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="violation_id" id="violation_<?= $violation[0] ?>" value="<?= $violation[0] ?>" onchange="enableBtn()" required>
                                <label class="form-check-label" for="violation_<?= $violation[0] ?>">
                                    <?= $violation[1] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <span class="text-muted"> لم يتم انشاء مخالفات لهذا المستوى بعد</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="mt-3">
                        <label for="note" class="form-label">ملاحظات</label>
                        <textarea type="text" class="form-control" id="note" name="note" placeholder="ملاحظات (اختياري)"></textarea>
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="id">رفع ملف PDF (اختياري)</label>
                    <input type="file" class="form-control my-3" name="pdf_file" id="pdf" accept="application/pdf" placeholder="pdf">
                    <input class="form-check-input" type="checkbox" name="send_email" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        ارسال إلى ولي الامر
                    </label>

                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="create_violation" disabled="">تأكيد</button>
        </form>
    </section>
</main>
<?php if (isset($_GET['success'])) : ?>
    <script>
        Swal.fire('تم ضبط المخالفة')
    </script>
<?php endif; ?>
<?php if (isset($_GET['error'])) : ?>
    <script>
        Swal.fire('حدث خطأ ما')
    </script>
<?php endif; ?>

<script>
    let btn = document.getElementsByName('create_violation');

    function enableBtn() {
        if (document.querySelector('input[name="violation_id"]:checked').value != '') {
            btn[0].disabled = false
        }
    }
</script>

 <!-- مكتبات جيكويري غشان الاستعلام المباشر من قاعدة البيانات -->
<link rel="stylesheet" href="assets/css/jquery-ui.css">
<script src="assets/js/jquery-3.6.0.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
    var student_ids = [];

    // دالة من مكتبة جيكويري من اجل اخذ المدخلات من لوحة المفاتيح
    // والاستعلام عنها من الباك اند
    // وتخزين القيم في input مخفي اسمه student_id
    $(function() {
        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }


        $("#student_name")
            // don't navigate away from the field on tab when selecting an item
            .on("keydown", function(event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                source: function(request, response) {
                    $.getJSON("inc/helper/search.php", { // ارسال المدخلات إلى الباك اند
                        term: extractLast(request.term)
                    }, response);
                },
                search: function() {
                    // custom minLength
                    var term = extractLast(this.value);
                    if (term.length < 2) {
                        return false;
                    }
                },
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                select: function(event, ui) {
                    var terms = split(this.value);
                    student_ids.push(ui.item.id);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.value);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(", ");
                    $('#student_id').val(JSON.stringify(student_ids)); //store array
                    return false;
                }
            });
    });
</script>

<?php
require "template/footer.php"; // محتوى الفوتير
?>