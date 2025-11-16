<!DOCTYPE html>
    <html lang="PL">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php
        if (!isset($_GET["poziom"])) {$poziom="1";} else {$poziom=$_GET["poziom"];}; 
        if (!isset($_GET["pion"]))   {$pion="1";}   else {$pion=$_GET["pion"];}; 
            echo '<div id="header">
            <h1>Grzegorz Poniewierski oraz Dawid Piechowski</h1>
        </div>

        <div id="menu_poziom">
            <ul>
                <li>
                    <a href="lab3.php?poziom=1&pion='.$pion.'">Poziom 1</a>
                </li>
                 <li>
                    <a href="lab3.php?poziom=2&pion='.$pion.'">Poziom 2</a>
                </li>
                 <li>
                    <a href="lab3.php?poziom=3&pion='.$pion.'">Poziom 3</a>
                </li>
            </ul>
        </div>
        
        <div id="menu_pion">
            <ul>
                <li>
                    <a href="lab3.php?pion=1&poziom='.$poziom.'">Pion 1</a>
                </li>
                 <li>
                    <a href="lab3.php?pion=2&poziom='.$poziom.'">Pion 2</a>
                </li>
                 <li>
                    <a href="lab3.php?pion=3&poziom='.$poziom.'">Pion 3</a>
                </li>
            </ul>
        </div>

        <div id="text">
            <h1>Wybrano poziom '.$poziom.' pion '.$pion.'</h1>
            ';
            if($poziom==1 && $pion==1){
                echo 'Grzegorz Poniewierski i Dawid Piechowski';
            } else if($poziom==1 && $pion==2){
                echo 'do zobrazowania rzeczy';
            } else if($poziom==1 && $pion==3){
                echo 'do zobrazowania rzeczy';
            } else if($poziom==2 && $pion==1){
                echo '
                <iframe src="https://www.tu.kielce.pl" frameborder="0" width="100%" height="100%"></iframe>
                    ';
            } else if($poziom==2 && $pion==2){
                echo '<img src="zdjecie.png" alt="zdjecie">';
            } else if($poziom==2 && $pion==3){
                echo 'Inwencja tworcza';
            } else if($poziom==3 && $pion==1){
                echo '31';
            } else if($poziom==3 && $pion==2){
                echo '32';
            } else if($poziom==3 && $pion==3){
                echo '33';
            }

            echo '
        </div>

        <div id="stopka">
            <p>17.11.2025 - poniedziałek</p>
        </div>';
        ?>
    </body>
    
</html>