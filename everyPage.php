<?php
    session_start();

    if(!isset($_SESSION["user"]))
        $_SESSION["user"] = "Anonim";
    if (!isset($_SESSION["userID"]))
        $_SESSION["userID"] = 2;

    echo "
        <script>
            function adminPanel(){
                console.log('". $_SESSION["user"]. "');
                if('". $_SESSION["user"]. "' == 'admin')
                    location.href = 'phpmyadmin';
                else
                    alert('Brak wymaganych uprawnień');
            }
        </script>
    ";
    $_SESSION["links"] = [
        "index.php",
        "article.php",
    ];

    $_SESSION["quickarticle"] = '
        <a class="quickarticleitem" href="article.php">Artykuł</a>
        <a class="quickarticleitem" href="game.php">Gra w oczko</a>
        <a class="quickarticleitem" href="postCreator.php">Kreator postów</a>
    ';

    $_SESSION["menu"] = '
        <a href="https://google.pl" target="_blank" class="menuitem">O mnie</a>
        <a href="https://onet.pl" target="_blank" class="menuitem">Kalendarz</a>
        <a href="https://bing.pl" target="_blank" class="menuitem">Archiwum</a>
        <a href="contact.php" class="menuitem">Kontakt</a>
        <a onclick="adminPanel()" class="menuitem" >Panel administracyjny</a>
    ';
    if(array_key_exists('panel', $_POST)) {
        adminPanel();
    }
    function adminPanel() {

        header("Location: postEditor.php");
    }

    $_SESSION["articles"] = '
        <div class="articleitem">
            <a class="articlelink" onclick="setPage(1)"> 
                <img class="articleitemimage" src="Pictures/Pic1.png" alt="Picture">
                <div class="gradient"></div>
                <h3 class="articletitle">Niewinny chlebek</h3>
                <h5 class="articledescribtion">Uwaga, wcale nie taki niewinny</h5>
            </a>
        </div>
        <div class="articleitem">
            <a class="articlelink" onclick="setPage(2)">
                <img class="articleitemimage" src="Pictures/Pic2.png" alt="Picture">
                <div class="gradient"></div>
                <h3 class="articletitle">Dorastanie kociąt</h3>
                <h5 class="articledescribtion">Porady dla osób nowych</h5>
            </a>
        </div>
        <div class="articleitem">
            <a class="articlelink" onclick="setPage(3)">
                <img class="articleitemimage" src="Pictures/Pic3.png" alt="Picture">
                <div class="gradient"></div>
                <h3 class="articletitle">Kocia aura</h3>
                <h5 class="articledescribtion">Dlaczego koty pomagają ludziom przygnębionym</h5>
            </a>
        </div>
        <div class="articleitem">
            <a class="articlelink" onclick="setPage(4)">
                <img class="articleitemimage" src="Pictures/Pic4.png" alt="Picture">
                <div class="gradient"></div>
                <h3 class="articletitle">Kot? A może jednak coś więcej</h3>
                <h5 class="articledescribtion">Kościół odpowiada</h5>
            </a>
        </div>
        <div class="articleitem">
            <a class="articlelink" onclick="setPage(5)">
                <img class="articleitemimage" src="Pictures/Pic5.png" alt="Picture">
                <div class="gradient"></div>
                <h3 class="articletitle">Kocie pozycje</h3>
                <h5 class="articledescribtion">Kiedy kot prosi o atencję</h5>
            </a>
        </div>
        <div class="articleitem">
            <a class="articlelink" onclick="setPage(6)">
                <img class="articleitemimage" src="Pictures/Pic6.png" alt="Picture">
                <div class="gradient"></div>
                <h3 class="articletitle">Koci sen</h3>
                <h5 class="articledescribtion">Ciekawostki na temat snu kociąt</h5>
            </a>
        </div>
    ';
?>