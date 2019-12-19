<?php
session_start();

function checkTransfer($nameVar){
    if (isset($_POST[$nameVar])) {
        return $_POST[$nameVar];
    } else {
        $_SESSION["error"] = "Ошибка при передаче данных! ($nameVar)";
        header("Location: adduser.php");
        exit;
    }
}

include_once "conf.php";
$link = mysqli_connect($dbServer, $dbUser, $dbPass, $db);
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
}

if (isset($_POST["submited"])) {
    $login = checkTransfer("login");
    $name = checkTransfer("name");
    $mail = checkTransfer("mail");
    $password = checkTransfer("password");
    $query = "SELECT COUNT(*) FROM users WHERE login='$login'";
    $result = mysqli_query($link, $query);
    $tmp = mysqli_fetch_row($result);
    $countUsers = $tmp[0];
    if ($countUsers > 0) {
        $_SESSION["error"]="Такой пользователь уже существует!";
        header("Location: adduser.php");
        exit;
        }
    else{

        // TODO добавить проверку значений на корректность mysql

        $query = "INSERT INTO users(login,name,mail,password, date) VALUES ('$login','$name','$mail','".md5($password)."', CURRENT_TIMESTAMP)";
        mysqli_query($link, $query);
        $_SESSION["created"] = "created";
        header("Location: adduser.php");
        exit;
    }

}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавление пользователя</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php
    if (!empty($_SESSION["created"])) {
        unset($_SESSION["created"]);
        echo "Пользователь успешно создан! <br>";
        echo "<a href='index.php'>Вернуться к списку пользователей</a>";
        exit();
    }
    if (!empty($_SESSION["error"])) {
        $error = $_SESSION["error"];
        unset($_SESSION["error"]);
        $login = $_SESSION["login"];
        $name = $_SESSION["name"];
        $mail = $_SESSION["mail"];
    } else {
        $error = "";
        $login = "";
        $name = "";
        $mail = "";
    }
    echo $error . "<br>";
    ?>
    <form action="adduser.php" method="post" class="add-user-form" id="user_form">
        <fieldset class="user-form-info">
            <label id="alerts"></label>

        <label>Логин*: <input type="text" value="<?php echo $login?>" id="login" name="login"></label>
        <label>Имя: <input type="text" value="<?php echo $name?>" id="name" name="name"></label>
        <label>Почта: <input type="text" value="<?php echo $mail?>" id="mail" name="mail"></label>
        <label>Пароль: <input type="password" id="password" name="password"></label>
        <label>Подтверждение пароля: <input type="password" id="password2"></label>
        <input type="hidden" name="submited" value="submited">
        </fieldset>
        <fieldset class="user-form-action">
        <input type="button" value="Добавить" class="btn" onclick="checkField()">
        </fieldset>
    </form>

       

</div>
<script src="checkfield.js"></script>
</body>
</html>




