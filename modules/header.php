<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Baza filmow</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3b5f23">
        <a class="navbar-brand" href="../index.php">
            <img src="../assets/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            FilmowaBazaDanych
        </a>
        <div class="collapse navbar-collapse container-fluid" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/films_all.php">Wszystkie filmy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/actors_all.php">Wszyscy aktorzy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/stats.php">Statystyki</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/new_film.php">Dodaj film</a>
                </li>
            </ul>

            <?php
            if (isset($_SESSION['account_name']))
                echo "<span class='navbar-text'>
                            Zalogowano jako: " . $_SESSION['account_login'] .
                    "</span>";
            ?>
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    Menu użytkownika
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <?php
                    if (!isset($_SESSION['account_name'])) {
                        echo "<li><a class='dropdown-item' href='../controllers/create_account.php'>Stwórz konto</a></li>
                              <li><a class='dropdown-item' href='../controllers/sign_in.php'>Zaloguj się</a></li>";
                    } else {
                        if ($_SESSION['account_role'] == 'admin') {
                            echo "<li><h6 class='dropdown-header'>Panel administratora</h6></li>
                                  <li><a class='dropdown-item' href='../modules/add_film_admin.php'>Dodaj film</a></li>
                                  <li><a class='dropdown-item' href='../modules/edit_film.php'>Edytuj film</a></li>
                                  <li><a class='dropdown-item' href='../modules/delete_film.php'>Usuń film</a></li>
                                  <li><hr class='dropdown-divider'></li>";
                        }
                        echo "<li><a class='dropdown-item' href='../controllers/log_out.php'>Wyloguj się</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>