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
        .ibox-content{
            min-height:500px;
        }
        .show{
            position:relative;
            width:860px;
            height:333px;
            /* display:none; */
        }
        #imgShow{
            width:100%;
            height:100%;
            height:333px;

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
                        <div class="ibox">
                            <div class="ibox-content d-flex justify-content-around">
                                <div>
                                    <h3>設定圖片名稱</h3>
                                    <div style="margin-left: 23px;">
                                        <label>圖片名稱: <input type="text" name="adName" value="" maxlength="20" /></label>
                                    </div>

                                    <h3>請上傳圖片</h3>
                                    <div style="margin-left: 23px;">
                                    <!-- accept="image/*" => 只能上傳圖片檔 -->
                                        <input type="file" name="img" id="filed" accept="image/*"/>
                                    </div>
                                    <br>
                                    <h3>設定標題</h3>
                                    <div style="margin-left: 23px;">
                                        <label>標題: <input type="text" name="title" value="" maxlength="20" /></label>
                                    </div>
                                    <h3>設定內文
                                    </h3>
                                    <div style="margin-left: 23px;">
                                        <label>內文: <input type="text" name="content" value="" maxlength="40" /></label>
                                    </div>
                                    <br>
                                    <h3>設定連結
                                    </h3>
                                    <div style="margin-left: 23px;">
                                        <label>連結到
                                        <select>
                                            <option>所有商品</option>
                                            <option>促銷名稱 123</option>
                                            <option>促銷名稱 abc</option>
                                        </select></label>
                                    </div>
                                    <br>
                                    <div>
                                        <a href="./addPlan.php" class="btn btn-w-m btn-primary">上一步</a>
                                        <button class="btn btn-w-m btn-success submit">確認</button>
                                    </div>
                                </div>
                                <div class="show">
                                    <img id="imgShow">
                                    <div class="mainText text-center">
                                        <h3 class="title" style="margin:0px 0 8px 0;"></h3>
                                        <p class="content"></p>
                                    </div>
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

            let show = document.querySelector('.show');
            let mainText = document.querySelector('.mainText');
            let titleText = document.querySelector('.title');
            let contentText = document.querySelector('.content');
            let title , content ;

            $(document).on('keyup','input[name=title]',function(){
                title = $('input[name=title]').val();
                titleText.innerHTML=title;
                mainText.style.display='block';
                if(!title && !content ){mainText.style.display='none'};
            })

            $(document).on('keyup','input[name=content]',function(){
                content = $('input[name=content]').val();
                contentText.innerHTML=content;
                mainText.style.display='block';
                if(!title && !content ){mainText.style.display='none'};
            })


            //傳送
            $(document).on('click', '.submit', function() {

                let fileData = $('#filed').prop('files')[0];//取得上傳檔案的屬性
                console.log(fileData);

                //沒上傳圖片的提示
                if(!fileData){
                    swal("請上傳圖片","","error");
                }else{

                    let adName = $('input[name=adName]').val();
                    let title = $('input[name=title]').val();
                    let content = $('input[name=content]').val();

                    let formData = new FormData();//建構new FormData()
                    formData.append('img',fileData);//把物件加到file後面
                    formData.append('adName',adName);//加入其他資訊
                    formData.append('title',title);
                    formData.append('content',content);

                    $.ajax({
                        type: 'POST',
                        url: './insert.php',
                        // cache: false,
                        contentType: false, //這兩個都必須要加
                        processData: false,
                        //data只能指定單一物件 如果要傳送其他的資料需要用append()加到裡面
                        data: formData,

                    })
                    .done(function(data) {
                        console.log(data);
                        if(data){
                            $(document).on('click', '.confirm', function() {
                                setTimeout("location='./setting.php'",100);
                            })
                            swal("新增成功","","success");

                        }else{
                            $(document).on('click', '.confirm', function() {
                                setTimeout("location='./addPlan.php'",100);
                            })
                            swal("新增失敗","","error");

                        };
                    })
                }
            })

            //預覽圖片
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
                show.style.display='block';
                }
            })

    </script>

</body>

</html>