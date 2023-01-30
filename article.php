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
                        <?php 
                        if (mysqli_num_rows($result) > 0) 
                            echo $_SESSION["row"]["tytuł"]; 
                        else
                            echo "Brak postów";
                        ?>
                    </p>
                    <div id="division"></div>
                    <div id="contentBox">
                        <?php 
                        if (mysqli_num_rows($result) > 0) 
                            echo $_SESSION["row"]["treść"];
                        ?>
                        <div id=author>
                            <i><b>
                                <br><br>
                                <br>
                                <?php 
                                if (mysqli_num_rows($result) > 0) 
                                    echo "Autor:". $_SESSION["row"]["nazwa_użytkownika"];
                                ?>
                            </b></i>
                        </div>
                    </div>
                    <div id="page">                    
                    <?php
                    echo "<script>console.log('" . $username . "');</script>";
                        if (mysqli_num_rows($result) > 0)
                        {
                            if($_SESSION["row"]["nazwa_użytkownika"] == $_SESSION["user"] || $_SESSION["user"]=="admin"){
                                echo "
                                <form method = 'POST'>
                                    <input type='submit' value='Edytuj post' name='edit'>
                                    <input type='submit' value='Usuń post' name='delete'>
                                </form>
                                ";
                            }
                        }
                        if(array_key_exists('edit', $_POST)) {
                            edit_button();
                        }
                        if(array_key_exists('delete', $_POST)) {
                            delete_button();
                        }
                        function edit_button() {
                            header("Location: postEditor.php");
                        }
                        function delete_button() {
                            $query=
                            "
                                DELETE FROM posty
                                WHERE ID_posta = ". $_SESSION["row"]["ID_posta"];
                            ;
                            mysqli_query($_SESSION["conn"], $query);
                        }
                    ?>
                    </div>
                </div>                
                <div id="quickarticle">
                    <?php echo $_SESSION["quickarticle"];?>
                </div>
            </div>
            <div id="commentsSection">
                <?php include("commentSection.php"); ?>             
                <form method="post">
                    <span class="commentSectionText">Treść komentarza: <br></span><textarea name="comment" rows="15" cols="75"></textarea>
                    <span class="error"><?php echo $commentErr;?></span>
                    <br><br>
                    <span class="commentSectionText">Captcha (Przy dzieleniu podaj dolne przybliżenie): <br><?php echo $text ?></span>
                    <input type="text" name="captcha">
                    <span class="error">* <?php echo $captchaErr;?></span>                    
                    <br><br>
                    <input type="submit">
                </form>
                <?php
                    include("dbConnection.php");
                    $query = "
                        SELECT k.tresc_kom, u.nazwa_użytkownika
                        FROM komentarze  as k INNER JOIN użytkownicy as u
                        ON k.autor_kom = u.ID_użytkownika
                        WHERE k.ID_posta = ". $_COOKIE["Title"]. "
                        ORDER BY k.ID_komentarza DESC
                    ";
                    $result = mysqli_query($_SESSION["conn"], $query);
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "
                        <div class='commentholder'>
                        <div id='contentBox'>
                            ". $row['tresc_kom']. "
                            <div id=author>
                                <i><b>
                                    <br><br>
                                    ". $row["nazwa_użytkownika"]. "
                                </b></i>
                            </div>
                        </div>
                    </div>
                        ";
                    }
                    mysqli_close($_SESSION["conn"]);
                ?>
            </div>
            <div id="trueFooter"></div>
            <div id="footer">
                <h3>Wykonał Wojciech Cebula</h3>
            </div>
        </div>        
    </body>
</html>