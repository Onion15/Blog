<html lang="pl">
    <head>
        <title>OniNet</title>
        <link rel="stylesheet" href="mainstyle.css">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <script>
            function setPage(x){
            document.cookie = "Title="+x;
            location.href = "article.php";
            }
        </script> 
        <?php 
            include("everyPage.php");
            include("dbConnection.php");
            include("postScript.php");
            if($_SESSION["posted"]){
                echo "<script>alert('Post został dodany do bazy danych');</script>";
                $_SESSION["posted"] = false;
            }
            
        ?>
        <div id="website">
            <div id="header">
                <a href=<?php echo $_SESSION["links"][0];?>><h1>OniNet</h1></a>
                <div id="login">
                    <?php 
                        include("loginMenu.php");
                    ?>
                </div>
                <div id = "menu">
                    <?php echo $_SESSION["menu"];?>
                </div>               
            </div>
            <div id="container">
                <div id="articleholder">
                    <?php
                    echo $_SESSION["articles"];
                    ?>
                </div>
                <div id="quickarticle">
                    <?php echo $_SESSION["quickarticle"];?>
                </div>
            </div>
            <div id="truefooter"></div>
            <div id="footer">
                <h3>Wykonał Wojciech Cebula</h3>
            </div>
        </div>        
    </body>
</html>