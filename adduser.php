<?php
session_start();
include_once "conf.php";
include_once "db.php";

DB::connect($dbServer, $dbUser, $dbPass, $db);

function checkTransfer($nameVar){
    if (isset($_POST[$nameVar])) {
        return $_POST[$nameVar];
    } else {
        $_SESSION["error"] = "Ошибка при передаче данных! ($nameVar)";
        mysqli_close(db::$link);
        header("Location: adduser.php");
        exit;
    }
}



if (isset($_POST["submited"])) {
    $login = mysqli_real_escape_string(db::$link, checkTransfer("login"));
    $name =  mysqli_real_escape_string(db::$link, checkTransfer("name"));
    $mail =  mysqli_real_escape_string(db::$link, checkTransfer("mail"));
    $password = checkTransfer("password");
    $query = "SELECT COUNT(*) FROM users WHERE login='$login'";
    $result = mysqli_query(db::$link, $query);
    $tmp = mysqli_fetch_row($result);
    $countUsers = $tmp[0];
    if ($countUsers > 0) {
        $_SESSION["error"]="Такой пользователь уже существует!";
        mysqli_close(db::$link);
        header("Location: adduser.php");
        exit;
        }
    else{
        $query = "INSERT INTO users(login,name,mail,password, date) VALUES ('$login','$name','$mail','".md5($password)."', CURRENT_TIMESTAMP)";
        mysqli_query(db::$link, $query);
        $_SESSION["created"] = "created";
        mysqli_close(db::$link);
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
        mysqli_close(db::$link);
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




