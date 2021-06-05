<?php
include '../modules/header.php';
echo "<div id='main'><article><div style='text-align: center'>
        <h1>Wylogowano!</h1>
      </div></article></div>";
include '../modules/footer.html';

session_unset();
header("Refresh:2; url=../index.php");