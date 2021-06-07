<?php
include '../modules/header.php';
include '../server/film_edit.php';
?>
<div id="main">
    <article>
        <div class="form_center">
            <form method="get">
                <select class="form-select" aria-label=".form-select" name="id" required>
                    <option selected hidden>Wybierz film</option>
                    <?php
                    while ($opcja = $result->fetch()) {
                        echo "<option value=" . $opcja->id . ">$opcja->tytul</option>";
                    }
                    ?>
                </select><br>
                <button type="submit" name="wybierz" class="btn btn-outline-success">Wybierz</button>
            </form>
            <?php
            include '../modules/admin_film_edit.php';
            ?>
        </div>
    </article>
</div>
<script type="text/javascript">
    $(function () {
        var requiredCheckboxes = $('.form-check :checkbox[required]');
        requiredCheckboxes.change(function () {
            if (requiredCheckboxes.is(':checked')) {
                requiredCheckboxes.removeAttr('required');
            } else {
                requiredCheckboxes.attr('required', 'required');
            }
        });
    });
</script>
<?php
include '../modules/footer.html';
?>

