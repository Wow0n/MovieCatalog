<?php
require_once('../server/Database.php');
include '../server/actors_select_all.php';

echo "<br><table class='table table-striped w-50' id='table'>
    <thead>
    <tr class='text-center'>
        <th scope='col' class='table_column' onclick='sortTable(0)'>Imie</th>
        <th scope='col' class='table_column' onclick='sortTable(1)'>Nazwisko</th>
        <th scope='col' class='table_column' onclick='sortTable(2)'>Role</th>
    </tr>
    </thead>
    <tbody>";

while ($row = $result->fetch()) {
    echo "<tr class='text-center'>";
    echo "<td class='table_row'><p>" . $row->id . " " . $row->imie . "</p></td>";
    echo "<td class='table_row'><p>" . $row->nazwisko . "</p></td>";
    echo "<td class='table_row'><p>" . $row->role . "</p></td>";

    echo "</tr>";
}
echo " </tbody></table>";

echo "<form method='post'><input type='submit' name='next' value='Nastepna'></form>";
echo "<form method='post'><input type='submit' name='previous' value='Poprzednia'></form>";

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
