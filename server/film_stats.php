<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "SELECT imie, nazwisko, aktor_ur  FROM v_film_detail_aktorzy ORDER BY aktor_ur DESC LIMIT 3";
    $result_aktor_max = $db->getInstance()->prepare($query);
    $result_aktor_max->execute();

    $query = "SELECT distinct imie, nazwisko, rezyser_ur  FROM v_filmy_rezysera ORDER BY rezyser_ur DESC LIMIT 3";
    $result_rezyser_max = $db->getInstance()->prepare($query);
    $result_rezyser_max->execute();

    $query = "SELECT count(*) as ilosc, gatunek  FROM film_gatunek GROUP BY gatunek ORDER BY ilosc DESC";
    $result_liczba_gat = $db->getInstance()->prepare($query);
    $result_liczba_gat ->execute();

    $query = "SELECT  count(*) as ilosc, imie, nazwisko  FROM v_filmy_rezysera GROUP BY id_rezyser ORDER BY ilosc DESC LIMIT 3";
    $result_liczba_rez = $db->getInstance()->prepare($query);
    $result_liczba_rez ->execute();

    $query = "SELECT  count(*) as ilosc, imie, nazwisko  FROM v_film_detail_aktorzy GROUP BY id_aktor ORDER BY ilosc DESC LIMIT 3";
    $result_liczba_aktor = $db->getInstance()->prepare($query);
    $result_liczba_aktor ->execute();

    $query = "SELECT v_oceny_film.*, film.tytul FROM v_oceny_film, film WHERE v_oceny_film.id_film = film.id ORDER BY srednia DESC LIMIT 3";
    $result_oceny_avg = $db->getInstance()->prepare($query);
    $result_oceny_avg ->execute();

    $query = "SELECT v_oceny_film.*, film.tytul FROM v_oceny_film, film WHERE v_oceny_film.id_film = film.id ORDER BY ilosc DESC LIMIT 3";
    $result_oceny_ilosc = $db->getInstance()->prepare($query);
    $result_oceny_ilosc ->execute();

} catch
(PDOException $e) {
    echo $e;
}