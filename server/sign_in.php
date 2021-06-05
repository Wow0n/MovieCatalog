<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "SELECT email, haslo, rola FROM uzytkownicy WHERE email = '" . $_POST['email'] . "'";
    $result = $db->getInstance()->prepare($query);
    $result->execute();
    $acc = $result->fetch();

    if (password_verify($_POST['password'], $acc->haslo)) {
        echo "Logowanie poprawne!";
        $_SESSION['account_role'] = $acc->rola;
        $_SESSION['account_name'] = $acc->email;
        header("Refresh:2; url=../index.php");
    } else {
        echo "Błąd!";
    }
} catch
(PDOException $e) {
    echo $e;
}