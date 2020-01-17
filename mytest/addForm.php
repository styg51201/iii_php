<?php
require_once('./checkSession.php');
// require_once('./db.inc.php');

?>

<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <style>
    
    </style>
</head>
<body>
<a href="./setting.php">返回設定</a>
    

    <form name="myForm" method="post" action="./formChk.php">
        <h3>欲設置廣告的目標</h3>
        <div style="margin-left: 23px;">
            <label>
                <input type="radio" class="form-check-input" name="target" value="提升品牌知名度"
                    checked>提升品牌知名度
            </label>
            <br>
            <label>
                <input type="radio" class="form-check-input" name="target" value="成長交易量"
                    checked>成長交易量
            </label>

        </div>
        <h3>選擇方案</h3>
        <div style="margin-left: 23px;">
            <label>
                <input type="radio" class="form-check-input" name="type" value="曝光千次"
                    checked>曝光千次
            </label>
            <br>
            <label>
                <input type="radio" class="form-check-input" name="type"
                    value="點擊量">點擊量
            </label>
        </div>
        <h3>版面位置</h3>
        <div style="margin-left: 23px;">
            <label>
                <input type="radio" class="form-check-input" name="place" value="商品首頁頭版"
                    checked>商品首頁頭版
            </label>
            <br>
            <label>
                <input type="radio" class="form-check-input" name="place"
                    value="精選商品頭版">精選商品頭版
            </label>
        </div>
        <h3>選擇日期</h3>
        <div style="margin-left: 23px;">
            <label>開始時間: 
                <input type="date" name="startTime" value="<?php echo date('Y-m-d'); ?>">
            </label>
            <br>
            <label>結束時間: 
                <input type="date" name="dueTime">
            </label>
        </div>
            
        <h3>此廣告名稱</h3>
        <div style="margin-left: 23px;">
        <label>設定名稱為: <input type="text" name="name"></label>
        </div>
        <br>
        <input type="submit" value="下一步"/>
    <form>
</body>