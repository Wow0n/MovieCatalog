<?php if (isset($_GET['wybierz'])) {
    include "../server/film_details.php";
    ?>
    <br>
    <hr>
    <form method="post">
        <div class="mb-3">
            <label for="Tytul" class="form-label">Tytul</label>
            <input type="text" maxlength="254" class="form-control" name="tytul"
                   id="Tytul" <?php echo "value='$row->tytul'" ?> required>
        </div>
        <div class="mb-3">
            <label for="premiera" class="form-label">Data premiery</label>
            <input type="date" class="form-control" name="premiera"
                   id="premiera" <?php echo "value='$row->data_premiery'" ?> required>
        </div>
        Gatunki:
        <div class="form-check">
            <?php
            $array = array('Animacja', 'Komedia', 'Kryminalny', 'Akcji', 'Dramat', 'Eksperymentalny', 'Fantasy', 'Historyczny', 'Horror', 'Science Fiction', 'Thriller', 'Western', 'Inny');

            echo "<ul class='checkbox_gatunek'>";

            for ($i = 0; $i < 13; $i++) {
                echo "<li><input class='form-check-input' type='checkbox' name='gatunek[]' value='$array[$i]' id='flexCheckDefault'";
                if (str_contains($row4->gatunki, $array[$i])) {
                    echo " checked ";
                }
                echo "required>
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
                   id="czas" <?php echo "value='$row->czas_trwania'" ?> required>
        </div>
        <div class="mb-3">
            <label for="opis" class="form-label">Opis filmu</label>
            <textarea class="form-control" name="opis" id="opis" rows="5" maxlength="1200"
                      required><?php echo $row->opis ?></textarea>
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
        for ($i = 1; $i <= 8; $i++) {
            $row2 = $result2->fetch();
            ?>
            <div class="input-group">
                <span class="input-group-text">Aktor nr <?= $i ?></span>
                <input type="text" name="aktor_imie[]" aria-label="imie" class="form-control"
                       maxlength="63"
                       placeholder="Imie" <?php echo "value='$row2->imie'"; if ($i <= 2) {
                    echo "required";
                } ?>>
                <input type="text" name="aktor_nazwisko[]" aria-label="nazwisko" class="form-control"
                       maxlength="63"
                       placeholder="Nazwisko" <?php echo "value='$row2->nazwisko'"; if ($i <= 2) {
                    echo "required";
                } ?>>
                <input type="text" name="aktor_data[]>" aria-label="data_ur" class="form-control"
                       placeholder="Data urodzenia" onfocus="(this.type='date')"
                       onblur="(this.type='text')" <?php echo "value='$row2->data_urodzenia'"; if ($i <= 2) {
                    echo "required";
                } ?>>
                <input type="text" name="aktor_rola[]" aria-label="rola" class="form-control"
                       maxlength="254"
                       placeholder="Rola" <?php echo "value='$row2->rola'"; if ($i <= 2) {
                    echo "required";
                } ?>>
            </div>
            <?php
        }
        ?>
        <br>
        <div class="mb-3">
            <label for="link_mb" class="form-label">Link do themoviedb</label>
            <input type="text" maxlength="254" class="form-control" name="moviedb"
                   id="link_mb" <?php echo "value='$row->link_ogolny'" ?> required>
        </div>
        <br>
        <div class="mb-3">
            <label for="link_plakat" class="form-label">Link do plakatu</label>
            <input type="text" maxlength="254" class="form-control" name="plakat"
                   id="link_plakat" <?php echo "value='$row->link_plakat'" ?> required>
        </div>
        <br>
        <div class="mb-3">
            <label for="link_yt" class="form-label">Link do zwiastunu</label>
            <input type="text" maxlength="254" class="form-control" name="link_yt"
                   id="link_yt" <?php echo "value='$row->link_zwiastun'" ?>>
        </div>
        <?php
        for ($i = 1; $i <= 5; $i++) { ?>
        <div class="input-group mb-3">
            <span class="input-group-text" id="scena">Scena <?= $i ?></span>
            <input type="text" class="form-control" name="scena[]" aria-label="scena"
                   aria-describedby="scena"
            <?php echo "value='" . $result3->fetch()->link_scena . "'"; if ($i <= 2) echo "required";
            echo ">";
            echo "</div>";
            } ?>
            <button type="submit" id="film_dodaj" name="film_dodaj_admin" class="btn btn-outline-success">Dodaj
            </button>
    </form>
<?php }
