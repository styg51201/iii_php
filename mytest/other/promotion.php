<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

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
     <!-- Sweet Alert -->
     <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
     <script src="js/jquery-3.1.1.min.js"></script>

    <style>
        .itemImg{
            width:200px;
            height:200px;
        }
        label{
            text-align: center;
            margin:10px;
        }
        .itemImg img{
            width:100%;
            height:100%;
            object-fit:cover;
        }
        .infoItem{
            margin:10px;
        }
    </style>

</head>

<body>

    <div id="wrapper">
        <!-- 左側選單 -->
        <?php require_once('./left-nav.php'); ?>
        <!-- Body -->
        <div id="page-wrapper" class="gray-bg">
            <!-- 上側選單 -->
        <?php require_once('./top-nav.php'); ?>
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
                                <h3>選擇條件</h3>
                                <div style="margin-left: 23px;">
                                    <label>
                                        <input type="radio" class="form-check-input" name="rule" value="不限"
                                            checked>不限
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" class="form-check-input" name="rule" value="滿額"
                                            >滿額
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" class="form-check-input" name="rule" value="滿件"
                                            >滿件
                                    </label>
                                </div>
                                <h3>輸入條件數量</h3>
                                <div style="margin-left: 23px;">
                                    <label>設定數量為: <input type="number" name="ruleNumber" value=""> 元/件</label>
                                </div>
                                <h3>選擇折扣</h3>
                                <div style="margin-left: 23px;">
                                    <label>
                                        <input type="radio" class="form-check-input" name="discount" value="固定金額"
                                            checked>固定金額
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" class="form-check-input" name="discount" value="百分比折扣"
                                            >百分比折扣
                                    </label>
                                </div>
                                <h3>輸入折扣金額</h3>
                                <div style="margin-left: 23px;">
                                    <label>設定金額為: <input type="number" name="discountNumber" value=""> 元/%</label>
                                </div>

                                <h3>選擇目標</h3>
                                <div style="margin-left: 23px;">
                                    <label class="all">
                                        <input type="radio" class="form-check-input" name="object" value="全部"
                                            checked>全部商品
                                    </label>
                                    <br>
                                    <label class="sort">
                                        <input type="radio" class="form-check-input" name="object" value="分類"
                                            >分類商品
                                    </label>
                                    <br>
                                    <label class="item">
                                        <input type="radio" class="form-check-input" name="object" value="指定"
                                            >指定商品
                                    </label>
                                </div>
                                <div class="sortDiv">
                                    
                                </div>
                                <button class="btn btn-w-m btn-success submit">確認</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->

    </div>
    </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        $('.all').click(function(){
            $('.sortDiv').html("");
        })

        $('.sort').click(function(){
            $.ajax({
                type: 'POST',
                url: './sort.php',
                data:{check:'sort'}
            })
            .done(function(data){
                //parse 變成JSON物件 要顯示文字再stringify
                // JSON.stringify( JSON.parse(data));
                data = JSON.parse(data);
                $('.sortDiv').html("")
                $('.sortDiv').html(`<h3>請選擇商品</h3>
                                    <div class="info" style="margin-left: 23px;">
                                    </div>`)
                for(i=0;i<data.length;i++){
                    $('.info').append(`<label><input type="checkbox">${data[i]['categoryName']}</label>`)
                }
              
            })
        })

        $('.item').click(function(){
            $.ajax({
                type: 'POST',
                url: './sort.php',
                data:{check:'item'}
            })
            .done(function(data){
                // alert(data);
                data = JSON.parse(data);
                
                $('.sortDiv').html("")
                $('.sortDiv').html(`<h3>請選擇商品</h3>
                                    <div class="infoItem" style="margin-left: 23px;">
                                    </div>`)
                for(i=0;i<data.length;i++){
                    $('.infoItem').append(`<label>
                                        <input type="checkbox">
                                        <p>${data[i]['itemName']}</p>
                                        <div class="itemImg">
                                            <img src="./images/${data[i]['itemImg']}">
                                        </div>
                                    </label>`)
                }
              
            })
        })

        $(document).on('click', '.submit', function() {
            $.ajax({
                type: 'POST',
                url: './promoInsert.php',
                data: {
                    object:$('input[name=object]:checked').val(),

                    rule:$('input[name=rule]:checked').val(),
                    ruleNumber:$('input[name=ruleNumber]').val(),
                    discount:$('input[name=discount]:checked').val(),
                    discountNumber:$('input[name=discountNumber]').val(),
                    
                }
            })
            .done(function(data) {
                if(data){
                    $(document).on('click', '.confirm', function() { 
                        setTimeout("location='./promotion.php'",100);
                    })
                    swal("新增成功", "", "success",);
                    
        
                }else{
                    $(document).on('click', '.confirm', function() { 
                        setTimeout("location='./promotion.php'",100);
                    })
                    swal("新增失敗", "", "error",);
            
                };
            })
                
        });


    </script>

</body>

</html>