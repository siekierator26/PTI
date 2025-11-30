<?php
include "config.php";
$conn = mysqli_connect($host, $user, $password) or die("Nie można się połączyć");
mysqli_select_db($conn, $database) or die("Nie można wybrać bazy");

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM samochody WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: a2.php");
        exit;
    } else {
        echo "Błąd usuwania rekordu: " . mysqli_error($conn);
    }
} else {
    echo "Brak ID rekordu do usunięcia.";
}

mysqli_close($conn);
?>