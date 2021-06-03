<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "SELECT * FROM v_select";
    $result = $db->getInstance()->prepare($query);

    $result->execute();

} catch (PDOException $e) {
    echo $e;
}