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

    echo $_SESSION['max'];
    if (!isset($_POST['next']) && !isset($_POST['previous'])) {
        $_SESSION['page_actor'] = 0;
    } else {
        if (isset($_POST['next'])) {
            $_SESSION['page_actor'] += 9;
        } else {
            if ($_SESSION['page_actor'] != 0)
                $_SESSION['page_actor'] -= 9;
        }
    }

    $query = "SELECT * FROM v_filmy_aktora ORDER BY id limit " . $_SESSION['page_actor'] . ", 9";

    $result = $db->getInstance()->prepare($query);
    $result->execute();
    $query = null;

} catch (PDOException $e) {
    echo $e;
}