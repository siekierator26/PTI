<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formularz</title>
    </head>
    <body>
        <h2>Dane odebrane przez formularz: </h2>
        <?php
            function zabezpiecz($dane){
                return htmlspecialchars($dane,ENT_QUOTES,"UTF-8");
            }

            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $imie= zabezpiecz($_POST["imie"]);
                $nazwisko= zabezpiecz($_POST["nazwisko"]);
                $kolor= zabezpiecz($_POST["color"]);
                $plec= zabezpiecz($_POST["plec"]);
                $wiek= zabezpiecz($_POST["wiek"]);
                $zgoda= zabezpiecz($_POST["zgoda"]);
                $wiadomosc= zabezpiecz($_POST["wiadomosc"]);

                echo "<p>Imie: $imie </p>";
                echo "<p>Nazwisko: $nazwisko </p>";
                echo "<p>Kolor: $kolor </p>";
                echo "<p>Płeć: $plec</p>";
                echo "<p>Wiek: $wiek </p>";
                echo "<p>Zgoda: $zgoda </p>";
                echo "<p>Treść: $wiadomosc </p>";
            }
        ?>
    </body>
</html>