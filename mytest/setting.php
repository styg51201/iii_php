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
    <style>
        #imgShow{
            width:200px;
            height:100px;
            object-fit:cover;
        }
        .alertBox{
            background:#DDDDDD;
            width:500px;
            height:300px;
            left:50%;
            top:50%;
            transform: translate(-65%,-65%);
            display: none;
           
            
        }
    </style>
        <!-- 引入 jQuery 的函式庫 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



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
                        <div class="ibox alertBox position-absolute">
                            <div class="ibox-title">
                            <h5>設定狀態</h5>
                            </div>
                            <div class="ibox-content alertContent">
                                <h3>狀態變更</h3>
                                <div>
                                <label><input type="radio" name="status" value="審核">審核</label>
                                <label><input type="radio" name="status" value="上架">上架</label>
                                <label><input type="radio" name="status" value="下架">下架</label>
                                </div>
                                <br><br>
                                <input type="hidden" class="editId" name="editId" value="">
                                <button class="btn btn-w-m btn-success submit">確認</button>
                            </form>
                                <button class="btn btn-w-m btn-primary toggle">取消</button>
                                                                
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
                                        $stmt=$pdo->prepare($sql);
                                        $stmt->execute($arrParam);
                                        if($stmt->rowCount() > 0){ 
                                    ?>  
                                         
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>流水號</th>
                                                    <th>廣告名稱</th>
                                                    <th>目標</th>
                                                    <th>方案</th>
                                                    <th>位置</th>
                                                    <th>狀態</th>
                                                    <th>設定狀態</th>
                                                    <th>開始時間</th>
                                                    <th>結束時間</th>
                                                    <th>修改</th>
                                                    <th>刪除</th>
                                                    <th>圖片名稱</th>
                                                    <th>圖片</th>
                                                    <th>圖片瀏覽</th>
                                                    <th>圖片修改</th>
                                                    <th>圖片刪除</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    
                                                for($i=0; $i < count($arr); $i++){ 
                                                // echo '<pre>';
                                                // print_r($arr);
                                                // print_r(count($arr));
                                                // echo '</pre>';
                                                    
                                            ?>
                                            
                                                <tr>
                                                    <td ><?php echo $arr[$i]['id'] ?></td>
                                                    <td><?php echo $arr[$i]['name'] ?></td>
                                                    <td><?php echo $arr[$i]['target'] ?></td>
                                                    <td><?php echo $arr[$i]['type'] ?></td>
                                                    <td><?php echo $arr[$i]['place'] ?></td>
                                                    <td><?php echo $arr[$i]['status'] ?></td>
                                                    <td>
                                                        <button class="btn toggle editStatus">設定
                                                            <span class="statusId" style="display:none"><?php echo $arr[$i]['id'] ?></span>
                                                        </button>
                                                    </td>
                                                    <td><?php echo $arr[$i]['startTime'] ?></td>
                                                    <td><?php echo $arr[$i]['dueTime'] ?></td>
                                                    <td><a href="editPlan.php?editId=<?php echo $arr[$i]['id'] ?>">修改</a></td>
                                                    <td><button class="btn delete"><span style="display:none"><?php echo $arr[$i]['id'] ?></span>刪除</button></td> 
                                                    <?php 
                                                        $sqlAd = 'SELECT *
                                                        FROM `ad`
                                                        WHERE `PlanId` = ?';
                                                         $arrAd = [$arr[$i]['id']];
                                                        $stmtAd=$pdo->prepare($sqlAd);
                                                        $stmtAd->execute($arrAd);
                                                        if($stmtAd->rowCount() > 0){
                                                            $brr = $stmtAd->fetchAll(PDO::FETCH_ASSOC);
                                                            for($k=0; $k < count($brr); $k++){ 
                                                    ?>
                                                    <td><?php echo $brr[$k]['Name'] ?></td>
                                                    <td><img id=imgShow src="./images/<?php echo $brr[$k]['Img'] ?>"></td>
                                                    <td>
                                                    <a href="./show.php?showId=<?php echo $brr[$i]['Id'] ?>">圖片瀏覽</a>
                                                    </td>
                                                    <td><a href="editAd.php?editId=<?php echo $brr[$k]['Id'] ?>">圖片修改</a></td>
                                                    <td><button class="btn deleteAd"><span style="display:none"><?php echo $brr[$k]['Id'] ?></span>圖片刪除</button></td>   
                                                    <?php
                                                            }      
                                                        }else{ ?>
                                                        <td>查無資料</td>
                                                    <?php } ?>
                                                </tr> 
                                        <?php   } ?>
                                            </tbody>
                                        </table>
                                    <?php }else{echo '<br>尚無資料';}?>
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

    <script>
        $(document).ready(function(){

            let statusId;
            let status;
            
            
            //使用 Ajax 傳遞 (常用)
            $(document).on('click', 'button.editStatus', function(){
    
                statusId = $(this).children('span').html();
                status = $(this).parent().prev().html();

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

            $(document).on('click', 'button.toggle', function(){

                $('.alertBox').slideToggle();
                });

            $(document).on('click', '.submit', function() {
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
                        location.reload(true);

                    }else{
                        $('.alertBox').slideToggle();
                    };
                })
            })

            $(document).on('click', '.deleteAd', function() {
                $.ajax({
                    type: 'POST',
                    url: './deleteAd.php',
                    data: {
                            deleteId:$(this).children('span').html()
                    }
                })
                .done(function(data) {
                    // alert(data)
                    if(data){
                        alert('刪除成功');
                        location.reload(true);

                    }else{
                        alert('刪除失敗');
                    };
                })
            })

            $(document).on('click', '.delete', function() {
                console.log($(this).children('span').html());
                $.ajax({
                    type: 'POST',
                    url: './deletePlan.php',
                    data: {
                            deleteId:$(this).children('span').html()
                    }
                })
                .done(function(data) {
                    // alert(data)
                    if(data){
                        alert('刪除成功');
                        location.reload(true);

                    }else{
                        alert('刪除失敗');
                    };
                })
            })
        });
        </script>


</body>

</html>