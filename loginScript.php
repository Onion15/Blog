<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nick = $_POST["nick"];
        $psswd = $_POST["psswd"];

        include("dbConnection.php");
        $query = "
        SELECT ID_użytkownika, nazwa_użytkownika, hasło
        FROM użytkownicy
        WHERE nazwa_użytkownika = '". $nick. "'
        ";
        $result = mysqli_query($_SESSION["conn"], $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($psswd, $row["hasło"])){
                echo "<script>alert('Zalogowano');</script>";
                $_SESSION["logged"] = true;
                $_SESSION["user"] = $nick;
                $_SESSION["userID"] = $row["ID_użytkownika"];
                echo "<script>console.log('" . $_SESSION["user"] . ", " . $_SESSION["userID"] . "');</script>";
                header("Location: index.php");
            }
            else
                echo "<script>alert('Podano złe hasło');</script>";
        } 
        else {
            echo "<script>alert('Nie istnieje taki użytkownik');</script>";
        }
    }
?>