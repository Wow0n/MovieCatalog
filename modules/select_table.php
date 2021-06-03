<?php
require_once('../server/Database.php');
include '../server/select.php';

if ($result->rowCount() != 0) {
    echo "<br><table class='table table-striped w-50'>
    <thead>
    <tr class='text-center'>
        <th scope='col'>Plakat</th>
        <th scope='col'>Tytul</th>
        <th scope='col'>Gatunek</th>
        <th scope='col'>Oceny</th>
    </tr>
    </thead>
    <tbody>";


    while ($row = $result->fetch()) {
        echo "<tr class='text-center'>";
        echo "<td class='table_row'><img class='img-fluid' src='" . $row->link_plakat . "' alt='plakat'></td>";
        echo "<td class='table_row'><p>" . $row->tytul . "</p></td>";
        echo "<td class='table_row'><p>" . $row->gatunek . "</p></td>";

        if ($row->ilosc_ocen != 0) {
            echo "<td class='table_row'><p>" . $row->srednia_ocen . " (" . $row->ilosc_ocen . ")</p></td>";
        } else {
            echo "<td class='table_row'><p>Brak ocen!</p></td>";
        }

        echo "</tr>";
    }
    echo " </tbody></table>";

}
else {
    echo "Tytuł lub gatunek zawierający \"" . $_POST['phrase'] . "\" nie istnieje w bazie!";

}