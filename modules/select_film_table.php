<?php
include '../server/film_select_query.php';

if ($result->rowCount() != 0) {
    echo "<br><table class='table table-striped table-hover w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column'></th>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Tytul</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Gatunek</th>
        <th scope='col' class='table_column' onclick='sortTable(2)'>Oceny</th>
    </tr>
    </thead>
    <tbody>";

    while ($row = $result->fetch()) {
        echo "<tr class='text-center' style='transform: rotate(0);'>";
        echo "<th scope='row' class='table_row'><a href='../controllers/film_details.php?id=" . $row->id . "' class='stretched-link'>";
        if ($row->link_plakat != null && filter_var($row->link_plakat, FILTER_VALIDATE_URL)) {
            echo "<img class='img-fluid' src = '" . $row->link_plakat . "' alt = 'plakat' >";
        } else {
            echo "Brak plakatu!";
        }

        echo "</a></th>";
        echo "<td class='table_row'><p>" . $row->tytul . "</p></td>";
        echo "<td class='table_row'><p>" . $row->gatunek . "</p></td>";

        if ($row->ilosc > 0) {
            echo "<td class='table_row'><p>" . $row->srednia . " (" . $row->ilosc . ")</p></td>";
        } else {
            echo "<td class='table_row'><p>Brak ocen!</p></td>";
        }
        echo "</tr>";
    }
    echo " </tbody></table>";

//    echo "<div class='form-inline'><form method='post'><input type='submit' name='previous' value='Poprzednia'>  ";
//    echo "<input type='submit' name='next' value='Nastepna'></form></div>";

} else {
    echo "Tytuł lub gatunek zawierający \"" . $_POST['phrase'] . "\" nie istnieje w bazie!";
}

?>
<script>
    function sortTable(n) {
        let table, rows, switching = true, i, x, y, shouldSwitch, dir = "asc", switchCount = 0;
        table = document.getElementById("table");

        while (switching) {
            switching = false;
            rows = table.rows;

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;

                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];

                if (dir === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchCount++;
            } else {
                if (switchCount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
