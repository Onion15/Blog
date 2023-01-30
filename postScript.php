<?php
if(!isset($_SESSION["posted"]))
$_SESSION["posted"] = false;

if(!isset($_SESSION["title"]))
$_SESSION["title"] = "";

if(!isset($_SESSION["content"]))
$_SESSION["content"] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["title"])) 
    {
        echo "<script>alert('Tytuł jest wymagany!');</script>";
    } 
    else 
    {
        $_SESSION["title"] = test_input($_POST["title"]);
    }

    if (empty($_POST["content"])) 
    {
        echo "<script>alert('Treść posta nie może być pusta!');</script>";
    }
    else 
    {
        $_SESSION["content"] = test_input($_POST["content"]);
    }
    if(isset($_POST["cancel"])){
        header('Location: postCreator.php');
    }
    if(isset($_POST["gucci"])){
        include("dbConnection.php");
        $_SESSION["posted"] = true;

        $query = "
            SELECT id_użytkownika
            FROM użytkownicy
            WHERE nazwa_użytkownika = '". $_SESSION["user"]. "';
            ";
        $authorId = mysqli_fetch_array(mysqli_query($_SESSION["conn"], $query));
        echo "<script>console.log('". $authorId["id_użytkownika"]. "');</script>";
        $query = "
            INSERT INTO posty (Tytuł, Treść, Kategoria, Autor)
            VALUES ('". $_SESSION["title"]. "', '". $_SESSION["content"]. "', 'Post', '". $authorId["id_użytkownika"]. "');";
        mysqli_query($_SESSION["conn"], $query);
        mysqli_close($_SESSION["conn"]);
        header('Location: index.php');
    }
}


function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$tags = array("b", "u", "i", "quote")
?>