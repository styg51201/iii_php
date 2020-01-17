<?php 
    require_once('./checkSession.php');
?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <!-- 引入 jQuery 的函式庫 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
    .border {
        border: 1px solid;
    }
    .show{
        width:300px;
        height:200px;
    }
    #imgShow{
        width:100%;
        /* height:100%; */
        object-fit:cover;
    }
    </style>
</head>
<body>

<a href="./index.php">首頁</a>
<a href="./setting.php">版面設定</a>

<!-- 要有表單傳送 , 有上傳檔案一定要加 enctype="multipart/form-data -->
<form name="myForm" method="POST" action="./insert.php" enctype="multipart/form-data">
    <h3>設定圖片名稱</h3>
    <div style="margin-left: 23px;">
        <label>圖片名稱: <input type="text" name="Name" value="" maxlength="20" /></label>
    </div>

    <h3>請上傳圖片</h3>
    
    <div style="margin-left: 23px;">
    <!-- accept="image/*" => 只能上傳圖片檔 -->
        <input type="file" name="Img" id="filed" accept="image/*"/>
    </div>
    <br>

    <div class="show">
        <img id="imgShow">
    <div>

    <a href="./addForm.php">上一步</a>
    <input type="submit" value="確認"/>

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
</html>