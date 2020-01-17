<?php
require_once('./db.inc.php');

?>

<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <style>
    .border {
        border: 1px solid;
    }
    .w200px {
        width: 200px;
    }
    #show{
        width:200px;
        height:200px;
        object-fit:cover;
    }
    </style>
</head>
<body>

<a href="./admin.php">返回總表</a>

<form name="myForm" method="POST" action="updateEdit.php" enctype="multipart/form-data">

    <table class="border">
        <tbody>
        <?php 

            $sql = "SELECT `id`,`cName`,`sName`,`sImgName`,`stickers`.`sCid`
            FROM `stickers` INNER JOIN `class`
            ON `stickers`.`sCid` = `class`.`cId`
            WHERE `id`= ?";

            $arr=[$_GET['editId']];
            $stmt = $pdo->prepare($sql);
            // echo '<pre>';
            // print_r($arr);
            // echo '</pre>';
            // echo '<pre>';
            // print_r($sql);
            // echo '</pre>';

            $stmt->execute($arr);
           
            if( $stmt->rowCount() > 0){
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        ?>
        <tr>
                <td class="border">Id</td>
                <td class="border">
                <?php echo $arr['id']; ?>
                <input type="hidden" name="id" value="<?php echo $arr['id']; ?>"/>
                </td>
            </tr>
            <tr>
                <td class="border">類別</td>
                <td class="border">
                <select name='sCid'>
                <?php   $sql = "SELECT * FROM `class`";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(); 
                        $brr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $chk="";
                        for($i=0; $i < count($brr); $i++){ 
                            echo '<option value='.$brr[$i]['cId'].'>'.$brr[$i]['cName'].'</option>';
                        }
                ?>
                </select>
                </td>
            </tr>
            <tr>
                <td class="border">名稱</td>
                <td class="border">
                <input type="text" name="sName" value="<?php echo $arr['sName']; ?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td class="border">貼圖</td>
                <td class="border">
                <img id=show src="./line/<?php echo $arr['sImgName'] ?>">
                </td>
            </tr>
            <tr>
                <td class="border">上傳</td>
                <td class="border">
                <input type="file" name="sImgName"/>
                </td>
            </tr>
            <tfoot>
            <tr>
            <td class="border" colspan="6"><input type="submit" name="smb" value="修改"></td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="editId" value="<?php echo (int)$_GET['editId']; ?>">
</form>
</body>
</html>
<?php } else {
                header("Refresh: 3; url=./setting.php");
                echo "沒有資料";
                exit();
            }
            ?>