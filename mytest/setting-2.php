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
<a href="./index.php">首頁</a>
<a href="./addForm.php">新增廣告</a>
<a href="./setting.php">總覽</a>
<?php 
        $sql = 'SELECT *
                FROM `plan` 
                WHERE `username` = ?';
        $arrParam = [$_SESSION['username']];
        $stmt=$pdo->prepare($sql);
        $stmt->execute($arrParam);
        if($stmt->rowCount() > 0){ ?>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>名稱</th>
            <th>目標</th>
            <th>方案</th>
            <th>位置</th>
            <th>狀態</th>
            <th>開始時間</th>
            <th>結束時間</th>
            <th>修改</th>
            <th>刪除</th>
            <th>設定</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        for($i=0; $i < count($arr); $i++){ 
    // echo '<pre>';
    // print_r($arr);
    // print_r(count($arr));
    // echo '</pre>';
            
            ?>
        <tr>
            <td><?php echo $arr[$i]['id'] ?></td>
            <td><?php echo $arr[$i]['name'] ?></td>
            <td><?php echo $arr[$i]['target'] ?></td>
            <td><?php echo $arr[$i]['type'] ?></td>
            <td><?php echo $arr[$i]['place'] ?></td>
            <td><?php echo $arr[$i]['status'] ?></td>
            <td><?php echo $arr[$i]['startTime'] ?></td>
            <td><?php echo $arr[$i]['dueTime'] ?></td>
            <td><a href="editPlan.php?editId=<?php echo $arr[$i]['id'] ?>">修改</a></td>
            <td><a href="deletePlan.php?deleteId=<?php echo $arr[$i]['id'] ?>">刪除</a></td>
            <td><a href="updatePlanAlert.php?updateId=<?php echo $arr[$i]['id'] ?>">設定</a></td>
            <?php 
                $sqlAd = 'SELECT *
                FROM `ad`
                WHERE `PlanId` = ?';
                $arrAd = [$arr[$i]['id']];
                $stmtAd=$pdo->prepare($sqlAd);
                $stmtAd->execute($arrAd);
                if($stmtAd->rowCount() > 0){
                    $brr = $stmtAd->fetchAll(PDO::FETCH_ASSOC);
                    for($k=0; $k < count($brr); $k++){ 
            ?>
                <td><?php echo $brr[$k]['Name'] ?></td>
                <td><img id=show src="./images/<?php echo $brr[$k]['Img'] ?>"></td>
                <td>
                <a href="./show.php?showId=<?php echo $brr[$i]['Id'] ?>">瀏覽</a>
                </td>
                <td><a href="editAd.php?editId=<?php echo $brr[$k]['Id'] ?>">修改</a></td>
                <td><a href="deleteAd.php?deleteId=<?php echo $brr[$k]['Id'] ?>">刪除</a></td>   
            <?php
                    }      
                }else{ 
            ?>
                <td>查無資料</td>
            <?php
                } ?>
        </tr>        
<?php   } ?>
    </tbody>

</table>
<?php }else{echo '<br>尚無資料';}?>