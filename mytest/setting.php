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
<a href="./index.php">首頁</a>
<a href="./new.php">新增</a>

<form name="myForm" method="POST" action="updateStatus.php">
<table class="border">
    <thead>
        <tr>
            <th class="border">Id</th>
            <th class="border">Class</th>
            <th class="border">Name</th>
            <th class="border">Img</th>
            <th class="border">Status</th>
            <th class="border">created_at</th>
            <th class="border">updates_at</th>
            <th class="border">變更狀態</th>
            <th class="border">瀏覽</th>
            <th class="border">修改</th>
            <th class="border">刪除</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sql = 'SELECT *
                FROM `ad`';
        $stmt=$pdo->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            for($i=0; $i<count($arr); $i++){
        ?>
        <tr>
            <td class="border"> <?php echo $arr[$i]['Id'] ?> </td>
            <td class="border"><?php echo $arr[$i]['Class'] ?></td>
            <td class="border"><?php echo $arr[$i]['Name'] ?></td>
            <td class="border">

                <?php if($arr[$i]['Img']){ ?>
                    <img id=show src="./images/<?php echo $arr[$i]['Img'] ?>">
                <?php } else {?>
                   <p>無</p>
                <?php } ?>

            </td>
            <td class="border"><?php echo $arr[$i]['Status'] ?></td>
            <td class="border"><?php echo $arr[$i]['created_at'] ?></td>
            <td class="border"><?php echo $arr[$i]['updates_at'] ?></td>
            <td class="border">
                <input type="radio" name="Status<?php echo $arr[$i]['Id']?>" value="預設">預設
                <input type="radio" name="Status<?php echo $arr[$i]['Id']?>" value="審核">審核
                <input type="radio" name="Status<?php echo $arr[$i]['Id']?>" value="上架">上架
                <input type="radio" name="Status<?php echo $arr[$i]['Id']?>" value="下架">下架
                <input type="hidden" name="editId[]" value="<?php echo $arr[$i]['Id'] ?>">
            </td>
            <td class="border">
                <a href="./show.php?showId=<?php echo $arr[$i]['Id'] ?>">瀏覽</a>
            </td>
            <td class="border">
                <a href="./edit.php?editId=<?php echo $arr[$i]['Id'] ?>">修改</a>
            </td>
            <td class="border"><a href="./delete.php?deleteId=<?php echo $arr[$i]['Id'] ?>">刪除</a></td>

        </tr>
        <?php
            }
        }
        ?>
    </tbody>
             
    </table>
    <input type="submit" name="smb" value="確認">
    </form>
    
    </body>
</html>