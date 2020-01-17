<?php
require_once('./db.inc.php'); //引用資料庫連線

$sql = "SELECT *
        FROM `class`";
$stmt = $pdo->prepare($sql);
$stmt->execute();



?>

<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
    .border {
        border: 1px solid;
    }
    </style>
</head>
<a href="./index.php">首頁</a>
<a href="./admin.php">總表</a>
<a href="./newStickers.php">新增單一貼圖</a>

<hr>

<ul id="showClass">
    <?php if($stmt->rowCount() > 0) {  
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        for($i=0; $i < count($arr) ;$i++){
           
            echo '<li>'.$arr[$i]['cName'].'</li>';
        }
    } else{ echo '無類別';} ?>

</ul>

<form name="myForm" method="POST" action="./insertClass.php">
<table class="border">
    <thead>
        <tr>
            <th class="border">新增類別名稱</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border">
                <input type="text" id="cName" name="cName" value="" maxlength="10" />
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
        <td class="border"><input type="submit" name="smb" value="新增"></td>
        </tr>
    </tfoot>
</table>
</form>
