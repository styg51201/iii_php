<?php
require_once('./db.inc.php');

$sql = "SELECT * FROM `class`";
$stmt = $pdo->prepare($sql);
$stmt->execute(); ?>

<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <style>
    .border {
        border: 1px solid;
    }
    </style>
</head>
<body>

<a href="./index.php">首頁</a>
<a href="./admin.php">總表</a>
<a href="./newClass.php">新增類別</a>


<!-- 要有表單傳送 , 有上傳檔案一定要加 enctype="multipart/form-data -->
<form name="myForm" method="POST" action="./insert.php" enctype="multipart/form-data">

<table class="border">

    <thead>
        <tr>
        <!-- 流水號ID , 新增時間和修改時間 資料庫會自動產生 , 所以這邊不用填 -->
            <th class="border">類型</th>
            <th class="border">名稱</th>
            <th class="border">貼圖</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border">

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

            </td>
            <td class="border">
                <input type="text" name="sName" id="sName" value="" maxlength="20" />
            </td>
            <td class="border">
                <input type="file" name="sImgName" />
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td class="border" colspan="7"><input type="submit" name="smb" value="新增"></td>
        </tr>
    </tfoot>
</table>
</form>

</body>
</html>