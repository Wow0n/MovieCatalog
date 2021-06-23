<h4>Edycja ocen i komentarzy</h4><hr>
<h5>Komentarze:</h5><br>
<?php

?>

<form method='post'>
<?php
include "../server/film_details.php";

if ($row6->ilosc > 0) {
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
    if (isset($_POST['film_comment_edit_admin'])) {
        $usuniete_komentarze = 0;
        $edytowane_komentarze = 0;

        $query = "SELECT * FROM v_oceny_user WHERE id_film = " . $_GET['id'];
        $result = $db->getInstance()->prepare($query);
        $result->execute();

        for ($i = 0; $i < count(array_filter($_POST['komentarz'])); $i++) {
            $row = $result->fetch();

            if ($_POST['komentarz'][$i] != $row->komentarz || $_POST['ocena'][$i] != $row->watrosc_oceny) {
                $query = "UPDATE oceny SET komentarz ='" . $_POST['komentarz'][$i] . "', watrosc_oceny = " . $_POST['ocena'][$i] .
                    " WHERE id =" . $_POST['id_opinia'][$i];
                $result = $db->getInstance()->prepare($query);
                $result->execute();
                $edytowane_komentarze += 1;
                $query = null;
            }
        }

        if ($_POST['chbx_delete'] != null) {
            for ($i = 0; $i < count(array_filter($_POST['chbx_delete'])); $i++) {
                $query = "DELETE FROM oceny where id = " . $_POST['chbx_delete'][$i];
                $result = $db->getInstance()->prepare($query);
                $result->execute();
                $usuniete_komentarze += 1;
                $query = null;
            }
        }
        echo "<br>Usunięto: $usuniete_komentarze | Zedytowano: $edytowane_komentarze";
        echo "<meta http-equiv='refresh' content='1'>";
    }
} else {
    echo "<h5>Brak ocen!</h5>";
}
