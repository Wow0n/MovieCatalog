<?php
include '../server/film_details.php';
?>
<div id="main">
    <article>
        <table class='table' id='table'>
            <tbody>
            <tr>
                <?php
                if ($row->link_plakat != null && filter_var($row->link_plakat, FILTER_VALIDATE_URL)) {
                    echo "<td rowspan='3' class='table_detail'><img class='img-fluid' src='" . $row->link_plakat . "' alt='plakat'></td>";
                } else {
                    echo "<td rowspan='3' class='table_detail'>Brak plakatu!</td>";
                }
                echo "<td>
                    <a class='link_moviedb' target='_blank' href='$row->link_ogolny'><h2>$row->tytul</h2></a>     <h3>(" . (date('Y', strtotime($row->data_premiery))) . ")</h3><br>
                    $row4->gatunki • $row->czas_trwania min (" . date('G\h i\m\i\n', mktime(0, $row->czas_trwania)) . ")<br>";

                if ($row6->ilosc > 0) {
                    echo "<td class='table_rating'><h4>Oceny: " . $row6->srednia . " (" . $row6->ilosc . ")</h4></td>";
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
                Reżyser:<ul class='director_bullet'>";

                while ($row5 = $result5->fetch()) {
                    echo "<li>$row5->imie $row5->nazwisko</li>";
                }
                echo "</ul><br><br>Aktorzy:<ul class='actor_bullet'>";

                while ($row2 = $result2->fetch()) {
                    echo "<li>$row2->imie $row2->nazwisko - $row2->rola</li>";
                }

                echo "</ul>
                </td>
            </tr>
            <tr>
                <td>";
                if ($result3->rowcount() != null) {
                    echo "<div id='carouselExampleControls' class='carousel slide' data-bs-ride='carousel'>
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
                        </div>";
                } else {
                    echo "Brak galerii!";
                }

                echo "</td><td colspan='2'>";
                if ($row->link_zwiastun != null) {
                    echo "<iframe class='embed-responsive-item' src='$row->link_zwiastun' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                } else {
                    echo "Brak lub wadliwy link do zwiastunu!";
                }
                ?>
                </td></tr>
            </tbody>
        </table>
    </article>
    <aside>
        <?php
        if ($row7_1->id_uzytkownik == $_SESSION['account_id']) {
            echo"
            <div class='form_rate'>
            <h4 > Oceń film:</h4 ><br >
            <form method = 'post' >
                <div class='rating' >
                    <label >
                        <input type = 'radio' name = 'stars' value = '1' />
                        <span class='icon' > ★</span >
                    </label >
                    <label >
                        <input type = 'radio' name = 'stars' value = '2' />
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                    </label >
                    <label >
                        <input type = 'radio' name = 'stars' value = '3' />
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                    </label >
                    <label >
                        <input type = 'radio' name = 'stars' value = '4' />
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                    </label >
                    <label >
                        <input type = 'radio' name = 'stars' value = '5' />
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                        <span class='icon' > ★</span >
                    </label >
                </div >
                <div class='mb-3' >
                    <label for='comment' class='form-label' > Komentarz:</label >
                    <textarea class='form-control' name = 'comment' id = 'comment' rows = '3' maxlength = '500' ></textarea >
                </div >
                <button type = 'submit' id = 'comment_add' name = 'comment_add' class='btn btn-outline-success' > Dodaj</button >
            </form>
        </div>";
        } else {
            echo "<h4>Już oceniłeś ten film!</h4>";
        }
        ?>
        <br><br>
        <?php
        while ($row8 = $result8->fetch()) {
            if ($row8->login == null){
                echo "<h5>Anonim:</h5><br>";
            } else {
                echo "<h5>$row8->login:</h5><br>";
            }

            switch ($row8->watrosc_oceny) {
                case 1:
                    echo "<i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star'>star</i>
                          <i class='material-icons' id='star'>star</i>
                          <i class='material-icons' id='star'>star</i>
                          <i class='material-icons' id='star'>star</i>";
                    break;
                case 2:
                    echo "<i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star'>star</i>
                          <i class='material-icons' id='star'>star</i>
                          <i class='material-icons' id='star'>star</i>";
                    break;
                case 3:
                    echo "<i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star'>star</i>
                          <i class='material-icons' id='star'>star</i>";
                    break;
                case 4:
                    echo "<i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star'>star</i>";
                    break;
                case 5:
                    echo "<i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>
                          <i class='material-icons' id='star_checked'>star</i>";
                    break;
                  }
            echo "<br>$row8->komentarz<br><br>";

        }
        ?>
    </aside>
</div>
<script>
    $(':radio').change(function () {
        console.log('New star rating: ' + this.value);
    });
</script>