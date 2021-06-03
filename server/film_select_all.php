<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "SELECT * FROM v_select ORDER BY tytul";
    $result = $db->getInstance()->prepare($query);

    $result->execute();
    $query = null;

} catch (PDOException $e) {
    echo $e;
}