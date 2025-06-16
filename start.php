<?php
include("dataBase.php");
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $checkQuery = "SELECT * FROM users WHERE user = '$username'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $message = "Пользователь уже зарегистрирован";
    } else {
        $sql = "INSERT INTO users (user, password) VALUES('$username', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            $message = "Регистрация прошла успешно";
        } else {
            $message = "Ошибка регистрации: " . mysqli_error($conn);
        }
    }
}
?>



<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form class="register-form" action="start.php" method="post">
    <div class="message-box" id="messageBox"><?= $message ?></div>  
    <h2><i class="fa-solid fa-user-plus"></i> Регистрация</h2>
    
    <div class="input-group">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="username" placeholder="Имя пользователя" required>
    </div>

    <div class="input-group">
      <i class="fa-solid fa-lock"></i>
      <input type="password" name="password" placeholder="Пароль" required>
    </div>

    <input type="submit" name="submit" value="Зарегистрироваться">
  </form>

    <script>
    const messageBox = document.getElementById('messageBox');
    if (messageBox.textContent.trim() !== '') {
      messageBox.classList.add('show');

      // Убираем через 5 секунд
      setTimeout(() => {
        messageBox.classList.remove('show');
      }, 5000);
    }
  </script>

</body>
</html>