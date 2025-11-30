<!DOCTYPE html>
<html>

<head>
    <title>Strona główna</title>
</head>

<body>
    <?php
    include "config.php";
    $conn = mysqli_connect($host, $user, $password) or die("Nie można się połączyć, prosze podać poprawne dane");
    mysqli_select_db($conn, $database) or die("Nie można wybrać bazy, prosze podać poprawne dane");

    include "a5.php";

    echo "<TABLE border='1' bgcolor='lightblue' width='400' frame='border'>
    <TR>
        <TH><a href='?sort=id&order=$new_order'>ID</a></TH>
        <TH><a href='?sort=imie&order=$new_order'>Imie</a></TH>
        <TH><a href='?sort=ocena&order=$new_order'>Ocena</a></TH>
        <TH><a href='?sort=umie_apache&order=$new_order'>Umie Apache</a></TH>
        <TH><a href='?sort=muzyka&order=$new_order'>Muzyka</a></TH>
        <TH><a href='?sort=data_egzekucji&order=$new_order'>Data</a></TH>
        <TH>Usuń</TH>
        <TH>Popraw</TH>
    </TR>";

    $zaw1 = mysqli_query($conn, $sql1);

    if ($zaw1) {
        while ($row1 = mysqli_fetch_row($zaw1)) {
            echo "
          <TR>
            <TD>" . $row1[0] . "</TD>
            <TD>" . $row1[1] . "</TD>
            <TD>" . $row1[2] . "</TD>
            <TD>" . ($row1[3] ? 'Tak' : 'Nie') . "</TD>
            <TD>" . $row1[4] . "</TD>
            <TD>" . $row1[5] . "</TD>
            <TD>
                <a href='a4.php?id=" . $row1[0] . "'>Usuń</a>
            </TD>
            <TD>
                <a href='a3.php?id=" . $row1[0] . "'>Popraw</a>
            </TD>
          </TR>";
        }
    } else {
        echo "<tr><td colspan='8'>Brak danych lub tabela nie istnieje.</td></tr>";
    }
    echo "</TABLE>";
    echo "<br><a href='a6.php'>Dodaj wpis</a>";
    ?>
</body>

</html>