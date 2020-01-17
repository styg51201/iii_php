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
        .ibox-content{
            min-height:500px;
        }
        .show{
        width:300px;
        height:200px;
        }
        #imgShow{
            width:100%;
            /* height:100%; */
            object-fit:cover;
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
                        <div class="ibox">
                            <div class="ibox-content">
                                <form name="myForm" method="POST" action="./insert.php" enctype="multipart/form-data">
                                    <h3>設定圖片名稱</h3>
                                    <div style="margin-left: 23px;">
                                        <label>圖片名稱: <input type="text" name="Name" value="" maxlength="20" /></label>
                                    </div>

                                    <h3>請上傳圖片</h3>
                                    
                                    <div style="margin-left: 23px;">
                                    <!-- accept="image/*" => 只能上傳圖片檔 -->
                                        <input type="file" name="Img" id="filed" accept="image/*"/>
                                    </div>
                                    <br>

                                    <div class="show">
                                        <img id="imgShow">
                                    <div>
                                    <br>
                                    <div>
                                        <a href="./addPlan.php" class="btn btn-w-m btn-primary">上一步</a>
                                        <input type="submit" class="btn btn-w-m btn-success" value="確認"/>
                                    </div>
                                </form>
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

    <script>
        $('#filed').change(function(){
        //獲取input file的files檔案陣列;
        //$('#filed')獲取的是jQuery物件，.get(0)轉為原生物件;
        //這邊預設只能選一個，但是存放形式仍然是陣列，所以取第一個元素使用[0];
            var file = $('#filed').get(0).files[0];
            //建立用來讀取此檔案的物件
            var reader = new FileReader();
            //使用該物件讀取file檔案
            reader.readAsDataURL(file);
            //讀取檔案成功後執行的方法函式
            reader.onload=function(e){
            //讀取成功後返回的一個引數e，整個的一個進度事件
            //選擇所要顯示圖片的img，要賦值給img的src就是e中target下result裡面
            //的base64編碼格式的地址
            $('#imgShow').get(0).src = e.target.result;
            console.log(e.target.result);
            }
        })

    </script>

</body>

</html>