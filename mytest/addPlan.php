<?php
require_once './checkSession.php';
require_once './db.inc.php';
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Search Page</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .cost.active{
            display:none;
        }
        .checkbox.active{
            display:none;
        }
    </style>

</head>

<body>

    <div id="wrapper">
        <!-- 左側選單 -->
        <?php require_once './left-nav.php';?>

        <!-- Body -->
        <div id="page-wrapper" class="gray-bg">
            <!-- 上側選單 -->
        <?php require_once './top-nav.php';?>
            <!-- 標題 -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>新增廣告</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Extra Pages
                        </li>
                        <li class="breadcrumb-item active">
                            <strong> Search Page</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- 內文 -->
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <form name="myForm" method="post" action="./formChk.php">

                                    <h3>選擇廣告活動目標</h3>
                                    <div style="margin-left: 23px;">
                                        <label>
                                            <input type="radio" class="form-check-input" name="target" value="提升品牌知名度"
                                                checked>了解我的品牌（提升品牌知名度）
                                        </label>
                                        <br>
                                        <label>
                                            <input type="radio" class="form-check-input" name="target" value="提升交易量"<?php if (isset($_SESSION["target"]) && $_SESSION["target"] == '提升交易量') {echo 'checked';}?>
                                                >造訪我的網頁（提升交易量）
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
                                                value="精選商品頭版"<?php if (isset($_SESSION["place"]) && $_SESSION["place"] == '精選商品頭版') {echo 'checked';}?>>精選商品頭版
                                        </label>
                                        <br>
                                        <label>
                                            <input type="radio" class="form-check-input" name="place" value="商品首頁頭版"
                                                >關鍵字廣告
                                        </label>
                                    </div>
                                    <h3>選擇方案</h3>
                                    <div style="margin-left: 23px;">
                                        <label class="dayType">
                                            <input type="radio" class="form-check-input" name="type" value="曝光天數"
                                                checked>曝光一天 /500元
                                        </label>
                                        <br>
                                        <label class="clickType">
                                            <input type="radio" class="form-check-input" name="type"
                                                value="點擊量"<?php if (isset($_SESSION["type"]) && $_SESSION["type"] == '點擊量') {echo 'checked';}?>>點擊一次 /5元
                                        </label>
                                    </div>
                                    <div class="cost active">
                                        <h3>預算設定</h3>
                                        <div style="margin-left: 23px;">
                                            <label>請輸入預算上限:
                                                <input type="number" name="cost" value="<?php if (isset($_SESSION["cost"]) && $_SESSION["cost"] !== '0') {echo $_SESSION["cost"];} else {echo '0';}?>"> 元
                                            </label>
                                        </div>
                                    </div>
                                    <h3>選擇日期</h3>
                                    <div style="margin-left: 23px;">
                                        <?php $today = date('Y-m-d');?>
                                        <label>開始時間:
                                            <input type="date" name="startTime" value="<?php if (isset($_SESSION["startTime"])) {echo $_SESSION["startTime"];} else {echo $today;}?>">
                                        </label>
                                        <br>
                                        <label>結束時間:
                                            <input type="date" name="dueTime"  value="<?php if (isset($_SESSION["dueTime"])) {echo $_SESSION["dueTime"];} else {echo date("Y-m-d", strtotime($today . "+2 day"));}?>">
                                        </label>
                                    </div>

                                    <h3>此廣告名稱</h3>
                                    <div style="margin-left: 23px;">
                                    <label>設定名稱為: <input type="text" name="name" value="<?php if (isset($_SESSION["name"])) {echo $_SESSION["name"];}?>"></label>
                                    </div>
                                    <!-- 新增 -->
                                    <h3>設定廣告投放對象</h3>
                                    <div style="margin-left: 23px;">
                                    <label class="allPeople"><input type="radio" name="targetPeople" class="form-check-input" value="" checked>所有人</label>
                                    <br>
                                    <label class="somePeople"><input type="radio" name="targetPeople"  class="form-check-input" value="">再行銷</label>
                                    <br>
                                    <div style="margin-left: 23px" class="checkbox active">
                                        <label>
                                        <input type="checkbox" class="form-check-input"value="">曾經購買過我的商品
                                        </label>
                                        <br>
                                        <label>
                                        <input type="checkbox" class="form-check-input"value="">曾經瀏覽過我的商品
                                        </label>
                                        <br>
                                        <label>
                                        <input type="checkbox" class="form-check-input"value="">曾經瀏覽過 <select>
                                            <option value ="">穿戴式裝置</option>
                                            <option value ="">耳機/喇叭</option>
                                            <option value ="">運動攝影機</option>
                                        </select> 類別的商品
                                        </label>
                                        <br>
                                        <label>
                                        <input type="checkbox" class="form-check-input"value="">
                                        <select>
                                            <option value ="">穿戴式裝置</option>
                                            <option value ="">耳機/喇叭</option>
                                            <option value ="">運動攝影機</option>
                                        </select> 類別的商品，放在購物車 尚未結帳
                                        </label>
                                        <br>
                                        <label><input type="checkbox" class="form-check-input"value="">
                                        收藏裡有我的商品</label>
                                        <br>
                                        <label><input type="checkbox" class="form-check-input"value="">
                                        收藏裡有 <select>
                                            <option value ="">穿戴式裝置</option>
                                            <option value ="">耳機/喇叭</option>
                                            <option value ="">運動攝影機</option>
                                        </select> 類別的商品</label>
                                        <br>
                                        <label><input type="checkbox" class="form-check-input"value="">
                                        搜尋過以下關鍵字</label>
                                        <br>
                                        <label><input type="checkbox" class="form-check-input"value="">
                                        A</label>
                                        <br>
                                        <label><input type="checkbox" class="form-check-input"value="">
                                        B</label>
                                        <br>
                                        <label><input type="checkbox" class="form-check-input"value="">
                                        C</label>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="submit" class="btn btn-w-m btn-success" value="下一步"/>
                                </form>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->

    </div>
    </div>



<!-- 引入 jQuery 的函式庫 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

      <!-- JQ UI -->
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


    <!-- Mainly scripts -->
    <!-- <script src="js/jquery-3.1.1.min.js"></script> -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>


    <script>
        <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == '點擊量') {echo "$('.cost').toggleClass('active')";}?>

        //預算的開關
         $('.clickType').change(function(){
             $('.cost').toggleClass('active')

        })
        $('.dayType').change(function(){
            $('.cost').toggleClass('active')
            .find('input').val(0)
        })

        //再行銷目標群殂開關
        $('.allPeople').change(function(){
             $('.checkbox').toggleClass('active')

        })
        $('.somePeople').change(function(){
            $('.checkbox').toggleClass('active')
            .find(':checkbox').prop('checked',false)
        })


    </script>


</body>

</html>