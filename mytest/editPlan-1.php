<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

?>

<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <style>
    td,th{
        border:1px solid;
    }
    table{
        border-collapse:collapse;
    }
    img{
        width:200px;
        height:100px;
        object-fit:cover;
        object-fit:contain;
    }
    </style>
</head>
<body>
    <a href="./setting.php">返回設定</a>

    <form name="myForm" method="POST" action="updateEditPlan.php" enctype="multipart/form-data">

    <table>
        <tbody>
            <?php 

            $sql = 'SELECT *
            FROM `plan` 
            WHERE `plan`.`id` = ? AND `username` = ?';

            $arrParam = [$_GET['editId'],
                        $_SESSION['username']
                    ];

            // echo '<pre>';
            // print_r($arrParam);
            // echo '</pre>';

            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            if( $stmt->rowCount() > 0){
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        ?>
            <tr>
                <td>流水號</td>
                <td>
                <?php echo $arr['id']; ?>
                <input type="hidden" name="id" value="<?php echo $arr['id']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>名稱</td>
                <td>
                <input type="text" name="name" value="<?php echo $arr['name']; ?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td>目標</td>
                <td>
                <input type="text" name="target" value="<?php echo $arr['target']; ?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td>方案</td>
                <td>
                <input type="text" name="type" value="<?php echo $arr['type']; ?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td>位置</td>
                <td>
                <input type="text" name="place" value="<?php echo $arr['place']; ?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td>狀態</td>
                <td>
                <?php echo $arr['status']; ?>
                <input type="hidden" name="status" value="<?php echo $arr['status']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>開始時間</td>
                <td>
                <input type="date" name="startTime" value="<?php echo $arr['startTime']; ?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td>結束時間</td>
                <td>
                <input type="date" name="dueTime" value="<?php echo $arr['dueTime']; ?>" maxlength="20" />
                </td>
            </tr>
            
            <?php } ?>
        </tbody>
        <input type="hidden" name="editId" value="<?php echo (int)$_GET['editId']; ?>">
    </table>
    <br>
    <input type="submit" name="smb" value="修改">
    </form>

</body>