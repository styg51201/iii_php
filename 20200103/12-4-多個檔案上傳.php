<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
    <form name="myForm" method="POST" action="./12-4-1.php" enctype="multipart/form-data">
        <h3>請選擇所要上傳的檔案</h3> 
        <!-- name="myFile[]"  要放[] =>陣列 -->
        <label>檔案 1: </label><input type="file" name="myFile[]" /><br />
        <label>檔案 2: </label><input type="file" name="myFile[]" /><br />
        <label>檔案 3: </label><input type="file" name="myFile[]" /><br />
        <hr />
        <input type="submit" name="smb" value="Send" />
    </form>
</body>
</html>