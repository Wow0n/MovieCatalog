<div id="main">
    <article>
        <form method="post">
            <button type="submit" id="film_dodaj" name="film_dodaj_przycisk" class="btn btn-outline-success">
                Dodaj film
            </button>
            <button type="submit" id="film_edytuj" name="film_edytuj_przycisk" class="btn btn-outline-success">
                Edytuj film
            </button>
            <button type="submit" id="film_usun" name="film_usun_przycisk" class="btn btn-outline-success">
                Usuń film
            </button>
        </form>
        <?php
        if (isset($_POST['film_dodaj_przycisk'])) {
            include '../modules/add_film_admin.php';
        }
        if (isset($_POST['film_edytuj_przycisk'])) {
            include '../modules/admin_film_edit.php';
        }
        ?>
    </article>
</div>
