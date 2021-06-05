<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "INSERT INTO uzytkownicy (id, rola, email, haslo, login) VALUE (DEFAULT,DEFAULT,?,?,?)";
    $result = $db->getInstance()->prepare($query);
    $result->execute(array(
        $_POST['email'],
        password_hash($_POST['password'], PASSWORD_DEFAULT),
        $_POST['login']
    ));
    echo "Konto utworzono pomyslnie!";
    header("Refresh:2; url=../controllers/sign_in.php");
} catch
(PDOException $e) {
    echo "Konto na podany mail lub login juz istnieje!";
}