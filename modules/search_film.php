<div id="main">
    <article>
        <form class="form-inline" action="../controllers/search.php" method="post">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" name="phrase" placeholder="Wpisz tytul lub gatunek">
            </div>
            <button type="submit" class="btn btn-outline-success">Szukaj</button>
        </form>
        <?php
        include 'select_film_table.php';
        ?>
    </article>
</div>