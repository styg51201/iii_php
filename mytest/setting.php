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
            width:300px;
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
                   <!-- 設定狀態 -->
                        <div class="ibox alertBox shadow-lg position-absolute">
                            <div class="ibox-content alertContent" style="border-radius:30px;">
                                <h4>狀態變更為: </h4>
                                <br>
                                <div class="d-flex justify-content-between">
                                <label><input type="radio" name="status" value="審核" style="margin-right:8px">審核</label>
                                <label><input type="radio" name="status" value="上架" style="margin-right:8px">上架</label>
                                <label><input type="radio" name="status" value="下架" style="margin-right:8px" >下架</label>
                                </div>
                                <br><input type="hidden" class="editId" name="editId" value="">
                                <div class="d-flex justify-content-between">
                                <button class="btn btn-w-m toggle" style="background:#D0D0D0">取消</button>
                                <button class="btn btn-w-m  btn-success submit">確認</button>
                                </div>
                            </div>
                        </div>
                        <div class="ibox ">
                                <!-- 主要內容 -->
                                    <div class="ibox-title">
                                        <h5>所有廣告活動</h5>
                                    </div>

                                    <div class="ibox-content">
                                    <?php
$sql = 'SELECT *
                                                FROM `plan`
                                                WHERE `username` = ?';
$arrParam = [$_SESSION['username']];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);
if ($stmt->rowCount() > 0) {
    ?>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>流水號</th>
                                                    <th>廣告名稱</th>
                                                    <th>目標</th>
                                                    <th>方案</th>
                                                    <th>位置</th>
                                                    <th>預算</th>
                                                    <th>點擊數</th>
                                                    <th>狀態</th>
                                                    <th>設定狀態</th>
                                                    <th>開始時間</th>
                                                    <th>結束時間</th>
                                                    <th>修改</th>
                                                    <th>刪除</th>
                                                    <th>詳細資訊</th>
                                                    <!-- <th>圖片名稱</th>
                                                    <th>圖片</th>
                                                    <th>圖片瀏覽</th>
                                                    <th>圖片修改</th>
                                                    <th>圖片刪除</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($arr); $i++) {
        // echo '<pre>';
        // print_r($arr);
        // print_r(count($arr));
        // echo '</pre>';

        ?>

                                                <tr class="planRow">
                                                    <td ><?php echo $arr[$i]['id'] ?></td>
                                                    <td><?php echo $arr[$i]['name'] ?></td>
                                                    <td><?php echo $arr[$i]['target'] ?></td>
                                                    <td><?php echo $arr[$i]['type'] ?></td>
                                                    <td><?php echo $arr[$i]['place'] ?></td>
                                                    <td>
                                                        <?php if ($arr[$i]['cost']) {
            echo $arr[$i]['cost'] . '元';
        } else {
            echo '-';
        }?>

                                                    </td>
                                                    <td><?php echo $arr[$i]['click'] ?></td>
                                                    <td class="planStatus"><?php echo $arr[$i]['status'] ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline btn-primary toggle editStatus">設定
                                                            <span class="statusId" style="display:none"><?php echo $arr[$i]['id'] ?></span>
                                                        </button>
                                                    </td>
                                                    <td><?php echo $arr[$i]['startTime'] ?></td>
                                                    <td><?php echo $arr[$i]['dueTime'] ?></td>
                                                    <td><a class="btn btn-sm btn-primary" href="editPlan.php?editId=<?php echo $arr[$i]['id'] ?>">修改</a></td>
                                                    <td><button class="btn btn-sm btn-danger deletePlan"><span style="display:none"><?php echo $arr[$i]['id'] ?></span>刪除</button></td>
                                                    <?php
$sqlAd = 'SELECT *
                                                        FROM `ad`
                                                        WHERE `PlanId` = ?';
        $arrAd = [$arr[$i]['id']];
        $stmtAd = $pdo->prepare($sqlAd);
        $stmtAd->execute($arrAd);
        if ($stmtAd->rowCount() > 0) {
            $brr = $stmtAd->fetchAll(PDO::FETCH_ASSOC);
            for ($k = 0; $k < count($brr); $k++) {
                ?>
                                                    <td><button class="fa fa-angle-double-down btn btn-circle"  data-toggle="collapse" data-target="#collapse<?php echo $brr[$k]['adId'] ?>" aria-expanded="false" aria-controls="collapse<?php echo $brr[$k]['adId'] ?>">
                                                            </button></td>
                                                    <tr  class="collapse adRow" id="collapse<?php echo $brr[$k]['adId'] ?>">
                                                    <th style="vertical-align:middle">圖片名稱:</th>
                                                    <td style="vertical-align:middle"><?php echo $brr[$k]['adName'] ?></td>
                                                    <th style="vertical-align:middle">圖片標題:</th>
                                                    <td colspan="1" style="vertical-align:middle"><?php echo $brr[$k]['title'] ?></td>
                                                    <th style="vertical-align:middle">圖片內文:</th>
                                                    <td colspan="2" style="vertical-align:middle"><?php echo $brr[$k]['content'] ?></td>
                                                    <td colspan="5"><img id=imgShow src="./images/<?php echo $brr[$k]['img'] ?>"></td>
                                                    <td style="vertical-align:middle">
                                                    <!-- vertical-align:middle -->
                                                    <a class="btn btn-sm btn-outline btn-rounded btn-info" href="./show.php?showId=<?php echo $brr[$k]['adId'] ?>">圖片瀏覽</a>
                                                    <br>
                                                    <a style="margin:20px 0px" class="btn btn-sm btn-outline btn-rounded btn-primary" href="editAd.php?editId=<?php echo $brr[$k]['adId'] ?>">圖片修改</a>
                                                    <br>
                                                    <button class="btn btn-sm btn-outline btn-rounded btn-danger deleteAd"><span style="display:none"><?php echo $brr[$k]['adId'] ?></span>圖片刪除</button>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    </tr>
                                                    <?php
}
        } else {?>
                                                        <td>查無資料</td>
                                                    <?php }?>
                                                </tr>
                                        <?php }?>
                                            </tbody>
                                        </table>
                                    <?php } else {?>
                                    <h2>查無資料<h2>
                                    <?php }?>
                                    </div>
                                </div>
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

            //狀態是上架 就顯示紅色
            let PlanStatus = document.querySelectorAll('.planStatus');
            for(i=0; i < PlanStatus.length; i++){
                if(PlanStatus[i].innerHTML == "上架"){
                    PlanStatus[i].className += ' red';
                }
            }

            let statusId;
            let status;
            let editAjax
            //狀態設定
            $(document).on('click', 'button.editStatus', function(){

                statusId = $(this).children('span').html();
                status = $(this).parent().prev().html();
                editStatusAjax = $(this).parent().prev();

                if(status == '審核'){
                    $("input[name=status]").attr("checked",false);
                    $("input[name=status][value='審核']").attr("checked",true);
                }else if(status == '上架'){
                    $("input[name=status]").attr("checked",false);
                    $("input[name=status][value='上架']").attr("checked",true);
                }else if(status == '下架'){
                    $("input[name=status]").attr("checked",false);
                    $("input[name=status][value='下架']").attr("checked",true);
                }
                $('.editId').attr('value',statusId);

            });

            //狀態設定的Alert 開關
            $(document).on('click', 'button.toggle', function(){

                $('.alertBox').slideToggle();
                });

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
                        $('.alertBox').slideToggle();
                        if(updateStatus == '上架'){
                            editStatusAjax.attr('class','planStatus red');
                        }else{
                            editStatusAjax.attr('class','planStatus');

                        }
                        editStatusAjax.html(updateStatus);

                    }else{
                        $('.alertBox').slideToggle();
                    };
                })
            })
            //刪除圖片
            $(document).on('click', '.deleteAd', function() {
                let deleteAdId = $(this).children('span').html();

                swal({
                    title: "確定刪除圖片?",
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
                            url: './deleteAd.php',
                            data: {
                                    deleteId:deleteAdId
                            }
                        })
                        .done(function(data) {
                            if(data){
                                $(document).on('click', '.confirm', function() {
                                    setTimeout("location.reload(true)",100);
                                })
                                swal("刪除成功","","success");


                            }else{
                               $(document).on('click', '.confirm', function() {
                                    setTimeout("location.reload(true)",100);
                                })
                                swal("刪除失敗","","error");
                            };
                        })

                    }
                );

            })
            //刪除廣告活動
            $(document).on('click', '.deletePlan', function() {

                let deletePlanId = $(this).children('span').html();
                let deletePlanTr = $(this).parent().parent();
                // let deleteAdTr = $(this).parent().parent().find('.adRow');

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
                            url: './deletePlan.php',
                            data: {
                                    deleteId:deletePlanId
                            }
                        })
                        .done(function(data) {
                            if(data){
                                // $(document).on('click', '.confirm', function() {
                                //     setTimeout("location.reload(true)",100);
                                // })
                                deletePlanTr.remove();
                                // deleteAdTr.remove();
                                if($('.planRow').length ==0){
                                    $('.ibox-content').html('<h2>查無資料<h2>')
                                }
                                swal("刪除成功", "", "success",);



                            }else{
                                $(document).on('click', '.confirm', function() {
                                    setTimeout("location.reload(true)",100);
                                })
                                swal("刪除失敗","","error");
                            };
                        })

                    }
                )
            })
        </script>


</body>

</html>