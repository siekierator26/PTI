<?php
$sort = $_GET['sort'] ?? 'id';
$order = $_GET['order'] ?? 'ASC';

$allowed_columns = ['id', 'imie', 'ocena', 'umie_apache', 'muzyka', 'data_egzekucji'];
if (!in_array($sort, $allowed_columns)) {
    $sort = 'id';
}
if ($order != 'ASC' && $order != 'DESC') {
    $order = 'ASC';
}

$new_order = ($order == 'ASC') ? 'DESC' : 'ASC';

$sql1 = "SELECT * FROM samochody ORDER BY $sort $order";
?>