<?php
session_start();
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    if (!isset($_SESSION['max'])){
        $query = "SELECT count(*) FROM v_filmy_aktora";

        $result = $db->getInstance()->query($query);
        $_SESSION['max'] = $result->fetchColumn();
        $query = null;
    }


    if (!isset($_POST['next']) && !isset($_POST['previous'])) {
        $_SESSION['page_actor'] = 0;
    } else {
        if (isset($_POST['next'])) {
            $_SESSION['page_actor'] += 10;
            if ($_SESSION['page_actor'] > $_SESSION['max']){
                $_SESSION['page_actor'] -= 10;
            }
        } else {
            if ($_SESSION['page_actor'] > 9)
                $_SESSION['page_actor'] -= 10;
        }
    }

    $query = "SELECT * FROM v_filmy_aktora ORDER BY id limit " . $_SESSION['page_actor'] . ", 9";
    $result = $db->getInstance()->prepare($query);
    $result->execute();
    $query = null;

} catch (PDOException $e) {
    echo $e;
}