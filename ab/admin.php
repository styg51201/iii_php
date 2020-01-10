<?php 

require_once('./checkSession.php');
require_once('./db.inc.php');

//查詢總比數
$sqlTotal = "SELECT count(`id`) AS `count` FROM `students`";
//取得總比數
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];
//設定每一頁顯示的比數
$numPerPage = 5;
//算出總共會有幾頁 ceil=無條件進位 總共16筆/每頁最多5筆=3餘1 無條件進位把餘數也算進新的頁面 等於總頁數是4
$totalPages = ceil($total/$numPerPage);
//得出所在頁面 如果有page 存在  那就是page的值 如果不再 那就等於第1頁
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
//如果 page小於1的話  那就是等於1 不是的話就是page的值
$page = $page < 1  ? 1 : $page;

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
    </style>
</head>
<body>
<?php require_once('./temp/title.php')?>

<form name="myForm" method="POST" action="deleteIds.php">

<table class="border">
    <thead>
        <tr>
            <th class="border">id</th>
            <th class="border">studentId</th>
            <th class="border">studentName</th>
            <th class="border">studentGender</th>
            <th class="border">studentBirthday</th>
            <th class="border">studentPhoneNumber</th>
            <th class="border">studentDescription</th>
            <th class="border">studentImg</th>
            <th class="border">created_at</th>
            <th class="border">updated_at</th>
            <th class="border">修改</th>
            <th class="border">刪除</th>
        </tr>
    </thead>
    <tbody>

    <?php

    $sql='SELECT *
        FROM `students`
        LIMIT ? , ?';

    //秀出每頁的商品的公式..
    $arrParam = [
        ($page - 1) * $numPerPage,
        $numPerPage
    ];


    $stmt =$pdo->prepare($sql);
    $stmt->execute($arrParam);

    if($stmt->rowCount() > 0){
        $arr= $stmt->fetchAll(PDO::FETCH_ASSOC); //從資料庫撈出來的結果是陣列
        for($i=0; $i < count($arr); $i++){
    ?>

    <tr>
        <td class="border">
         <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['id'] ?>" >
          </td>
        <td class="border"><?php echo $arr[$i]['studentId'] ?></td>
        <td class="border"><?php echo $arr[$i]['studentName'] ?></td>
        <td class="border"><?php echo $arr[$i]['studentGender'] ?></td>
        <td class="border"><?php echo $arr[$i]['studentBirthday'] ?></td>
        <td class="border"><?php echo $arr[$i]['studentPhoneNumber'] ?></td>
        <!-- nl2br換斷行 -->
        <td class="border"><?php echo nl2br($arr[$i]['studentDescription']) ?></td>
        <td class="border">
        
        <?php if($arr[$i]['studentImg']){ ?>
            <img src="./file/<?php echo $arr[$i]['studentImg'] ?>">
        <?php } else {?>
            <a href="./edit.php?editId=<?php echo $arr[$i]['id']?>">上傳照片
        <?php } ?>
    
        </td>
        <td class="border"><?php echo $arr[$i]['created_at'] ?></td>
        <td class="border"><?php echo $arr[$i]['updated_at'] ?></td>
        <td class="border"><a href="./edit.php?editId=<?php echo $arr[$i]['id']?>">修改</td>
        <td class="border"><a href="./delete.php?deleteId=<?php echo $arr[$i]['id']?>">刪除</td>
    </tr>
    <?php
        }
    }

    
    ?>
            </tbody>
            <tfoot>
                <tr>
                <!-- 頁數 -->
                    <td class="border" colspan="11">
                    <?php
                    for($i = 1; $i <= $totalPages; $i++){
                    ?>
                    <!-- 用GET傳送去要哪一頁 -->
                    <a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
                    <?php
                    }
                    ?>
                    </td>
                </tr>
            </tfoot>

        </table>
        <input type="submit" name="smb" value="刪除">
    </form>
    
    </body>
</html>