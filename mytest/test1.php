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

    <style>
        #imgShow{
            width:100%;
            height:130px;
            object-fit:cover;
        }
        .alertBox{
            margin:0px
            border:2px solid #778899;
            border-radius:30px;
            background:#DDDDDD;
            width:300px;
            left:50%;
            top:50%;
            transform: translate(-70%,-70%);
            display: none;
            z-index:1;
        }
        .collapse>td{
            vertical-align:middle
        }
        .red{
            color:red;
        }
        .adRow.active{
            display:none;
        }
        .groupInfo{
            position: absolute;
            left:45px;
            top:0px;
            background:#ffffff;
            border:1px solid #777777;
            border-radius:10px;
            width:200px;
        }
        .groupInfo.active{
            display:none
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
                        if(item['planGroup']){
                            planGroup='再行銷族群';
                        }else{
                            planGroup='所有人';

                        }
                        $('tbody').append(` <tr class="planRow" data-planId="${item['planId']}">
                                                <td>${item['planName']}</td>
                                                <td>${item['planPlace']}</td>
                                                <td style="width:160px">${planGroup}</td>
                                                <td>${item['planCost']}</td>
                                                <td>${item['planClick']}</td>
                                                <td>${item['planStatus']}</td>
                                                <td>${item['planStartTime']}</td>
                                                <td>${item['planDueTime']}</td>
                                                <td><a class="btn btn-sm btn-primary" href="editPlan.php?editId="${item['planId']}">修改</a></td>
                                                <td><button class="btn btn-sm btn-danger deletePlan">刪除</button></td>
                                                <td><button class="fa fa-angle-double-down btn btn-circle adInfo" data-adTarget="${item['adId']}"></button></td>

                                                <tr class="coll adRow active" data-adId="${item['adId']}">
                                                <th style="vertical-align:middle">圖片名稱:</th>
                                                <td style="vertical-align:middle">${item['adName']}</td>
                                                <th style="vertical-align:middle">圖片標題:</th>
                                                <td style="vertical-align:middle">${item['adTitle']}</td>
                                                <th style="vertical-align:middle">圖片內文:</th>
                                                <td colspan="1" style="vertical-align:middle;max-width:200px">${item['adContent']}</td>
                                                <th style="vertical-align:middle">圖片連結至:</th>
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
                                $("tr[data-planId="+item['planId']+"]").find('td').eq(2).append(
                                    `<span class="position-relative">
                                    <button class="fa fa-angle-double-down btn btn-groupInfo" data-groupTarget="${item['planId']}"></button>
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

        $(document).on('click','.btn-groupInfo',function(){
            let planGroupId = $(this).attr('data-groupTarget');
            $(".groupInfo[data-groupInfo="+planGroupId+"]").toggleClass('active')
            console.log(planGroupId)
        })
        
        $('.ibox-content').on('click','.btn',function(){

            if( $(this).hasClass('deletePlan') ){

                let deletePlanTr = $(this).parents("tr");
                let deletePlanId = deletePlanTr.attr('data-planId');
                // console.log(deletePlanTr,deletePlanId)

            swal({
                    title: "確定刪除廣告活動?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "刪除",
                    cancelButtonText: "取消",
                    closeOnConfirm: false
                },
                    function () {
                        $.ajax({
                            type: 'POST',
                            url: './deletePlan1.php',
                            data: {
                                    deleteId:deletePlanId
                            }
                        })
                        .done(function(data) {
                            if(data){
                                // $(document).on('click', '.confirm', function() {
                                //     setTimeout("location.reload(true)",100);
                                // })
                                // deletePlanTr.remove();
                                // // deleteAdTr.remove();
                                // if($('.planRow').length ==0){
                                //     $('.ibox-content').html('<h2>查無資料<h2>')
                                // }
                                swal("刪除成功", "", "success",);
                                app();



                            }else{
                                $(document).on('click', '.confirm', function() {
                                    setTimeout("location.reload(true)",100);
                                })
                                swal("刪除失敗","","error");
                            };
                        })

                    }
                )
            }

        })


    </script>


</body>

</html>