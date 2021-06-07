<?php
include "header.php";
if (isset($_POST['film_dodaj_admin'])) {
    include '../server/film_insert_admin.php';
}
?><br>
    <div class="form_center">
        <form method="post">
            <div class="mb-3">
                <label for="Tytul" class="form-label">Tytul</label>
                <input type="text" maxlength="254" class="form-control" name="tytul" id="Tytul" required>
            </div>
            <div class="mb-3">
                <label for="premiera" class="form-label">Data premiery</label>
                <input type="date" class="form-control" name="premiera"
                       id="premiera" required>
            </div>
            Gatunki:
            <div class="form-check">
                <?php
                $array = array('Animacja', 'Komedia', 'Kryminalny', 'Akcji', 'Dramat', 'Eksperymentalny', 'Fantasy', 'Historyczny', 'Horror', 'Science Fiction', 'Thriller', 'Western', 'Inny');

                echo "<ul class='checkbox_gatunek'>";

                for ($i = 0; $i < 13; $i++) {
                    echo "<li><input class='form-check-input' type='checkbox' name='gatunek[]' value='$array[$i]' id='flexCheckDefault' required>
                                <label class='form-check-label' for='flexCheckDefault'>
                                    $array[$i]
                                </label></li>";
                }
                echo "</ul>";
                ?>
            </div>
            <div class="mb-3">
                <label for="czas" class="form-label">Czas trwania (w minutach)</label>
                <input type="number" min="0" max="1261" step="1" class="form-control" name="czas"
                       id="czas" required>
            </div>
            <div class="mb-3">
                <label for="opis" class="form-label">Opis filmu</label>
                <textarea class="form-control" name="opis" id="opis" rows="3" maxlength="1200" required></textarea>
            </div>
            <div class="input-group">
                <span class="input-group-text">Reżyser</span>
                <input type="text" aria-label="imie" class="form-control" maxlength="63" placeholder="Imie"
                       name="rezyser_imie" required>
                <input type="text" aria-label="nazwisko" class="form-control" maxlength="63"
                       placeholder="Nazwisko"
                       name="rezyser_nazwisko" required>
                <input type="text" aria-label="data_ur" class="form-control"
                       name="rezyser_data" placeholder="Data urodzenia" onfocus="(this.type='date')"
                       onblur="(this.type='text')" required>
            </div>
            <br>
            <?php
            for ($i = 1; $i <= 8; $i++) { ?>
                <div class="input-group">
                    <span class="input-group-text">Aktor nr <?= $i ?></span>
                    <input type="text" name="aktor_imie[]" aria-label="imie" class="form-control"
                           maxlength="63"
                           placeholder="Imie" <?php if ($i <= 2) {
                        echo "required";
                    } ?>>
                    <input type="text" name="aktor_nazwisko[]" aria-label="nazwisko" class="form-control"
                           maxlength="63"
                           placeholder="Nazwisko" <?php if ($i <= 2) {
                        echo "required";
                    } ?>>
                    <input type="text" name="aktor_data[]>" aria-label="data_ur" class="form-control"
                           placeholder="Data urodzenia" onfocus="(this.type='date')"
                           onblur="(this.type='text')" <?php if ($i <= 2) {
                        echo "required";
                    } ?>>
                    <input type="text" name="aktor_rola[]" aria-label="rola" class="form-control"
                           maxlength="254"
                           placeholder="Rola" <?php if ($i <= 2) {
                        echo "required";
                    } ?>>
                </div>
                <?php
            }
            ?>
            <br>
            <div class="mb-3">
                <label for="link_mb" class="form-label">Link do themoviedb</label>
                <input type="text" maxlength="254" class="form-control" name="moviedb" id="link_mb" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="link_plakat" class="form-label">Link do plakatu</label>
                <input type="text" maxlength="254" class="form-control" name="plakat" id="link_plakat" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="link_yt" class="form-label">Link do zwiastunu</label>
                <input type="text" maxlength="254" class="form-control" name="link_yt" id="link_yt">
            </div>
            <?php
            for ($i = 1;
            $i <= 5;
            $i++) { ?>
            <div class="input-group mb-3">
                <span class="input-group-text" id="scena">Scena <?= $i ?></span>
                <input type="text" class="form-control" name="scena[]" aria-label="scena"
                       aria-describedby="scena" <?php if ($i <= 2) echo "required";
                echo ">";
                echo "</div>";
                } ?>
                <button type="submit" id="film_dodaj" name="film_dodaj_admin" class="btn btn-outline-success">Dodaj
                </button>
        </form>
    </div>
    <br>
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
include "footer.html";
