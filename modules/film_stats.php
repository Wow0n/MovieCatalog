<?php
include '../server/film_stats.php';

echo "<br><div class='text-center'>";
echo "<h3>Najwyżej oceniane filmy</h3><table class='table table-striped table-hover w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Tytuł</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Średnia ocen</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $result_oceny_avg->fetch()) {
    echo "<tr class='text-center' style='transform: rotate(0);'>
                <td class='table_row'><p>" . $row->tytul . "</p></td>
                <td class='table_row'><p>" . $row->srednia . " (" . $row->ilosc . ")</p></td>
              </tr>";
}
echo "</tbody></table><br>";

//

echo "<h3>Najchętniej oceniane filmy</h3><table class='table table-striped table-hover w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Tytuł</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Ilość ocen</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $result_oceny_ilosc->fetch()) {
    echo "<tr class='text-center' style='transform: rotate(0);'>
                <td class='table_row'><p>" . $row->tytul . "</p></td>
                <td class='table_row'><p>" . $row->ilosc . "</p></td>
              </tr>";
}
echo "</tbody></table><br>";

//

echo "<h3>Ilość filmów o danym gatunku</h3><table class='table table-striped table-hover w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Imie</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Nazwisko</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $result_liczba_gat->fetch()) {
    echo "<tr class='text-center' style='transform: rotate(0);'>
                <td class='table_row'><p>" . $row->gatunek . "</p></td>
                <td class='table_row'><p>" . $row->ilosc . "</p></td>
              </tr>";
}
echo "</tbody></table><br>";

//

echo "<h3>Reżyserzy o największej ilości filmów</h3><table class='table table-striped table-hover w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Imie</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Nazwisko</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Ilość filmów</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $result_liczba_rez->fetch()) {
    echo "<tr class='text-center' style='transform: rotate(0);'>
                <td class='table_row'><p>" . $row->imie . "</p></td>
                <td class='table_row'><p>" . $row->nazwisko . "</p></td>
                <td class='table_row'><p>" . $row->ilosc . "</p></td>
              </tr>";
}
echo "</tbody></table><br>";

//

echo "<h3>Aktorzy o największej ilości filmów</h3><table class='table table-striped table-hover w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Imie</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Nazwisko</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Ilość filmów</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $result_liczba_aktor->fetch()) {
    echo "<tr class='text-center' style='transform: rotate(0);'>
                <td class='table_row'><p>" . $row->imie . "</p></td>
                <td class='table_row'><p>" . $row->nazwisko . "</p></td>
                <td class='table_row'><p>" . $row->ilosc . "</p></td>
              </tr>";
}
echo "</tbody></table><br>";

//

echo "<h3>Najstarsi aktorzy</h3><table class='table table-striped table-hover w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Imie</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Nazwisko</th>
        <th scope='col' class='table_column' onclick='sortTable(2)'>Wiek</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $result_aktor_max->fetch()) {
    echo "<tr class='text-center' style='transform: rotate(0);'>
                <td class='table_row'><p>" . $row->imie . "</p></td>
                <td class='table_row'><p>" . $row->nazwisko . "</p></td>
                <td class='table_row'><p>" . $row->aktor_ur . "</p></td>
              </tr>";
}
echo "</tbody></table><br>";

//

echo "<h3>Najstarsi rezyserzy</h3><table class='table table-striped table-hover w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Imie</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Nazwisko</th>
        <th scope='col' class='table_column' onclick='sortTable(2)'>Wiek</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $result_rezyser_max->fetch()) {
    echo "<tr class='text-center' style='transform: rotate(0);'>
                <td class='table_row'><p>" . $row->imie . "</p></td>
                <td class='table_row'><p>" . $row->nazwisko . "</p></td>
                <td class='table_row'><p>" . $row->rezyser_ur . "</p></td>
              </tr>";
}
echo "</tbody></table><br></div>";
?>