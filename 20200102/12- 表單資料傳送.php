<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
    <!-- action 把資料傳送到12-1.php那邊 -->
    <form name="myForm" method="post" action="./12-1.php">

        <label>Name</label>
        <input type="text" name="myName" value="" >
        <!-- name=key -->

        <label>Age</label>
        <input type="text" name="myAge" value="" >

        <hr>
        <!-- type 是radio , myGender這個key  只會有唯一一個值男或女 -->
        <label>Male:</label><input type="radio" name="myGender" value="男">
        <label>Female:</label><input type="radio" name="myGender" value="女" checked>
        <hr>

        <!-- checkbox 複選的項目, name要等於一個中括號, 這樣複選的東西可以用陣列索引來取得-->
        <label>Red</label>
        <input type="checkbox" name="myColor[]" value="Red" />
        <label>Yellow</label>
        <input type="checkbox" name="myColor[]" value="Yellow" />
        <label>Green</label>
        <input type="checkbox" name="myColor[]" value="Green" />
        <label>White</label>
        <input type="checkbox" name="myColor[]" value="White" />
        <hr />

        <input type="submit" name="smb" value="Send">


    </form>
</body>
</html>