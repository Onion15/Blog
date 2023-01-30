<?php 
    if($_SESSION["user"] != "Anonim"){
        echo '<a class="acc" href="logout.php">Wyloguj</a>';
    }
    else{
        echo '<a class="acc" href="login.php">Login</a>
        &nbsp
        <a class="acc" href="register.php">Rejestracja</a>';
    }
?>