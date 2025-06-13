
<?php
$db_server = "localhost";
$db_user   = "root";
$db_pass   = ""; // ← исправлено
$db_name   = "localdb2";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// mysqli_select_db — не нужен, если база указана в mysqli_connect
echo "Успешное подключение к базе данных! . <br>";
?>