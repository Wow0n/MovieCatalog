<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "SELECT id, tytul FROM film ORDER BY id";
    $opcja_result = $db->getInstance()->prepare($query);
    $opcja_result->execute();

    if (isset($_POST['film_edit_admin'])) {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $_POST['link_yt'], $match);
        $link = "https://www.youtube.com/embed/$match[1]";

        $query = "UPDATE film SET tytul = '" . $_POST['tytul'] . "', data_premiery = '" . $_POST['premiera'] . "',
        czas_trwania = " . $_POST['czas'] . ", opis = '" . $_POST['opis'] . "', link_ogolny = '" . $_POST['moviedb'] . "',
        link_plakat = '" . $_POST['plakat'] . "', link_zwiastun = '$link' WHERE id = " . $_GET['id'];
        $result = $db->getInstance()->prepare($query);
        $result->execute();


        for ($i = 0; $i < count($_POST['gatunek']); $i++) {
            $query = "UPDATE film_gatunek SET gatunek = '" . $_POST['gatunek'][$i] . "' WHERE id_film = " . $_GET['id'];
            $result = $db->getInstance()->prepare($query);
            $result->execute();
        }


        for ($i = 0; $i < count($_POST['id_scena']); $i++) {
            if ($_POST['id_scena'][$i] != null) {
                $query = "UPDATE film_sceny SET link_scena = '" . $_POST['scena'][$i] . "' WHERE id_film = " . $_GET['id'] . " AND id = " . $_POST['id_scena'][$i];
                $result = $db->getInstance()->prepare($query);
                $result->execute();
            } else {
                $query = "INSERT INTO film_sceny (id_film, link_scena, id) VALUE (?,?,DEFAULT)";
                $result = $db->getInstance()->prepare($query);
                $result->execute(array(
                    $_GET['id'],
                    $_POST['id_scena'][$i]
                ));
            }
        }

        $query = "SELECT count(*) AS ilosc, id_rezyser FROM v_filmy_rezysera WHERE id_rezyser = " . $_POST['id_rezyser'];
        $result = $db->getInstance()->prepare($query);
        $result->execute();
        $rezyser_ilosc = $result->fetch();

        $query = "DELETE FROM film_rezyser where id_rezyser = " . $rezyser_ilosc->id_rezyser . " AND id_film = " . $_GET['id'];
        $result = $db->getInstance()->prepare($query);
        $result->execute();

        if ($rezyser_ilosc->ilosc <= 1) {
            $query = "DELETE FROM rezyser where id = " . $rezyser_ilosc->id_rezyser;
            $result = $db->getInstance()->prepare($query);
            $result->execute();
        }

        $query = "SELECT * FROM rezyser WHERE data_urodzenia = '" . $_POST['rezyser_data'] .
            "' AND nazwisko = '" . $_POST['rezyser_nazwisko'] . "' AND imie = '" . $_POST['rezyser_imie'] . "'";
        $result = $db->getInstance()->prepare($query);
        $result->execute();
        $rezyser_dane = $result->fetch();

        if ($rezyser_dane == null) {
            $query = "INSERT INTO rezyser (id, imie, nazwisko, data_urodzenia) VALUE (DEFAULT, ?, ?,?)";
            $result = $db->getInstance()->prepare($query);
            $result->execute(array(
                $_POST['rezyser_imie'],
                $_POST['rezyser_nazwisko'],
                $_POST['rezyser_data'],
            ));

            $query = "SELECT id FROM rezyser WHERE data_urodzenia = '" . $_POST['rezyser_data'] .
                "' AND nazwisko = '" . $_POST['rezyser_nazwisko'] . "' AND imie = '" . $_POST['rezyser_imie'] . "'";
            $result = $db->getInstance()->prepare($query);
            $result->execute();
            $rezyser_dane = $result->fetch();
        }

        $query = "INSERT INTO film_rezyser (id_film, id_rezyser) VALUE (" . $_GET['id'] . ",$rezyser_dane->id)";
        $result = $db->getInstance()->prepare($query);
        $result->execute();

        for ($i = 0; $i < count(array_filter($_POST['aktor_nazwisko'])); $i++) {
            $query = "SELECT * FROM aktor WHERE data_urodzenia = '" . $_POST['aktor_data'][$i] .
                "' AND nazwisko = '" . $_POST['aktor_nazwisko'][$i] . "' AND imie = '" . $_POST['aktor_imie'][$i] . "'";
            $result = $db->getInstance()->prepare($query);
            $result->execute();
            $aktor_dane = $result->fetch();

            if ($aktor_dane->id == null){
                $query = "INSERT INTO aktor (id, imie, nazwisko, data_urodzenia) VALUE (DEFAULT, ?, ?,?)";
                $result = $db->getInstance()->prepare($query);
                $result->execute(array(
                    $_POST['aktor_imie'][$i],
                    $_POST['aktor_nazwisko'][$i],
                    $_POST['aktor_data'][$i]
                ));
            } else {
                $query = "SELECT count(*) AS ilosc, id_aktor, id_film FROM v_film_detail_aktorzy WHERE id_aktor = " . $_POST['id_aktor'][$i];
                $result = $db->getInstance()->prepare($query);
                $result->execute();
                $aktor_ilosc = $result->fetch();

                $query = "DELETE FROM film_aktorzy where id_aktor = $aktor_ilosc->id_aktor AND id_film = " . $aktor_ilosc->id_film;
                $result = $db->getInstance()->prepare($query);
                $result->execute();

                if ($aktor_ilosc->ilosc <= 1) {
                    $query = "DELETE FROM aktor where id = $aktor_ilosc->id_aktor";
                    $result = $db->getInstance()->prepare($query);
                    $result->execute();
                }

                $query = "INSERT INTO aktor (id, imie, nazwisko, data_urodzenia) VALUE (DEFAULT, ?, ?,?)";
                $result = $db->getInstance()->prepare($query);
                $result->execute(array(
                    $_POST['aktor_imie'][$i],
                    $_POST['aktor_nazwisko'][$i],
                    $_POST['aktor_data'][$i]
                ));

                $query = "SELECT * FROM aktor WHERE data_urodzenia = '" . $_POST['aktor_data'][$i] .
                    "' AND nazwisko = '" . $_POST['aktor_nazwisko'][$i] . "' AND imie = '" . $_POST['aktor_imie'][$i] . "'";
                $result = $db->getInstance()->prepare($query);
                $result->execute();
                $aktor_dane = $result->fetch();
            }

            $query = "INSERT INTO film_aktorzy (id_film, id_aktor, rola) VALUE (" . $_GET['id'] . ",$aktor_dane->id,'" . $_POST['aktor_rola'][$i] . "')";
            echo $query;
            $result = $db->getInstance()->prepare($query);
            $result->execute();
        }

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
            echo "Komentarze:<br>Usunięto: $usuniete_komentarze | Zedytowano: $edytowane_komentarze";
        }
    }
} catch
(PDOException $e) {
    echo $e;
}