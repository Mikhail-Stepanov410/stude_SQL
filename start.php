<?php
    include("dataBase.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'  ){
    
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
    $username = mysqli_real_escape_string($conn , $username);
    $password = mysqli_real_escape_string($conn , $password);
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $checkQuery = "SELECT * FROM users WHERE user = '$username'" ;
    $result = mysqli_query($conn, $checkQuery) ;

    if(mysqli_num_rows($result) > 0){
        echo"Уже зарегистрирован";
    }
    else{
        $sql = "INSERT INTO users (user , password) VALUES('$username' ,'$hashedPassword' )" ;

        if(mysqli_query($conn, $sql)){
            echo "Регистрация прошла успешно";
        }
        else{
            echo "Ошибка регистрации" . mysqli_error( $conn ) ;
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
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #1d3557, #457b9d);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      color: #fff;
    }

    .register-form {
      background: #ffffff10;
      backdrop-filter: blur(12px);
      border-radius: 16px;
      padding: 30px 40px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
    }

    .register-form h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #f1faee;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #a8dadc;
    }

    .input-group input {
      width: 88%;
      padding: 12px 12px 12px 36px;
      border: none;
      border-radius: 8px;
      background: #f1faee;
      color: #1d3557;
      font-size: 16px;
    }

    .input-group input:focus {
      outline: none;
      box-shadow: 0 0 0 2px #a8dadc;
    }

    .register-form input[type="submit"] {
      width: 100%;
      padding: 12px;
      border: none;
      background-color: #e63946;
      color: #fff;
      border-radius: 8px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .register-form input[type="submit"]:hover {
      background-color: #d62828;
    }
  </style>
</head>
<body>
  <form class="register-form" action="start.php" method="post">
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
</body>
</html>