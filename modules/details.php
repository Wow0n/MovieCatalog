<?php
include '../server/film_details.php';
?>

<div id="main">
    <article>
        <table class='table' id='table'>
            <tbody>
            <?php
            echo "
            <tr>
                <td rowspan='3' class='table_detail'><img class='img-fluid' src='" . $row->link_plakat . "' alt='plakat'></td>
                <td>
                    <h2>$row->tytul</h2>     <h3>(" . (date('Y', strtotime($row->data_premiery))) . ")</h3><br>
                    $row->gatunek • $row->czas_trwania min (" . date('G \h i \m\i\n', mktime(0, $row->czas_trwania)) . ")<br>";

            if ($row->ilosc_ocen != 0) {
                echo "<td class='table_rating'><p>" . $row->srednia_ocen . " (" . $row->ilosc_ocen . ")</p></td>";
            } else {
                echo "<td class='table_rating'><p>Brak ocen!</p></td>";
            }

            echo "</td>
            </tr>
            <tr>
                <td colspan='2'>$row->opis</td>
            </tr>
            <tr>
                <td colspan='2'>
                Reżyser: $row->rezyser_imie $row->rezyser_nazwisko<br><br>
                Aktorzy:<ul class='actor_bullet'>";

            while ($row2 = $result2->fetch()) {
                echo "<li>$row2->imie $row2->nazwisko - $row2->rola</li>";
            }

            echo "</ul>
                </td>
            </tr>
            <tr>
                <td><iframe width='700px' height='500px' src='$row->link_zwiastun' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe></td>
                <td colspan='2'>
                    <div id='carouselExampleControls' class='carousel slide' data-bs-ride='carousel'>
                          <div class='carousel-inner'>";

                            $row3 = $result3->fetch();
                            echo "<div class='carousel-item active'><img src='$row3->link_scena' class='d-block w-100' alt='scena'></div>";

                            while ($row3 = $result3->fetch()) {
                                echo "<div class='carousel-item'><img src='$row3->link_scena' class='d-block w-100' alt='scena'></div>";
                            }
                          echo "
                          <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleControls' data-bs-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Previous</span>
                          </button>
                          <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleControls' data-bs-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Next</span>
                          </button>
                        </div>
                </td>
            </tr>";
            ?>
            </tbody>
        </table>
    </article>
    <aside>

    </aside>
</div>