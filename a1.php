<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>Formularz</title>
    </head>
    <body>

    <form action="a2.php" method="post">
        <label for="imie">Imię:</label>
        <input type="text" id="imie" name="imie" required>

        <label for="nazwisko">Nazwisko:</label>
        <input type="text" id="nazwisko" name="nazwisko" required>

        <label for="color">Color:</label>
        <input type="color" id="color" name="color" required>

        <label>Płeć:</label>
        <input type="radio" id="mezczyzna" name="plec" value="mezczyzna" checked>
        <label for="mezczyzna">Mężczyzna</label>
        <input type="radio" id="kobieta" name="plec" value="kobieta">
        <label for="kobieta">Kobieta</label>

        <label for="wiek">Wiek:</label>
        <select id="wiek" name="wiek">
            <option value="10-18">10-18 lat</option>
            <option value="19-25">19-25 lat</option>
            <option value="25-35">25-35 lat</option>
            <option value="35+">35+ lat</option>
        </select>

        <label for="zgoda">Zgoda na przesłanie danych:</label>
        <input type="checkbox" id="zgoda" name="zgoda" required>
        <label for="zgoda">Wyrażam zgodę</label>

        <label for="wiadomosc">Treść:</label>
        <textarea id="wiadomosc" name="wiadomosc" rows="4" cols="50"></textarea>

        <input type="submit" value="Prześlij formularz">
    </form>

    </body>
</html>
