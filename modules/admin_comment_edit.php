<?php
include "../server/film_details.php";

echo "<h4>Edycja ocen i komentarzy</h4><hr>";
if ($row6->ilosc > 0) {
    echo "<h5>Komentarze:</h5><br><form method='post'>";
    while ($row8 = $result8->fetch()) {
        if ($row8->login == null) {
            echo "<br>Gość:";
        } else {
            echo "<br>$row8->login:";
        }
        echo "<div class='form-check'>
            <input class='form-check-input' type='checkbox' name='chbx_delete[]' value='" . $row8->id . "' id='chbx_delete'>
                <label class='form-check-label' for='chbx_delete'>
                    Usunąć?
                </label>
            </div>
            <div class='input-group mb-3'>
                <span class='input-group-text' id='ocena'>Ocena</span>
                <input type='number' min='1' max='5' step='1' class='form-control' 
                name='ocena[]' id='ocena' value='$row8->watrosc_oceny' required>
            </div>
            <div class='input-group'>
                <span class='input-group-text'>Komentarz</span>
                <textarea class='form-control' name='komentarz[]' aria-label='With textarea'>$row8->komentarz</textarea>
            </div>
            <input id='id_opinia' name='id_opinia[]' type='hidden' value='$row8->id'>
            <br>";
    }
    ?>
    <button type="submit" id="comment_edit" name="film_comment_edit_admin" class="btn btn-outline-success">Edytuj
        Komentarze
    </button>
    </form>
    <?php
} else {
    echo "<h5>Brak ocen!</h5>";
}
