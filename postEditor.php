<!DOCTYPE>
<html lang="pl">
    <head>
        <title>OniNet</title>
        <link rel="stylesheet" href="mainstyle.css">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script src="registerScript.js"></script>
    </head>
    <body>
        <?php
            include("everyPage.php");
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
                    <?php
                        echo $_SESSION["menu"]
                    ?>
                </div>               
            </div>
            <div id="container">
                <div id="articleholder">
                    <p id="articleTitle">Edytor postów</p>
                    <div id="division"></div>
                    <div id="contentBox">
                        <?php
                            include("dbConnection.php");
                            if(array_key_exists('button', $_POST)) {
                                button();
                            }
                            function button() {
                                $query = "
                                    UPDATE posty 
                                    SET tytuł = '". $_POST['title']. "', treść = '". $_POST['content']. "'
                                    WHERE ID_posta = ". $_SESSION["row"]["ID_posta"];  
                                $_SESSION["row"]["tytuł"] = $_POST['title'];
                                $_SESSION["row"]["treść"] = $_POST['content'];
                                mysqli_query($_SESSION["conn"], $query);
                                header("Location: ". $_SESSION["article_url"]);
                            }
                        ?>
                        <form method = "POST">
                            Tytuł posta: <input name="title" type="text" value=<?php echo "'". $_SESSION["row"]["tytuł"]. "'";?>><br>
                            Treść posta: <br>
                            <textarea name="content" rows="32" cols="50"><?php echo $_SESSION["row"]["treść"];?></textarea><br>
                            <input type="submit" name ="button" value="Zaktualizuj">
                        </form>
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