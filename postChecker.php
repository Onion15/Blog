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
            include("postScript.php");
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
                    <p id="articleTitle"><?php echo $_SESSION["title"];?></p>
                    <div id="division"></div>
                    <div id="contentBox">
                        <?php
                            $postContent = $_SESSION["content"];
                            for($i = 0; $i<count($tags); $i++){
                                $postContent = str_replace("[".$tags[$i]."]", "<". $tags[$i]. ">", $postContent);
                                $postContent = str_replace("[/".$tags[$i]."]", "</". $tags[$i]. ">", $postContent);
                            }
                            echo $postContent;
                        ?>
                    </div>
                    <br>
                    <div id="page">
                        <form method="POST">
                            <input name = "cancel" type="submit" value="Cofnij">
                            <input name = "gucci" type="submit" value="Zatwierdź">
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