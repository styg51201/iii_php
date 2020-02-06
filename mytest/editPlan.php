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
        .span{
            padding:0 60px
        }
        #swal{
            display:block;
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

                                <table class="table">
                                    <tbody>
                                    <?php

$sql = 'SELECT *
                                        FROM `plan`
                                        WHERE `plan`.`id` = ? AND `username` = ?';

$arrParam = [$_GET['editId'],
    $_SESSION['username'],
];

// echo '<pre>';
// print_r($arrParam);
// echo '</pre>';

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    ?>
                                    <tr>
                                        <td>流水號
                                        <span class="span">
                                        <?php echo $arr['id']; ?>
                                        <input type="hidden" name="id" value="<?php echo $arr['id']; ?>"/>
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>名稱
                                            <span class="span">
                                        <input type="text" name="name" value="<?php echo $arr['name']; ?>" maxlength="20" />
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>目標
                                        <span class="span">
                                        <input type="text" name="target" value="<?php echo $arr['target']; ?>" maxlength="20" />
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>方案
                                            <span class="span">
                                        <input type="text" name="type" value="<?php echo $arr['type']; ?>" maxlength="20" />
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>位置
                                            <span class="span">
                                        <input type="text" name="place" value="<?php echo $arr['place']; ?>" maxlength="20" />
                                        </span>
                                        </td>
                                    </tr>
                                    <?php if ($arr['cost']) {?>
                                    <tr>
                                        <td>預算
                                            <span class="span">
                                        <input type="number" name="cost" value="<?php echo $arr['cost']; ?>" maxlength="20" />
                                        </span>
                                        </td>
                                    </tr>
                                    <?php } else {?>
                                    <input type="hidden" name="cost" value="<?php echo $arr['cost']; ?>" maxlength="20" />
                                    <?php }
    ;?>
                                    <tr>
                                        <td>狀態
                                            <span class="span">
                                        <?php echo $arr['status']; ?>
                                        <input type="hidden" name="status" value="<?php echo $arr['status']; ?>"/>
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>開始時間
                                            <span class="span">
                                        <input type="date" name="startTime" value="<?php echo $arr['startTime']; ?>" maxlength="20" />
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>結束時間
                                            <span class="span">
                                        <input type="date" name="dueTime" value="<?php echo $arr['dueTime']; ?>" maxlength="20" />
                                        </span>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <input type="hidden" name="editId" value="<?php echo (int) $_GET['editId']; ?>">
                            </table>
                            <br>
                            <button class="btn btn-w-m btn-success submit">修改</button>
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

      <!-- 引入 jQuery 的函式庫 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>

            $(document).on('click', '.submit', function() {
                $.ajax({
                    type: 'POST',
                    url: './updateEditPlan.php',
                    data: {
                            name:$('input[name=name]').val(),
                            target:$('input[name=target]').val(),
                            type:$('input[name=type]').val(),
                            place:$('input[name=place]').val(),
                            cost:$('input[name=cost]').val(),
                            startTime:$('input[name=startTime]').val(),
                            dueTime:$('input[name=dueTime]').val(),
                            id:$('input[name=id]').val()
                    }
                })
                .done(function(data) {
                    if(data){
                        $(document).on('click', '.confirm', function() {
                            setTimeout("location='./setting.php'",100);
                        })
                        swal("修改成功", "", "success",);


                    }else{
                        $(document).on('click', '.confirm', function() {
                            setTimeout("location='./setting.php'",100);
                        })
                        swal("修改失敗", "", "error",);

                    };
                })

            });

            // $(document).on('click', '.confirm', function() {
            //     // swal.close();
            //     setTimeout("location='./setting.php'",100);
            //     // $(location).attr('href','./setting.php');

            // })


        </script>


</body>

</html>