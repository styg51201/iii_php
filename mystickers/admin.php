<?php
require_once('./db.inc.php');


$sql = "SELECT * FROM `class`";
$stmt = $pdo->prepare($sql);
$stmt->execute(); 

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
    .wrapper{
       display:flex;
       justify-content: space-around;
    }
    table{
        flex-grow:1;
    }
    </style>
</head>
<body>
<a href="./index.php">首頁</a>
<a href="./newClass.php">新增類別</a>
<a href="./newStickers.php">新增單一貼圖</a>
<hr>
<form name="myForm" method="post" action="./admin.php">
<label>類別篩選</label>
<select name='sCid'>
<option value='all'>全部</option>
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
            <input type="submit" value="送出" />
</form>            


        <?php 
        if(isset($_POST['sCid'])){

            if($_POST['sCid'] == 'all') {
                $sql = 'SELECT `cName`,`id`,`sName`,`sImgName`
                    FROM `stickers` INNER JOIN `class`
                    ON `stickers`.`sCid` = `class`.`cId`';
                $stmt=$pdo->prepare($sql);
                $stmt->execute();
            }else{
            $sql = 'SELECT `cName`,`id`,`sName`,`sImgName`
                    FROM `stickers` INNER JOIN `class`
                    ON `stickers`.`sCid` = `class`.`cId`
                    WHERE `sCid` = ?';
                $arrParam=[$_POST['sCid']];
                $stmt=$pdo->prepare($sql);
                $stmt->execute($arrParam);
            }
        } else{
            $sql = 'SELECT `cName`,`id`,`sName`,`sImgName`
                    FROM `stickers` INNER JOIN `class`
                    ON `stickers`.`sCid` = `class`.`cId`';
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
        }

        if($stmt->rowCount() > 0){
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
<div class="wrapper">        
        <table class="border">
    <thead>
        <tr>
            <th class="border">流水號</th>
            <th class="border">類型</th>
            <th class="border">名稱</th>
            <th class="border">Img</th>
            <th class="border">修改</th>

        </tr>
    </thead>
    
    <tbody>
    <?php    
            for($i=0; $i<count($arr); $i=$i+2){
        ?>
            <tr>
                <td class="border">
                <?php echo $arr[$i]['id'] ?> 
                </td>
                <td class="border">
                <?php echo $arr[$i]['cName'] ?> 
                </td>
                <td class="border">
                <?php echo $arr[$i]['sName'] ?> 
                </td>
                <td class="border">
                <?php if($arr[$i]['sImgName']){ ?>
                        <img id=show src="./line/<?php echo $arr[$i]['sImgName'] ?>">
                    <?php } else {?>
                    <p>無</p>
                    <?php } ?> 
                </td>
                <td class="border"><a href="./edit.php?editId=<?php echo $arr[$i]['id'] ?>">修改
                </a></td>
            </tr>
            <?php
            }
            ?>

    <table class="border">
    <thead>
        <tr>
            <th class="border">流水號</th>
            <th class="border">類型</th>
            <th class="border">名稱</th>
            <th class="border">Img</th>
            <th class="border">修改</th>

        </tr>
    </thead>
    
    <tbody>    
        <?php    
            for($i=1; $i<count($arr); $i=$i+2){

        ?>
            <tr>
                <td class="border">
                <?php echo $arr[$i]['id'] ?> 
                </td>
                <td class="border">
                <?php echo $arr[$i]['cName'] ?> 
                </td>
                <td class="border">
                <?php echo $arr[$i]['sName'] ?> 
                </td>
                <td class="border">
                <?php if($arr[$i]['sImgName']){ ?>
                        <img id=show src="./line/<?php echo $arr[$i]['sImgName'] ?>">
                    <?php } else {?>
                    <p>無</p>
                    <?php } ?> 
                </td>
                <td class="border"><a href="./edit.php?editId=<?php echo $arr[$i]['id'] ?>">修改
                </a></td>
            </tr>
            <?php
            }
        }else{
            echo '尚無資料';
        }
        ?>
    </tbody>
             
    </table>
</div>