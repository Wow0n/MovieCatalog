<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "INSERT INTO uzytkownicy (id, rola, email, haslo) VALUE (DEFAULT,DEFAULT,?,?)";
    $result = $db->getInstance()->prepare($query);
    $result->execute(array(
        $_POST['email'],
        password_hash($_POST['password'], PASSWORD_DEFAULT)
    ));
    echo "Konto utworzono pomyslnie!";
} catch
(PDOException $e) {
    echo "Konto na podany mail juz istnieje!";
}