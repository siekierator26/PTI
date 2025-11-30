<!DOCTYPE html>
<html>

<head>
    <title>Edytowanie rekordu</title>
</head>

<body>
    <?php
    include "config.php";
    $conn = mysqli_connect($host, $user, $password) or die("Nie można się połączyć");
    mysqli_select_db($conn, $database) or die("Nie można wybrać bazy");

    function zabezpiecz($dane){
                return htmlspecialchars($dane,ENT_QUOTES,"UTF-8");
            }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = zabezpiecz($_POST['id']);
        $imie = zabezpiecz($_POST['imie']);
        $ocena = zabezpiecz($_POST['ocena']);
        $umie_apache = zabezpiecz(isset($_POST['umie_apache']) ? 1 : 0);
        $muzyka = zabezpiecz($_POST['muzyka']);
        $data_egzekucji = zabezpiecz($_POST['data_egzekucji']);

        $sql = "UPDATE samochody SET imie='$imie', ocena='$ocena', umie_apache='$umie_apache', muzyka='$muzyka', data_egzekucji='$data_egzekucji' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: a2.php");
            exit;
        } else {
            echo "Błąd aktualizacji: " . mysqli_error($conn);
        }

    } else {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $sql = "SELECT * FROM samochody WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                ?>
                <h2>Edycja rekordu</h2>
                <form method="POST">
                    ID:<br><input type="text" name="id" value="<?php echo $row['id']; ?>" readonly style="background-color: #e0e0e0;"><br><br>
                    Imię:<br><input type="text" name="imie" value="<?php echo $row['imie']; ?>"><br><br>
                    Ocena:<br><input type="number" name="ocena" value="<?php echo $row['ocena']; ?>"><br><br>
                    Umie Apache:<br><input type="checkbox" name="umie_apache" <?php echo $row['umie_apache'] ? 'checked' : ''; ?>><br><br>
                    Muzyka:<br><textarea name="muzyka"><?php echo $row['muzyka']; ?></textarea><br><br>
                    Data:<br><input type="date" name="data_egzekucji" value="<?php echo $row['data_egzekucji']; ?>"><br>
                    <input type="submit" value="Zapisz">
                </form>
                <?php
            } else {
                echo "Nie znaleziono rekordu.";
            }
        } else {
            echo "Brak ID rekordu.";
        }
    }
    mysqli_close($conn);
    ?>
</body>

</html>