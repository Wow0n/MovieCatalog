<?php
session_start();
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    if (!isset($_SESSION['max_film'])){
        $query = "SELECT count(*) FROM v_select";

        $result = $db->getInstance()->query($query);
        $_SESSION['max_film'] = $result->fetchColumn();
        $query = null;
    }

    if (!isset($_POST['next']) && !isset($_POST['previous'])) {
        $_SESSION['page_film'] = 0;
    } else {
        if (isset($_POST['next'])) {
            $_SESSION['page_film'] += 3;
            if ($_SESSION['page_film'] > $_SESSION['max_film']){
                $_SESSION['page_film'] -= 3;
            }
        } else {
            if ($_SESSION['page_film'] > 2)
                $_SESSION['page_film'] -= 3;
        }
    }

    $query = "SELECT * FROM v_select WHERE tytul like '%" . $_POST['phrase'] . "%' or  gatunek like '%"
        . $_POST['phrase'] . "%' ORDER BY tytul limit " . $_SESSION['page_film'] . ", 3";

    $result = $db->getInstance()->prepare($query);

    $result->execute();
    $query = null;

} catch (PDOException $e) {
    echo $e;
}