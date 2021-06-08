<?php
include '../modules/header.php';
?>
<div id="main">
    <article>
        <?php
        include '../server/film_edit.php';
        ?>
        <div class="form_center">
            <form method="get">
                <select class="form-select" aria-label=".form-select" name="id" required>
                    <option selected hidden value="">Wybierz film</option>
                    <?php
                    while ($opcja = $opcja_result->fetch()) {
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
    <?php
    if (isset($_GET['wybierz'])) {
        echo "<aside>";
        include "../modules/admin_comment_edit.php";
        echo "</aside>";
    }
    ?>
</div>
<?php
include '../modules/footer.html';
?>

