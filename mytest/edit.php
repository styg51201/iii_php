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

<a href="./setting.php">返回設定</a>

<form name="myForm" method="POST" action="updateEdit.php" enctype="multipart/form-data">

    <table class="border">
        <tbody>

            <?php 

            $sql = "SELECT `Id`,`Class`,`Name`,`Img`,`Status`
            FROM `ad`
            WHERE `Id`= ?";

            $arr=[$_GET['editId']];
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arr);

            if( $stmt->rowCount() > 0){
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        ?>
            <tr>
                <td class="border">Id</td>
                <td class="border">
                <?php echo $arr['Id']; ?>
                <input type="hidden" name="Id" value="<?php echo $arr['Id']; ?>"/>
                </td>
            </tr>
            <tr>
                <td class="border">Class</td>
                <td class="border">
                <input type="text" name="Class" value="<?php echo $arr['Class']?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td class="border">Name</td>
                <td class="border">
                <input type="text" name="Name" value="<?php echo $arr['Name']; ?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td class="border">Img</td>
                <td class="border">
                <img id=show src="./images/<?php echo $arr['Img'] ?>">
                </td>
            </tr>
            <tr>
                <td class="border">上傳</td>
                <td class="border">
                <input type="file" name="Img"/>
                </td>
            </tr>
            <tr>
                <td class="border">Status</td>
                <td class="border">
                <?php 
                    $Df="";
                    $Ch="";
                    $On="";
                    $Dn="";
                switch($arr['Status']) {
                    case '預設':
                        $Df='checked';
                    break;
                    case '審核':
                        $Ch='checked';
                    break;
                    case '上架':
                        $On='checked';
                    break;
                    case '下架':
                        $Dn='checked';
                    break;
                    }
                ?>
                <input type="radio" name="Status" value="預設" <?php echo $Df ?>>預設
                <input type="radio" name="Status" value="審核" <?php echo $Ch ?>>審核
                <input type="radio" name="Status" value="上架" <?php echo $On ?>>上架
                <input type="radio" name="Status" value="下架" <?php echo $Dn ?>>下架
                </td>
            </tr>
        </tbody>
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