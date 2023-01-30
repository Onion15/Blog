<?php 
    $commentErr = $captchaErr = "";
    $comment = $captcha = "";
    $arrayNumber = array("zero", "jeden", "dwa", "trzy", "cztery", "pięć", "sześć", "siedem", "osiem", "dziewięć");
    $arrayMark = array("dodać", "odjąć", "razy", "przez");
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {       
        if (empty($_POST["comment"])) 
        {
            $comment = "";
        } 
        else 
        {
            $comment = test_input($_POST["comment"]);
        }

        $captcha = test_input($_POST["captcha"]);
        $captcha = (int)$captcha;  
        if($captcha == "")
            $captchaErr = "Captcha jest wymagana";
        else
        {          
            if ($captcha != $_SESSION["result"])
            {
                $captchaErr = "Zły wynik";
            }
        }     
        $query = "
            INSERT INTO komentarze ('treść_kom', autor_kom, ID_posta)
            VALUES ('". $_POST["comment"]. "', '". $_SESSION["userID"]. "', '". $_COOKIE['Title']. "')
        ";   
    }
      
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $text = "";
    $x = rand(0, 9);
    $z = rand(0, 3);
    $check = true;
    $_SESSION["result"] = -1;
    while($check)
    {
        $y = rand(0, 9);
        if($z == 0 && ($x+$y) >= 0 && ($x+$y) <= 10)
        {
            $check = false;
            $_SESSION["result"] = $x+$y;
            $text = ucfirst($arrayNumber[$x]). " ". $arrayMark[$z]. " ". $arrayNumber[$y];
        }
        if($z == 1 && ($x-$y) >= 0 && ($x-$y) <= 10)
        {
            $check = false;
            $_SESSION["result"] = $x-$y;
            $text = ucfirst($arrayNumber[$x]). " ". $arrayMark[$z]. " ". $arrayNumber[$y];
        }
        if($z == 2 && ($x*$y) >= 0 && ($x*$y) <= 10)
        {
            $check = false;
            $_SESSION["result"] = $x*$y;
            $text = ucfirst($arrayNumber[$x]). " ". $arrayMark[$z]. " ". $arrayNumber[$y];
        }
        if($z == 3 && $y != 0 && ($x/$y) >= 0 && ($x/$y) <= 10)
        {
            $check = false;
            $_SESSION["result"] = floor($x/$y);
            $text = ucfirst($arrayNumber[$x]). " ". $arrayMark[$z]. " ". $arrayNumber[$y];
        }
    }
?>