<?php
/* Hämta veckans horoskop från sidan, https://twitter.com/dadsaysjokes
*/
?>
<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dad Jokes 2019</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="kontainer">
    <?php
    $ar = date('Y');
    echo "<h1>Dad Jokes Year $ar</h1>";
    $idag = date('d/m');
    
    /* skap en array av horoskoptecken */
    $tecknen = ["Väduren", "Oxen", "Tvillingarna", "Kräftan", "Lejonet", "Jungfru", "Vågen", "Skorpionen", "Skytten", "Stenbocken", "Vattumannen", "Fiskarna"];
    
    /* Hämta sidorna med horoskopen en-och-en */
    foreach ($tecknen as $index => $tecken) {
        $i = $index + 1;
        
        /* Hämta sida */
        $sidan = file_get_contents("https://twitter.com/dadsaysjokes");
        
        /* Sök på början av horoskoptexten */
                            
        $start = strpos($sidan, "<p class=\"TweetTextSize TweetTextSize--normal js-tweet-text tweet-text\" lang=\"en\" data-aria-label-part=\"0\">");

        if ($start !== false) {
            
            /* Sök på slutet av horoskoptexten */
            $slut = strpos($sidan, "</div>", $start) + 6;
            if ($slut !== false) {
    
                /* Plocka ut horoskoptexten */
                $horoskop = substr($sidan, $start, $slut - $start);
                echo "<h2>$tecken</h2>";
                echo $horoskop;
            } else {
                echo "<p>Hittade inte var horoskopet slutade!</p>";
            }
        } else {
            echo "<p>Hittade inte var horoskopet började!</p>";
        }
    }
    ?>
</div>
</body>
</html>