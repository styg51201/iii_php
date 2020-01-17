
<?php
require_once('./db.inc.php');

$sql = "SELECT * FROM `class`";
$stmt = $pdo->prepare($sql);
$stmt->execute(); ?>

<a href='./admin.php'>總表</a>
<a href="./newClass.php">新增類別</a>
<br><hr>

<form name="myForm" method="post" action="./curl.php">

            <label>網址:</label>
            <input type="text" name="sUrl" value=""/> <a href="https://store.line.me/stickershop/showcase/top/zh-Hant">前往Line貼圖</a>
            <br><hr>
            <label>類別:</label>
            <select name='sCid'>

<?php
if( $stmt->rowCount() > 0){

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0; $i < count($arr); $i++){ 
            echo '<option value='.$arr[$i]['cId'].'>'.$arr[$i]['cName'].'</option>';
    }
}else{
    echo '<input type="text" name="cName" value=""/>';
}?>
            </select>
            <br><hr>
            <label>名稱:</label>
            <input type="text" name="sName" value=""/>
            <br><hr>
            <input type="submit" value="送出" />

        </form>

    
