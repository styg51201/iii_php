<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <style>
    .border {
        border: 1px solid;
    }
    </style>
</head>
<body>

<a href="./index.php">首頁</a>
<a href="./setting.php">版面設定</a>

<!-- 要有表單傳送 , 有上傳檔案一定要加 enctype="multipart/form-data -->
<form name="myForm" method="POST" action="./insert.php" enctype="multipart/form-data">

<table class="border">

    <thead>
        <tr>
        <!-- 流水號ID , 新增時間和修改時間 資料庫會自動產生 , 所以這邊不用填 -->
            <th class="border">Class</th>
            <th class="border">Name</th>
            <th class="border">Img</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border">
                <input type="text" name="Class" id="Class" value="" maxlength="20" />
            </td>
            <td class="border">
                <input type="text" name="Name" id="Name" value="" maxlength="20" />
            </td>
            <td class="border">
                <input type="file" name="Img" />
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td class="border" colspan="7"><input type="submit" name="smb" value="新增"></td>
        </tr>
    </tfoot>
</table>
    <input type="hidden" name="Status" value="下架"/>
</form>

</body>
</html>