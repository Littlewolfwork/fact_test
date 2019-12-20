<?php

include_once "conf.php";
include_once "db.php";

DB::connect($dbServer, $dbUser, $dbPass, $db);

function deleteUser($id){
    $id=mysqli_real_escape_string(DB::$link, $id);
    $query = "SELECT name FROM users WHERE id=$id";
    $result = mysqli_query(db::$link, $query);
    $tmp = mysqli_fetch_row($result);
    $name = $tmp[0];
    $query = "UPDATE users SET deleted=1 WHERE id=$id";
    mysqli_query(db::$link, $query);
    return $name;
}



if (isset($_POST["group"])){
    $listId = $_POST["check"];
    $names="";
    foreach ($listId as $key=>$value){

        $names .= deleteUser($key).", ";

    }
    echo "<div style='text-align: center'>Пользователи $names удалены! <br>";
    echo "<a href='index.php'>Вернуться к списку пользователей</a></div>";
    mysqli_close(db::$link);
    exit;

}
else{
    if (isset($_GET["id"])){
        $id = $_GET["id"];
    }
    else{
        mysqli_close(db::$link);
        header("Location: index.php");
        exit;
    }
    $name = deleteUser($id);
    mysqli_close(db::$link);
    echo "<div style='text-align: center'>Пользователь $name удален! <br>";
    echo "<a href='index.php'>Вернуться к списку пользователей</a></div>";



}