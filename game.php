<!DOCTYPE>
<html lang="pl">
    <head>
        <title>OniNet</title>
        <link rel="stylesheet" href="mainstyle.css">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600&display=swap" rel="stylesheet">
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
                    <?php echo $_SESSION["menu"];?>
                </div>               
            </div>
            <div id="container">
                <div id="articleholder">
                    <p id="articleTitle">Gra w oczko</p>
                    <div id="division"></div>
                    <?php include("gameScript.php"); ?> 
                    <div id="gameBox">
                        <div id="krupier">
                            <div class="cardHolder">
                                <?php
                                    foreach($_SESSION["krupierCards"] as $cards){
                                        echo "<div class='card'>". $cards. "</div>";
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                            echo "<div class='Score'>Krupier: ". $_SESSION["krupier"]. "</div>";
                            echo "<div class='Score'>Gracz: ". $_SESSION["gracz"]. "</div>";
                        ?>
                        <div id="gracz">
                            <div class="cardHolder">
                                <?php
                                    foreach($_SESSION["graczCards"] as $cards){
                                        echo "<div class='card'>". $cards. "</div>";
                                    }
                                                                                 
                                ?>
                            </div>
                        </div>
                        <br>
                        <div id="buttons">  
                            <form name="oczko" method = "POST">                          
                                <input type="submit" name="Spasuj" value="Spasuj" <?php echo $_SESSION["spasujDisabled"]?>>
                                <input type="submit" name="Dobierz" value="Dobierz" <?php echo $_SESSION["dobierzDisabled"]?>>
                                <br>
                                <input type="submit" name="Nowa_Gra" value="Nowa gra" <?php echo $_SESSION["nowaGraDisabled"]?>>
                            </form>
                        </div>                       
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