<!DOCTYPE>
<html lang="pl">
    <head>
        <title>OniNet</title>
        <link rel="stylesheet" href="mainstyle.css">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head> 
    <body>
        <?php
            include("everyPage.php");
            echo "<script>console.log('" . $_SESSION["user"] . ", " . $_SESSION["userID"] . "');</script>";
            $_SESSION["article_url"] = "$_SERVER[REQUEST_URI]";
            $_SESSION["row"] = "";
            include("dbConnection.php");
            $query = 
            "
            SELECT p.ID_posta, p.tytuł, p.treść, u.nazwa_użytkownika 
            FROM Posty as p INNER JOIN użytkownicy as u 
            ON p.Autor = u.ID_użytkownika AND p.ID_posta = ". $_COOKIE['Title']. ";
            ";
            $result = mysqli_query($_SESSION["conn"], $query);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION["row"] = mysqli_fetch_assoc($result);
            } 
            else ;
        ?>
        <div id="website">
            <div id="header">
                <a href="index.php"><h1>OniNet</h1></a>
                <div id="login">
                    <?php 
                        include("loginMenu.php");
                    ?>
                </div>
                <div id="menu">
                    <?php echo $_SESSION["menu"];?>
                </div>               
            </div>
            <div id="container">
                <div id="articleholder">
                    <p id="articleTitle">
                        Kontakt
                    </p>
                    <div id="division"></div>
                    <div id="contentBox">
                        <form method = "POST">
                            Email: 
                            <input type="text" style="width:400px"  name="email">
                            <br>
                            Tytuł: 
                            <input type="text" style="width:400px" name="title">
                            <br>
                            Treść: 
                            <br>
                            <textarea type="text" style="width:800px; height:400px" name="content"></textarea>
                            <br>
                            <input type="submit" value="Wyślij">
                        </form>
                        <?php
                            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                                mail("nobody@example.xd", $_POST["title"], $_POST["content"], "From: ". $_POST["email"]);
                            }
                        ?>
                    </div>
                </div>                
                <div id="quickarticle">
                    <?php echo $_SESSION["quickarticle"];?>
                </div>
            </div>
            <div id="trueFooter"></div>
            <div id="footer">
                <h3>Wykonał Wojciech Cebula</h3>
            </div>
        </div>        
    </body>
</html>