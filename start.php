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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="start.php" method="Post">
        <label for="">Username:</label> <br>
        <input type="text" name="username" id=""><br>
        <label for="">Password:</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Registr">
    </form>
</body>
</html>