<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nick = $_POST["nick"];
    $email = $_POST["email"];
    $psswd = $_POST["psswd"];
    $chckpsswd = $_POST["chckpsswd"];
    $val=false;
    if(empty($nick)) 
        echo '<script>alert( "Proszę podać nazwę użytkownika!" );</script>';
    else if(strlen($nick) < 5 || strlen($nick) > 15)
        echo '<script>alert("Pole musi mieć od 5 do 15 znaków");</script>';
    else if(!preg_match("/^[A-Za-z0-9]{5,15}$/", $nick))
        echo '<script>alert("Pole może zawierać tylko litery oraz liczby");</script>';
    else if(empty($email)) 
        echo '<script> alert("Proszę podać EMail!" ); </script>';
    else if(!preg_match("/^[A-Za-z0-9.]+[@]+[A-Za-z0-9.]+[.]+[a-z]+$/", $email))
        echo '<script> alert("Zły format EMailu");</script>';
    else if(empty($psswd)) 
        echo '<script> alert("Proszę podać Hasło!" ); </script>';
    else if(strlen($psswd) < 5 || strlen($psswd) > 15)
        echo '<script> alert("Hasło musi mieć od 5 do 15 znaków"); </script>';
    else if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])([a-zA-Z0-9!@#$%^&*]{5,15})$/", $psswd))
        echo '<script> alert("Hasło musi zawierać przynajmniej 1 dużą literę, 1 małą literę, 1 liczbę oraz 1 znak specjalny"); </script>';
    else if($chckpsswd != $psswd)
        echo '<script> alert("Hasła nie są identyczne"); </script>';
    else
        $val=true;

    if($val){
        include("dbconnection.php");
        $query ="
            SELECT nazwa_użytkownika
            FROM użytkownicy
            WHERE nazwa_użytkownika = '". $nick. "'
        ";
        $result = mysqli_query($_SESSION["conn"], $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Istnieje taki użytkownik');</script>";
        }$query ="
            SELECT email
            FROM użytkownicy
            WHERE email = '". $email. "'
        ";
        $result = mysqli_query($_SESSION["conn"], $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Istnieje użytkownik z takim mailem');</script>";
        }
        else {
            $query = "
                INSERT INTO użytkownicy(nazwa_użytkownika, hasło, email, rola)
                VALUES('". $nick. "', '". password_hash($psswd, PASSWORD_DEFAULT). "', '". $email. "', 2);
            ";
            if (mysqli_query($_SESSION["conn"], $query)) {
                mysqli_close($_SESSION["conn"]);
                echo '<script> window.location.replace("index.php");
                    alert("Pomyślnie utworzono użytkownika"); </script>';
            } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        
        
    }
              
}
?>