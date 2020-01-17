<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

?>

<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <!-- 引入 jQuery 的函式庫 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
    td,th{
        border:1px solid;
    }
    table{
        border-collapse:collapse;
    }
    #imgShow{
        width:300px;
        height:200px;
        object-fit:cover;
        object-fit:contain;
    }
    </style>
</head>
<body>
    <a href="./setting.php">返回設定</a>

    <form name="myForm" method="POST" action="updateEditAd.php" enctype="multipart/form-data">

    <table>
        <tbody>
            <?php 

            $sql = 'SELECT *
            FROM `ad` 
            WHERE `Id` = ?';

            $arrParam = [$_GET['editId'],
                    ];

            // echo '<pre>';
            // print_r($arrParam);
            // echo '</pre>';

            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            if( $stmt->rowCount() > 0){
                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        ?>
            
            <td colspan="2">詳細資料
            <input type="hidden" name="Id" value="<?php echo $arr['Id']; ?>">
            </td>
            </tr>
            <tr>
                <td>圖片名稱</td>
                <td>
                <input type="text" name="Name" value="<?php echo $arr['Name']; ?>" maxlength="20" />
                </td>
            </tr>
            <tr>
                <td>圖片</td>
                <td>
                <img id="imgShow" src="./images/<?php echo $arr['Img'] ?>">
                </td>
            </tr>
            <tr>
                <td>上傳</td>
                <td>
                <input type="file" name="Img" id="filed"/>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <input type="hidden" name="editId" value="<?php echo (int)$_GET['editId']; ?>">
    </table>
    <br>
    <input type="submit" name="smb" value="修改">
    </form>
    <script>
        
    $('#filed').change(function(){
    //獲取input file的files檔案陣列;
    //$('#filed')獲取的是jQuery物件，.get(0)轉為原生物件;
    //這邊預設只能選一個，但是存放形式仍然是陣列，所以取第一個元素使用[0];
        var file = $('#filed').get(0).files[0];
        //建立用來讀取此檔案的物件
        var reader = new FileReader();
        //使用該物件讀取file檔案
        reader.readAsDataURL(file);
        //讀取檔案成功後執行的方法函式
        reader.onload=function(e){
        //讀取成功後返回的一個引數e，整個的一個進度事件
        //選擇所要顯示圖片的img，要賦值給img的src就是e中target下result裡面
        //的base64編碼格式的地址
        $('#imgShow').get(0).src = e.target.result;
        console.log(e.target.result);
        }
    })

</script>
</body>