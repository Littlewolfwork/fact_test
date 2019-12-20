<?php
include_once "conf.php";
include_once "db.php";

DB::connect($dbServer, $dbUser, $dbPass, $db);

if (isset($_GET["prevPage"])) {
    $prevPage = $_GET["prevPage"];
    $nextPage = $prevPage+$сountRowPerPage;
} else {
    $prevPage = 0;
}
if (isset($_GET["nextPage"])) {
    $nextPage = $_GET["nextPage"];
    $prevPage = $nextPage - $сountRowPerPage;
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
    <h1>Список пользователей</h1>
    <a href="adduser.php">Добавить пользователя</a>
    <br>
    <br>
    <form action="deluser.php" method="post" id="formDelete">
        <input type="submit" value="Удалить выбранных пользоватей" class="btn">
        <input type="hidden" name="group" value="group">
    </form>
    <br>
    <div class = "navigation">
        <?php
        $query = "SELECT COUNT(*) FROM users WHERE deleted<>1 ";
        $result = mysqli_query(db::$link, $query);
        $tmp = mysqli_fetch_row($result);
        $countPage = (int)($tmp[0]/$сountRowPerPage)+1;
        if ($prevPage!=0){
            echo "<a href=\"index.php?prevPage=".($prevPage-$сountRowPerPage)."&nextPage=$prevPage\"> < </a>";
        }
        for($i=0;$i<$countPage;$i++){

            if ((($prevPage/$сountRowPerPage))==$i){
                $currentPage = "class='current-page'";
            }
            else{
                $currentPage = "";
            }
            echo " <a href='index.php?prevPage=".($i*$сountRowPerPage)."&nextPage=".(($i+1)*$сountRowPerPage)."' $currentPage>".($i+1)."</a> ";
        }

        if ($nextPage<($countPage*$сountRowPerPage)){
            echo "<a href=\"index.php?prevPage=$nextPage&nextPage=".(($nextPage+$сountRowPerPage))."\"> > </a>";
        }

        ?>
    </div>
    <table class="users">
        <tr>
            <th class="check"><input type="checkbox" onclick="actionGroupCheck()" class="th-checkbox"></th>
            <th width="30%">Имя</th>
            <th width="30%">Логин</th>
            <th width="30%">Почта</th>
            <th width="25px"></th>
        </tr>

        <?php
        $query = "SELECT id, name, login, mail FROM users WHERE deleted<>1 LIMIT $prevPage,$nextPage";
        $result = mysqli_query(db::$link, $query);
        while($tmp = mysqli_fetch_array($result)){
            echo "<tr><td class=\"check\"><input type=\"checkbox\" name='check[".$tmp["id"]."]' form='formDelete' class='user-checkbox'>
                    <td>".$tmp["name"]."</td>
                    <td>".$tmp["login"]."</td>
                    <td>".$tmp["mail"]."</td>
                    <td><a href='deluser.php?id=".$tmp["id"]."'><img src='delete.png'></a></td></tr>"  ;
        }
        mysqli_close(db::$link);
        ?>

    </table>

</div>
<script src="main.js"></script>
</body>
</html>

<?php
