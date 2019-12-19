<?php
include_once "conf.php";
$link = mysqli_connect($dbServer, $dbUser, $dbPass, $db);
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
}


if (isset($_POST["group"])){
    $listId = $_POST["check"];
    $names="";
    foreach ($listId as $key=>$value){
        $query = "SELECT name FROM users WHERE id=$key";
        $result = mysqli_query($link, $query);
        $tmp = mysqli_fetch_row($result);
        $names .= $tmp[0].", ";
        $query = "UPDATE users SET deleted=1 WHERE id=$key";
        mysqli_query($link, $query);
    }
    echo "<div style='text-align: center'>Пользователи $names удалены! <br>";
    echo "<a href='index.php'>Вернуться к списку пользователей</a></div>";

    exit;

}
else{
    if (isset($_GET["id"])){
        $id = $_GET["id"];
    }
    else{
        header("Location: index.php");
        exit;
    }

    $query = "SELECT name FROM users WHERE id=$id";
    $result = mysqli_query($link, $query);
    $tmp = mysqli_fetch_row($result);
    $name = $tmp[0];
    $query = "UPDATE users SET deleted=1 WHERE id=$id";
    mysqli_query($link, $query);
    echo "<div style='text-align: center'>Пользователь $name удален! <br>";
    echo "<a href='index.php'>Вернуться к списку пользователей</a></div>";



}