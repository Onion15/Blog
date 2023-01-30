<?php
    
    
    if(!isset($_SESSION['cards'])){
        $_SESSION['cards'] = array(
        "A","K","Q","J","10","9","8","7","6","5","4","3","2",
        "A","K","Q","J","10","9","8","7","6","5","4","3","2",
        "A","K","Q","J","10","9","8","7","6","5","4","3","2",
        "A","K","Q","J","10","9","8","7","6","5","4","3","2");
        shuffle($_SESSION["cards"]);
    }

    if(!isset($_SESSION["spasujDisabled"]))
        $_SESSION["spasujDisabled"] = "";

    if(!isset($_SESSION["dobierzDisabled"]))
        $_SESSION["dobierzDisabled"] = "";

    if(!isset($_SESSION["nowaGraDisabled"]))
        $_SESSION["nowaGraDisabled"] = "disabled";

    if(!isset($_SESSION['graczCards'])){
        $_SESSION['graczCards'] = array();
        for($i=0; $i<2; $i++){
            array_push($_SESSION["graczCards"], $_SESSION["cards"][0]);
            array_shift($_SESSION["cards"]);
        }
    }

    if(!isset($_SESSION['krupierCards'])){
        $_SESSION['krupierCards'] = array("", "");
    }

    if(!isset($_SESSION['krupier'])){
        $_SESSION['krupier'] = 0;
    }

    if(!isset($_SESSION['gracz'])){        
        $_SESSION['gracz'] = 0;
        foreach($_SESSION["graczCards"] as $card){
            if($card == "A")
                $_SESSION['gracz'] += 11;
            else if($card == "K" || $card == "Q" || $card == "J")
                $_SESSION['gracz'] += 10;
            else 
                $_SESSION['gracz'] += (int)$card;
        }
    }

    if(isset($_POST['Dobierz'])) {
        $_SESSION["gracz"]=0;
        array_push($_SESSION["graczCards"], $_SESSION["cards"][0]);
        array_shift($_SESSION["cards"]);
        foreach($_SESSION["graczCards"] as $card){
            if($card == "A")
                $_SESSION['gracz'] += 11;
            else if($card == "K" || $card == "Q" || $card == "J")
                $_SESSION['gracz'] += 10;
            else 
                $_SESSION['gracz'] += (int)$card;
            
            if($_SESSION["graczCards"][0] == "A" && $_SESSION["graczCards"][1] == "A"){
                $_SESSION["spasujDisabled"] = "disabled";
                $_SESSION["dobierzDisabled"] = "disabled";
                $_SESSION["nowaGraDisabled"] = "";
                echo "<script>alert('Gratulacje, wygrałeś')</script>";                                        
            }
                                                  
            if($_SESSION["gracz"] > 21){
                $_SESSION["spasujDisabled"] = "disabled";
                $_SESSION["dobierzDisabled"] = "disabled";
                $_SESSION["nowaGraDisabled"] = "";  
                echo "<script>alert('Przegrałeś, zagraj ponownie')</script>";                                                                               
            }
        }
    }

    if(isset($_POST['Spasuj'])) {
        $_SESSION["spasujDisabled"] = "disabled";
        $_SESSION["dobierzDisabled"] = "disabled";
        $_SESSION["nowaGraDisabled"] = "";
        $i = 0;
        while($_SESSION["krupier"] < 16){
            if($i<2){
                array_shift($_SESSION["krupierCards"]); 
                $i++;
            }                  
            array_push($_SESSION["krupierCards"], $_SESSION["cards"][0]);
            array_shift($_SESSION["cards"]);            
            $_SESSION["krupier"] = 0;      
            foreach($_SESSION["krupierCards"] as $card){
                if($card == "A")
                    $_SESSION['krupier'] += 11;
                else if($card == "K" || $card == "Q" || $card == "J")
                    $_SESSION['krupier'] += 10;
                else 
                    $_SESSION['krupier'] += (int)$card;
            }
        }
        if($_SESSION["krupier"] > 21 || $_SESSION["gracz"] > $_SESSION["krupier"])
            echo "<script>alert('Gratulacje, wygrałeś')</script>";
        else if ($_SESSION["gracz"] == $_SESSION["krupier"])
            echo "<script>alert('Remis')</script>";
        else
            echo "<script>alert('Przegrałeś, zagraj ponownie')</script>";

        echo "<script> document.forms['oczko']['Dobierz'].disabled = true</script>";            
    }

    if(isset($_POST['Nowa_Gra'])) { 
        session_destroy();
        header("Refresh: 0; url=game.php");
    }
?>