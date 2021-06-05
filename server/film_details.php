<?php
require_once('Database.php');

$db = new Database();

if ($db->getInstance() === null) {
    die("No database connection");
}

try {
    $query = "SELECT * FROM film WHERE id = " . $_GET['id'];
    $result = $db->getInstance()->prepare($query);
    $result->execute();
    $row = $result->fetch();
    $query = null;

    $query2 = "SELECT * FROM v_film_detail_aktorzy WHERE id_film = " . $_GET['id'];
    $result2 = $db->getInstance()->prepare($query2);
    $result2->execute();
    $query2 = null;

    $query3 = "SELECT * FROM film_sceny WHERE id_film = " . $_GET['id'];
    $result3 = $db->getInstance()->prepare($query3);
    $result3->execute();
    $query3 = null;

    $query4 = "SELECT GROUP_CONCAT(gatunek) as gatunki FROM film_gatunek WHERE film_gatunek.id_film= " . $_GET['id'];
    $result4 = $db->getInstance()->prepare($query4);
    $result4->execute();
    $row4 = $result4->fetch();
    $query4 = null;

    $query5 = "SELECT * FROM v_filmy_rezysera WHERE id_film = " . $_GET['id'];
    $result5 = $db->getInstance()->prepare($query5);
    $result5->execute();
    $query5 = null;

    $query6 = "SELECT srednia, ilosc FROM v_oceny_film WHERE id_film = " . $_GET['id'];
    $result6 = $db->getInstance()->prepare($query6);
    $result6->execute();
    $row6 = $result6->fetch();
    $query6 = null;

    if (isset($_POST['comment_add'])) {
        $query7_1 = "SELECT id_uzytkownik FROM oceny WHERE id_film = " . $_GET['id'];
        $result7_1 = $db->getInstance()->prepare($query7_1);
        $result7_1->execute();
        $row7_1 = $result7_1->fetch();

        $query7 = "INSERT INTO oceny (id, id_film, id_uzytkownik, watrosc_oceny, komentarz)
                   VALUE (DEFAULT, ?, ?,? ,?)";
        $result7 = $db->getInstance()->prepare($query7);
        $result7->execute(array(
            $_GET['id'],
            $_SESSION['account_id'],
            $_POST['stars'],
            $_POST['comment']
        ));
        echo "<meta http-equiv='refresh' content='0'>";

    }

    $query8 = "SELECT * FROM v_oceny_user WHERE id_film = " . $_GET['id'];
    $result8 = $db->getInstance()->prepare($query8);
    $result8->execute();
    $query8 = null;

} catch (PDOException $e) {
    echo $e;
}