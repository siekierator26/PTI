<!DOCTYPE html>
<html>

<head>
  <title>Formularz</title>
</head>

<body>
  <?php
  $host = $_POST['host'] ?? '';
  $user = $_POST['user'] ?? '';
  $password = $_POST['password'] ?? '';
  $database = $_POST['database'] ?? '';
  $tableName = 'samochody';

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($host) && !empty($user) && !empty($database)) {

    // 1. Sprawdzenie połączenia
    $conn = mysqli_connect($host, $user, $password);
    if (!$conn) {
      echo "<p style='color:red'>Nie można się połączyć: " . mysqli_connect_error() . "</p>";
      showForm($host, $user, $database);
    } else {
      echo "Połączenie nawiązane.<br>";

      // 2. Sprawdzenie bazy danych
      try {
        $db_selected = mysqli_select_db($conn, $database);
      } catch (mysqli_sql_exception $e) {
        $db_selected = false;
      }
      $db_action = $_POST['db_action'] ?? '';

      if ($db_selected) {
        if ($db_action == 'recreate') {
          mysqli_query($conn, "DROP DATABASE `$database`");
          if (mysqli_query($conn, "CREATE DATABASE `$database`")) {
            echo "Baza usunięta i stworzona ponownie.<br>";
            mysqli_select_db($conn, $database);
          } else {
            die("Błąd tworzenia bazy: " . mysqli_error($conn));
          }
        } elseif ($db_action == 'keep') {
          echo "Baza istnieje. Pozostawiono bez zmian.<br>";
        } else {
          echo "Baza danych '$database' istnieje. Czy usunąć i stworzyć nową?<br>";
          echo "<form method='POST'>";
          foreach ($_POST as $k => $v)
            echo "<input type='hidden' name='$k' value='$v'>";
          echo "<button type='submit' name='db_action' value='recreate'>Tak</button> ";
          echo "<button type='submit' name='db_action' value='keep'>Nie</button>";
          echo "</form>";
          mysqli_close($conn);
          exit;
        }
      } else {
        if (mysqli_query($conn, "CREATE DATABASE `$database`")) {
          echo "Baza danych utworzona.<br>";
          mysqli_select_db($conn, $database);
        } else {
          die("Błąd tworzenia bazy: " . mysqli_error($conn));
        }
      }

      // 3. Sprawdzenie tabeli
      $check_table = mysqli_query($conn, "SHOW TABLES LIKE '$tableName'");
      $table_exists = mysqli_num_rows($check_table) > 0;
      $table_action = $_POST['table_action'] ?? '';

      if ($table_exists) {
        if ($table_action == 'recreate') {
          mysqli_query($conn, "DROP TABLE `$tableName`");
          createTable($conn, $tableName);
          echo "Tabela usunięta i stworzona ponownie.<br>";
        } elseif ($table_action == 'keep') {
          echo "Tabela istnieje. Pozostawiono bez zmian.<br>";
        } else {
          echo "Tabela '$tableName' istnieje. Czy usunąć i stworzyć nową?<br>";
          echo "<form method='POST'>";
          foreach ($_POST as $k => $v)
            echo "<input type='hidden' name='$k' value='$v'>";
          echo "<button type='submit' name='table_action' value='recreate'>Tak</button> ";
          echo "<button type='submit' name='table_action' value='keep'>Nie</button>";
          echo "</form>";
          mysqli_close($conn);
          exit;
        }
      } else {
        createTable($conn, $tableName);
        echo "Tabela utworzona.<br>";
      }

      // Zapis konfiguracji do pliku
      include("generation.php");

      echo "<br><a href='a2.php'>Przejdź do wyświetlania danych</a>";

      mysqli_close($conn);
    }
  } else {
    showForm($host, $user, $database);
  }

  function createTable($conn, $tableName)
  {
    $sql = "CREATE TABLE IF NOT EXISTS $tableName (
            id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            imie varchar(20) NOT NULL,
            ocena int NOT NULL,
            umie_apache boolean NOT NULL,
            muzyka text NOT NULL,
            data_egzekucji date NOT NULL
          )";
    if (!mysqli_query($conn, $sql)) {
      die("Błąd tworzenia tabeli: " . mysqli_error($conn));
    }
  }

  function showForm($host, $user, $database)
  {
    ?>
    <form method="POST">
      Host: <input type="text" name="host" value="<?php echo htmlspecialchars($host, ENT_QUOTES, "UTF-8"); ?>"
        required><br>
      User: <input type="text" name="user" value="<?php echo htmlspecialchars($user, ENT_QUOTES, "UTF-8"); ?>"
        required><br>
      Password: <input type="password" name="password"><br>
      Database: <input type="text" name="database" value="<?php echo htmlspecialchars($database, ENT_QUOTES, "UTF-8"); ?>"
        required><br>
      <input type="submit" value="Zapisz konfiguracje">
    </form>
    <?php
  }
  ?>
</body>

</html>