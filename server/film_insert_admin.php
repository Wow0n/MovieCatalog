<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "SELECT id FROM film WHERE tytul = '" . $_POST['tytul'] . "'";
    $result = $db->getInstance()->prepare($query);
    $result->execute();
    $film_id_check = $result->fetch();

    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $_POST['link_yt'], $match);
    $link = "https://www.youtube.com/embed/$match[1]";

    if ($film_id_check == null) {
        $query = "INSERT INTO film (id, tytul, data_premiery, czas_trwania, opis, link_ogolny, link_plakat, link_zwiastun, popularnosc)
            VALUES (DEFAULT,?,?,?,?,?,?,?,DEFAULT)";
        $result = $db->getInstance()->prepare($query);
        $result->execute(array(
            $_POST['tytul'],
            $_POST['premiera'],
            $_POST['czas'],
            $_POST['opis'],
            $_POST['moviedb'],
            $_POST['plakat'],
            $link,
        ));
    }

    $query = "SELECT id FROM film WHERE tytul = '" . $_POST['tytul'] . "'";
    $result = $db->getInstance()->prepare($query);
    $result->execute();
    $film_id = $result->fetch();

    for ($i = 0; $i < count(array_filter($_POST['aktor_imie'])); $i++) {
        $query_id_aktor = "SELECT id FROM aktor WHERE data_urodzenia = '" . $_POST['aktor_data'][$i] . "' AND nazwisko = '" . $_POST['aktor_nazwisko'][$i] . "'";
        $result = $db->getInstance()->prepare($query_id_aktor);
        $result->execute();
        $aktor_id = $result->fetch();

        if ($aktor_id->id == null) {
            $query = "INSERT INTO aktor (id, imie, nazwisko, data_urodzenia) VALUES (DEFAULT,?,?,?)";
            $result = $db->getInstance()->prepare($query);
            $result->execute(array(
                $_POST['aktor_imie'][$i],
                $_POST['aktor_nazwisko'][$i],
                $_POST['aktor_data'][$i],
            ));

            $result = $db->getInstance()->prepare($query_id_aktor);
            $result->execute();
            $aktor_id = $result->fetch();
        }

        $query = "SELECT * FROM film_aktorzy WHERE id_aktor = $aktor_id->id and id_film = $film_id->id and rola = '" . $_POST['aktor_rola'][$i] . "'";
        $result = $db->getInstance()->prepare($query);
        $result->execute();
        $row = $result->fetch();

        if (!$row) {
            $query = "INSERT INTO film_aktorzy (id, id_film, id_aktor, rola) VALUES (DEFAULT,?,?,?)";
            $result = $db->getInstance()->prepare($query);
            $result->execute(array(
                $film_id->id,
                $aktor_id->id,
                $_POST['aktor_rola'][$i]
            ));
        }
    }

    $query = "SELECT * FROM film_gatunek WHERE id_film = $film_id->id";
    $result = $db->getInstance()->prepare($query);
    $result->execute();
    $gatunki = $result->fetch();

    if ($gatunki == null) {
        $dl = count($_POST['gatunek']);
        $query = "INSERT INTO film_gatunek (id_film, gatunek) VALUES ";
        for ($i = 0; $i < $dl; $i++) {
            if ($i + 1 == $dl) {
                $query .= "($film_id->id, '" . $_POST['gatunek'][$i] . "')";
            } else {
                $query .= "($film_id->id, '" . $_POST['gatunek'][$i] . "'), ";
            }
        }
        $result = $db->getInstance()->prepare($query);
        $result->execute();
    }

    $query_id_rezyser = "SELECT id FROM rezyser WHERE data_urodzenia = '" . $_POST['rezyser_data'] . "' AND nazwisko = '" . $_POST['rezyser_nazwisko'] . "'";

    $result = $db->getInstance()->prepare($query_id_rezyser);
    $result->execute();
    $rezyser_id = $result->fetch();

    if ($rezyser_id->id == null) {
        $query = "INSERT INTO rezyser (id, imie, nazwisko, data_urodzenia) VALUES (DEFAULT,?,?,?)";
        $result = $db->getInstance()->prepare($query);
        $result->execute(array(
            $_POST['rezyser_imie'],
            $_POST['rezyser_nazwisko'],
            $_POST['rezyser_data'],
        ));
        $result = $db->getInstance()->prepare($query_id_rezyser);
        $result->execute();
        $rezyser_id = $result->fetch();
    }


    $query = "SELECT * FROM film_rezyser WHERE id_rezyser = $rezyser_id->id and id_film = $film_id->id";
    $result = $db->getInstance()->prepare($query);
    $result->execute();
    $row = $result->fetch();

    if (!$row) {
        $query = "INSERT INTO film_rezyser (id_film, id_rezyser) VALUE ($film_id->id, $rezyser_id->id)";
        $result = $db->getInstance()->prepare($query);
        $result->execute();
    }

    for ($i = 0; $i < count(array_filter($_POST['scena'])); $i++) {
        $query = "INSERT INTO film_sceny (id_film, link_scena) VALUE ($film_id->id, '" . $_POST['scena'][$i] . "')";
        $result = $db->getInstance()->prepare($query);
        $result->execute();
    }
    echo "Film dodano poprawnie!";
    header("Refresh:2; url=../index.php");
} catch
(PDOException $e) {
    echo $e;
}