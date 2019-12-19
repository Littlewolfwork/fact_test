<?php
include_once "conf.php";

if (isset($_GET["prevPage"])) {
    $prevPage = $_GET["prevPage"];
} else {
    $prevPage = 0;
}
if (isset($_GET["nextPage"])) {
    $nextPage = $_GET["nextPage"];
} else {
    $nextPage = $сountRowPerPage;
}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список пользователей</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">
    <input type="button" value="Добавить пользователя">
    <br>
    <table class="users">
        <tr>
            <th class="check"><input type="checkbox"></th>
            <th>Имя</th>
            <th>Логин</th>
            <th>Почта</th>
            <th></th>
        </tr>

        <?php

        $link = mysqli_connect($dbServer, $dbUser, $dbPass, $db);
        if (!$link) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        }
        $query = "SELECT id, name, login, mail FROM users WHERE deleted<>1 LIMIT $prevPage,$nextPage";
        $result = mysqli_query($link, $query);
        while($tmp = mysqli_fetch_array($result)){
            echo "<tr><td class=\"check\"><input type=\"checkbox\">
                    <td>".$tmp["name"]."</td>
                    <td>".$tmp["login"]."</td>
                    <td>".$tmp["mail"]."</td>
                    <td><a href='deluser.php?id=".$tmp["id"]."'><img src='delete.png'></a></td></tr>"  ;
        }
        $query = "SELECT COUNT(*) FROM users WHERE deleted<>1 ";
        $countPage = (int)(mysqli_fetch_row($result)/$сountRowPerPage)+1;
        mysqli_close($link);
        ?>

    </table>
    <div class = "navigation">
    <?php
    if ($prevPage!=0){
        echo "<a href=\"index.php?prevPage=".(($prevPage-1)*$сountRowPerPage)."\"><</a>";
    }
    for($i=1;$i<=$countPage;$i++){

        if ((($prevPage/$сountRowPerPage)+1)==$i){
            $currentPage = "class='current-page'";
        }
        else{
            $currentPage = "";
        }
        echo " <a href='index.php?prevPage=".(($i-1)*$сountRowPerPage)."&nextPage=".((i+1)*$сountRowPerPage)."' $currentPage>$i</a> ";
    }
    if ($nextPage<$countPage){
        echo "<a href=\"index.php?nextPage=".(($nextPage+1)*$сountRowPerPage)."\"><</a>";
    }

    ?>
    </div>
</div>
</body>
</html>

<?php
