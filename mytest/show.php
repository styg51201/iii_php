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
    #slider{
        border:1px solid #000;
        height:500px;
        
    }
    #slider img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    *{
        color:#aaaaaa;
    }
    #back{
        color:#0000FF;
    }
    </style>
</head>
<body>

<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
        <h1>Basic 73
            版面設定
        <a id="back" href="./setting.php">返回</a>

        </h1>

      <h2>Free HTML5 Website Template</h2>
    </div>

  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- content body -->

    <section id="slider">

    <?php 
        $sql = "SELECT `Img` FROM `ad` WHERE `Id` = ?";
        $arrParam = [$_GET['showId']];
        $stmt=$pdo->prepare($sql);
        $stmt->execute($arrParam);
       
        if($stmt->rowCount() > 0){
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    ?>  
    <img src="./images/<?php echo $arr['Img'] ?>">
        <?php } ?>
    
    </section>

    <!-- main content -->
    <div id="content">
      <!-- section 2 -->
      <section>
        <!-- article 1 -->
        <article>
          <h1>&lt;h1&gt; to &lt;h6&gt; - Headline Colour and Size Are All The Same</h1>
          <p>This is a W3C compliant free website template from <a href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a>. For full terms of use of this template please read our <a href="https://www.os-templates.com/template-terms">website template licence</a>.</p>
          <p>You can use and modify the template for both personal and commercial use. You must keep all copyright information and credit links in the template and associated files. For more HTML5 templates visit <a href="https://www.os-templates.com/">free website templates</a>.</p>
        </article>
        <!-- / articles -->
      </section>


</form>
</body>
</html>
