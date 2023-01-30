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
                    <p id="articleTitle">Login</p>
                    <div id="division"></div>
                    <div id="contentBox">
                        <?php include("loginScript.php");?>
                        <form name="login" method="POST">
                            <label for="nick">Nazwa użytkownika* : </label>
                            <input name="nick" type="text"><br>
                            <label for="psswd">Hasło* : </label>
                            <input name="psswd" type="password"><br>
                            <input type="submit" value="Zaloguj">
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