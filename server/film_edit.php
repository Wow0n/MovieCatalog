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
    }
} catch
(PDOException $e) {
    echo $e;
}