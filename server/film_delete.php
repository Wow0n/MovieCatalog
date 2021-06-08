<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "SELECT id, tytul FROM film ORDER BY id";
    $result = $db->getInstance()->prepare($query);
    $result->execute();

} catch
(PDOException $e) {
    echo $e;
}