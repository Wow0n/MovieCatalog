<div id="main">
    <article>
        <form class="form-inline" action="" method="post">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" placeholder="Wpisz tytul lub gatunek">
            </div>
            <button type="submit" class="btn btn-outline-success">Szukaj</button>
        </form>
        <?php
        require_once('../server/Database.php');
        include '../server/select_all.php';

        while ($row = $result->fetch()) {
            echo "<div class='searched_films'>";
            echo "<img src='" . $row->link_plakat . "'>";
            echo "</div>";
        }
        ?>
    </article>
</div>