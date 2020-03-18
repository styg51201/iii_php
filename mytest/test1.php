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

    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="css/adList.css" rel="stylesheet">

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
                    <h2>廣告總覽</h2>
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
                <!-- <div class="stateAlert"> -->
                    <div class="stateBox">
                        <h3>狀態變更為: </h3>
                        <div class="sty-inputGroup">
                            <label><input type="radio" name="status" value="審核" style="margin-right:8px">審核</label>
                            <label><input type="radio" name="status" value="上架" style="margin-right:8px">上架</label>
                            <label><input type="radio" name="status" value="下架" style="margin-right:8px" >下架</label>
                        </div>
                        <input type="hidden" class="editId" name="editId" value="">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-w-m toggle" style="background:#D0D0D0">取消</button>
                            <button class="btn btn-w-m  btn-success submit">確認</button>
                        </div>
                    </div>
                <!-- </div> -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                                <!-- 主要內容 -->
                            <div class="ibox-title">
                                <h5>所有廣告活動</h5>
                            </div>

                            <div class="ibox-content">

                            </div>

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

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
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

    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        let addTable = `<table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>設定狀態</th>
                                                    <th>廣告名稱</th>
                                                    <th>投放位置</th>
                                                    <th>投放對象</th>
                                                    <th>預算</th>
                                                    <th>點擊數</th>
                                                    <th>狀態</th>
                                                    <th>開始時間</th>
                                                    <th>結束時間</th>
                                                    <th>修改</th>
                                                    <th>刪除</th>
                                                    <th>詳細資訊</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            </table>`;

        
         let app = function(){

            $.ajax({
                type: 'POST',
                url: './test.php',
                data: {
                        check:'all'
                }
            })
            .done(function(data){

                if(data){
                    let planGroup="";
                    
                    data = JSON.parse(data);
                    console.log(data);
                    $('.ibox-content').html("")
                    $('.ibox-content').append(addTable)
                    $('tbody').html("")
                    data.forEach(function(item){
                        let red="";

                        if(item['planGroup']){
                            planGroup='再行銷族群';
                        }else{
                            planGroup='所有人';

                        }
                        if(item['planStatus'] === '上架'){
                            red='red'
                        }

                        $('tbody').append(` <tr class="planRow" data-planId="${item['planId']}">
                                                <td><button class="btn btn-sm btn-info setState">設定</button></td>
                                                <td>${item['planName']}</td>
                                                <td>${item['planPlace']}</td>
                                                <td style="width:160px">${planGroup}</td>
                                                <td>${item['planCost']}</td>
                                                <td>${item['planClick']}</td>
                                                <td class="planStatus ${red}">${item['planStatus']}</td>
                                                <td>${item['planStartTime']}</td>
                                                <td>${item['planDueTime']}</td>
                                                <td><a class="btn btn-sm btn-primary" href="editPlan.php?editId="${item['planId']}">修改</a></td>
                                                <td><button class="btn btn-sm btn-danger deletePlan">刪除</button></td>
                                                <td><button class="fa fa-angle-double-down btn btn-circle adInfo" data-adTarget="${item['adId']}"></button></td>

                                                <tr class="coll adRow active" data-adId="${item['adId']}">
                                                <th style="vertical-align:middle">圖片名稱 : </th>
                                                <td style="vertical-align:middle">${item['adName']}</td>
                                                <th style="vertical-align:middle">圖片標題 : </th>
                                                <td style="vertical-align:middle">${item['adTitle']}</td>
                                                <th style="vertical-align:middle">圖片內文 : </th>
                                                <td colspan="2" style="vertical-align:middle;max-width:200px">${item['adContent']}</td>
                                                <th style="vertical-align:middle">圖片連結至 : </th>
                                                <td style="vertical-align:middle">${item['adLinkPlace']}</td>
                                                <td colspan="2" style="width:350px;vertical-align:middle"><img id=imgShow src="./images/${item['adImg']}"></td>
                                                <td style="vertical-align:middle">
                                                    <a class="btn btn-sm btn-outline btn-rounded btn-info my-2" href="./show.php?showId=${item['adId']}">圖片瀏覽</a>
                                                    <br>
                                                    <a class="btn btn-sm btn-outline btn-rounded btn-primary my-2" href="editAd.php?editId=${item['adId']}">圖片修改</a>
                                                </td>
                                            </tr>
                                                `)

                        // $('.groupInfo').html("")
                            if(item['planGroup']){
                                $("tr[data-planId="+item['planId']+"]").find('td').eq(3).append(
                                    `<span class="position-relative" style="display:inline-block">
                                    <div class="fa fa-info infoBtn btn btn-circle" data-groupTarget="${item['planId']}"></div>
                                    <div class="groupInfo p-2 shadow-lg active" data-groupInfo="${item['planId']}"></div>
                                    </span>`);

                                if(item['groupBuyItems']) $(".groupInfo[data-groupInfo="+item['planId']+"]").append('<li>買過我的產品</li>')
                                if(item['groupHistoryItems']) $(".groupInfo[data-groupInfo="+item['planId']+"]").append('<li>瀏覽過我的產品</li>')
                                if(item['groupCollectItems']) $(".groupInfo[data-groupInfo="+item['planId']+"]").append('<li>收藏裡有我的產品</li>')
                                if(item['groupHistoryCategory']) $(".groupInfo[data-groupInfo="+item['planId']+"]").append('<li>瀏覽過運動攝影機類別</li>')
                                if(item['groupCollectCategory']) $(".groupInfo[data-groupInfo="+item['planId']+"]").append('<li>收藏裡有運動攝影機類別</li>')
                                if(item['groupCartCategory']) $(".groupInfo[data-groupInfo="+item['planId']+"]").append('<li>購物車裡有運動攝影機類別</li>')
                            }
                    })

                }else{
                    $('.ibox-content').html("")
                    $('.ibox-content').append('<h2>查無資料</h2>')
                }
            })
        }
        app();

        $(document).on('click','.adInfo',function(){
            let adId = $(this).attr('data-adTarget');
            $(".adRow[data-adId="+adId+"]").toggleClass('active')
        })

        $(document).on('click','.infoBtn',function(){
            let planGroupId = $(this).attr('data-groupTarget');
            $(".groupInfo[data-groupInfo="+planGroupId+"]").toggleClass('active')
            console.log(planGroupId)
        })
        

            let statusId;
            let status;
            let statusHtml
            //狀態設定
            $(document).on('click', '.setState', function(){

                statusId = $(this).parents('tr').attr('data-planId');
                status = $(this).parents('tr').children('td').eq(6);
                statusHtml = $(this).parents('tr').children('td').eq(6).html();
                
                if(statusHtml == '審核'){
                    $("input[name=status]").attr("checked",false);
                    $("input[name=status][value='審核']").attr("checked",true);
                }else if(statusHtml == '上架'){
                    $("input[name=status]").attr("checked",false);
                    $("input[name=status][value='上架']").attr("checked",true);
                }else if(statusHtml == '下架'){
                    $("input[name=status]").attr("checked",false);
                    $("input[name=status][value='下架']").attr("checked",true);
                }
                $('.editId').attr('value',statusId);

            });

            
            //狀態設定的Alert 開關
            $(document).on('click', '.setState', function(){
                $('.stateBox').slideToggle();
            })
            $(document).on('click', '.toggle', function(){
                $('.stateBox').slideToggle();
            })
            

            //狀態修改的Ajax
            $(document).on('click', '.submit', function() {
                let updateStatus = $('input[name=status]:checked').val();
                $.ajax({
                    type: 'POST',
                    url: './updatePlanStatus.php',
                    data: {
                            editId:$('input[name=editId]').val(),
                            status:$('input[name=status]:checked').val()
                    }
                })
            .done(function(data) {
                if(data){
                    $('.stateBox').slideToggle();
                    if(updateStatus == '上架'){
                        status.attr('class','planStatus red');
                    }else{
                        status.attr('class','planStatus');

                    }
                    status.html(updateStatus);

                }else{
                    $('.stateBox').slideToggle();
                };
            })
        })


    </script>


</body>

</html>