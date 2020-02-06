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
        .show{
            position:relative;
            width:860px;
            height:333px;
        }
        #imgShow{
            width:100%;
            height:100%;
            object-fit:cover;
        }
        .mainText {
            position:absolute;
            color:#ffffff;
            margin: auto;
            padding:20px 0px;
            right: 15%;
            bottom: 26px;
            left: 15%;
        }
        .title{
            margin:0px 0 16px 0;
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
                            <div class="ibox-title">
                                <h5>詳細資料</h5>
                            </div>
                            <div class="ibox-content d-flex justify-content-around">

                                        <?php

$sql = 'SELECT *
                                        FROM `ad`
                                        WHERE `adId` = ?';

$arrParam = [$_GET['editId'],
];

// echo '<pre>';
// print_r($arrParam);
// echo '</pre>';

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    ?>
                                <div class="">

                                    <input type="hidden" name="adId" value="<?php echo $arr['adId']; ?>">

                                    <label>圖片名稱
                                        <input type="text" name="adName" value="<?php echo $arr['adName']; ?>" maxlength="20" />
                                    </label>
                                    <br><br>
                                    <label>上傳檔案
                                        <input type="file" name="img" id="filed"/>
                                    </label>
                                    <br><br>
                                    <label>圖片標題
                                        <input type="text" name="title" value="<?php echo $arr['title']; ?>" maxlength="20" />
                                    </label>
                                    <br><br>
                                    <label>圖片內文
                                        <input type="text" name="content" value="<?php echo $arr['content']; ?>" maxlength="40" />
                                    </label>

                                    <?php }?>

                                    <input type="hidden" name="editId" value="<?php echo (int) $_GET['editId']; ?>">

                                    <br>
                                    <br>
                                    <button class="submit btn btn-w-m btn-success">修改</button>
                                </div>
                                <div class="show">
                                    <img id="imgShow" src="./images/<?php echo $arr['img'] ?>">
                                    <div class="mainText text-center">
                                        <h3 class="title"></h3>
                                        <p class="content"></p>
                                    </div>
                                </div>
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

     <!-- Sweet alert -->
     <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<script>

        let mainText = document.querySelector('.mainText');
        let titleText = document.querySelector('.title');
        let contentText = document.querySelector('.content');
        let title =  $('input[name=title]').val();
        let content = $('input[name=content]').val();

        if( title || content){
            titleText.innerHTML=title;
            contentText.innerHTML=content;
            mainText.style.display='block';
        }

        $(document).on('keyup',titleText,function(){
            title =  $('input[name=title]').val();
            titleText.innerHTML=title;
            mainText.style.display='block';
            if(!title && !content ){mainText.style.display='none'};
        })

        $(document).on('keyup',contentText,function(){
            content = $('input[name=content]').val();
            contentText.innerHTML=content;
            mainText.style.display='block';
            if(!title && !content ){mainText.style.display='none'};
        })



        //ajax 傳送上傳的檔案方法
        $(document).on('click', '.submit', function() {
            let fileData = $('#filed').prop('files')[0];//取得上傳檔案的屬性
            let adName = $('input[name=adName]').val();
            let adId = $('input[name=adId]').val();
            title = $('input[name=title]').val();
            content = $('input[name=content]').val();

        // console.log(fileData);
            let formData = new FormData();//建構new FormData()
            formData.append('img',fileData);//把物件加到file後面
            formData.append('adName',adName);//加入其他資訊
            formData.append('adId',adId);
            formData.append('content',content);
            formData.append('title',title);


            $.ajax({
                type: 'POST',
                url: './updateEditAd.php',
                // cache: false,
                contentType: false, //這兩個都必須要加
                processData: false,
                //data只能指定單一物件 如果要傳送其他的資料需要用append()加到裡面
                data: formData,
                // {
                //         Name:$('input[name=Name]').val(),
                //         Id:$('input[name=Id]').val(),
                //         Img:$('input[name=Img]').val()
                // }

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
            .fail(function(){
                alert('傳送失敗');
            })

        })


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
        // console.log(e.target.result);
        }
    })

</script>


</body>

</html>