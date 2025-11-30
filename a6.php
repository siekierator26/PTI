<!DOCTYPE html>
<html>

<head>
    <title>Dodaj wpis</title>
</head>

<body>
    <?php
    include "config.php";
    $conn = mysqli_connect($host, $user, $password) or die("Nie można się połączyć");
    mysqli_select_db($conn, $database) or die("Nie można wybrać bazy");

    function zabezpiecz($dane)
    {
        return htmlspecialchars($dane, ENT_QUOTES, "UTF-8");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $imie = zabezpiecz($_POST['imie']);
        $ocena = zabezpiecz($_POST['ocena']);
        $umie_apache = zabezpiecz(isset($_POST['umie_apache']) ? 1 : 0);
        $muzyka = zabezpiecz($_POST['muzyka']);
        $data_egzekucji = zabezpiecz($_POST['data_egzekucji']);

        $sql = "INSERT INTO samochody (imie, ocena, umie_apache, muzyka, data_egzekucji) VALUES ('$imie', '$ocena', '$umie_apache', '$muzyka', '$data_egzekucji')";

        if (mysqli_query($conn, $sql)) {
            header("Location: a2.php");
            exit;
        } else {
            echo "Błąd dodawania rekordu: " . mysqli_error($conn);
        }

    } else {
        ?>
        <h2>Dodaj nowy wpis:</h2>
        <form method="POST">
            Imię:<br><input type="text" name="imie" required><br><br>
            Ocena:<br><input type="number" name="ocena" required><br><br>
            Umie Apache:<br><input type="checkbox" name="umie_apache"><br><br>
            Muzyka:<br><textarea name="muzyka"></textarea><br><br>
            Data:<br><input type="date" name="data_egzekucji" required><br>
            <input type="submit" value="Dodaj">
        </form>
        <?php
    }
    mysqli_close($conn);
    ?>
</body>

</html>