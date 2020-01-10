<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
<!-- enctype="multipart/form-data" 上傳檔案的話一定要加 -->
    <form name="myForm" method="POST" action="./12-3-1.php" enctype="multipart/form-data">
        <input type="file" name="myFile">
        <hr />
        <input type="submit" name="smb" value="Send" />
    </form>
</body>
</html>