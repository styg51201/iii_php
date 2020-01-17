<?php

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
    </style>
</head>
<body>


<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
        <h1><a href="#">Basic 73</a>
        
        <?php 
        session_start();
        if(isset($_SESSION['username'])){
          echo '<a href="./setting.php">版面設定</a> 
                <a href="./logout.php?logout=1">登出</a>';
        }else{
          echo '<a href="./login.php">登入</a>';
        }
        ?>
        <!-- <a href="./setting.php">版面設定</a> -->

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
            // echo $arr['startTime'];
            // echo '<br>';
            // echo date('Y-m-d');
            // echo '<br>';

        $sqlOn = "SELECT  *
                  FROM `plan` INNER JOIN `ad`
                  on `plan`.`id` = `ad`.`planId`
                  WHERE `plan`.`status` = '上架'";

        // $sqlDf = "SELECT  *
        //           FROM `plan` INNER JOIN `ad`
        //           on `plan`.`id` = `ad`.`planId`
        //           WHERE `plan`.`status` = '預設'";
        $today = date('Y-m-d');
        $stmtOn = $pdo->query($sqlOn);
        // echo '<pre>';
        // print_r($sqlOn);
        //  echo '</pre>';
    
        if($stmtOn->rowCount() > 0){
            $arrOn = $stmtOn->fetchAll(PDO::FETCH_ASSOC)[0];
            if( $arrOn['startTime'] <= $today && $arrOn['dueTime'] >= $today ){
    ?>
            <img src="./images/<?php echo $arrOn['Img'] ?>">
    <?php } 
    
        }else{ 
    ?>
            <img src="./images/預設.jpg">
        <?php 
              // $stmtDf=$pdo->query($sqlDf);
              // if($stmtDf->rowCount() > 0){
              //   $arrDf = $stmtDf->fetchAll(PDO::FETCH_ASSOC)[0];
              }?>

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