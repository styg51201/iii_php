<?php
require_once './db.inc.php';
session_start();
$sqlOn = "SELECT  *
FROM `plan` INNER JOIN `ad`
on `plan`.`id` = `ad`.`planId`
WHERE `plan`.`status` = '上架'
ORDER BY `plan`.`updates_at` DESC";

// $sqlDf = "SELECT  *
//           FROM `plan` INNER JOIN `ad`
//           on `plan`.`id` = `ad`.`planId`
//           WHERE `plan`.`status` = '預設'";
$today = date('Y-m-d');
$stmtOn = $pdo->query($sqlOn);
// echo '<pre>';
// print_r($sqlOn);
//  echo '</pre>';
$bannerUrl = [];
$bannerId = [];
$bannerTitle = [];
$bannerContent = [];

if ($stmtOn->rowCount() > 0) {
    $arrOn = $stmtOn->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($arrOn); $i++) {
        if ($arrOn[$i]['startTime'] <= $today && $arrOn[$i]['dueTime'] >= $today) {
            $bannerUrl[] = $arrOn[$i]['img'];
            $bannerId[] = $arrOn[$i]['id'];
            $bannerTitle[] = $arrOn[$i]['title'];
            $bannerContent[] = $arrOn[$i]['content'];
        }
        if ($arrOn[$i]['dueTime'] < $today) {
            $sqlEdit = "UPDATE `plan` SET `status` = '下架' WHERE `id` = ?";
            $arrEdit = [$arrOn[$i]['id']];
            $stmtEdit = $pdo->prepare($sqlEdit);
            $stmtEdit->execute($arrEdit);
        }
    }
    ;
}
;
?>

<!doctype html>
<html lang="zh">

<head>
    <title>Bootstrap-2</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">



    <style>
        a {
            text-decoration: none;
        }

        .carousel-item>a>img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }



        .list-unstyled a {
            color: white;
        }
        .logout{
            cursor: pointer;
        }

        .h4 {
            text-decoration: underline;
        }
        .card>img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;

        }

        @media screen and (max-width:768px) {
            .banner {
                height: 300px;
            }

            .bannerText {
                max-width: 80%;
            }
        }
    </style>
    <!-- 擺前面幻燈片才能運作 -->
    <!-- 引入 jQuery 的函式庫 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



</head>

<body>
    <!-- nav -->
    <div class="bg-dark">
        <div class="container">
            <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="d-flex justify-content-between">
                        <div class="p-2">
                            <h5 class="text-white h4">Collapsed content</h5>
                            <span class="text-muted">Add some information about the album below, the author, or any
                                other background context. Make it a few sentences long so folks can pick up some
                                informative tidbits. Then, link them off to some social networking sites or contact
                                information.</span>
                        </div>
                        <div class="p-2">
                            <h4 class="text-white h4">Contact</h4>
                            <ul class="list-unstyled">
                                <li><a href="">Follow on Twitter</a></li>
                                <li><a href="">Follow on Twitter</a></li>
                                <li><a href="">Follow on Twitter</a></li>
                            </ul>
                        </div>
                        <div class="p-2">
                            <h4 class="text-white h4">About</h4>
                            <ul class="list-unstyled">
                                <li><a href="">Team</a></li>
                                <li><a href="">Locations</a></li>
                                <li><a href="">Privacy</a></li>
                                <li><a href="">Terms</a></li>
                            </ul>
                        </div>
                        <div class="p-2">
                            <h4 class="text-white h4">Resources</h4>
                            <ul class="list-unstyled">
                                <li><a href="">Resource</a></li>
                                <li><a href="">Resource name</a></li>
                                <li><a href="">Another resource</a></li>
                                <li><a href="">Final resource</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-dark">
                    <a href="./index.php" class="navbar-brand text-white">Home</a>
                    <?php

if (isset($_SESSION['username'])) {
    echo '<a class="navbar-brand text-white" href="./setting.php">版面設定</a>
                                <a class="navbar-brand text-white logout">登出</a>';
} else {
    echo '<a class="navbar-brand text-white" href="./login.php">登入</a>';
}
?>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>
            </div>
        </div>
    </div>
    <!-- main -->
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($bannerId); $i++) {
    // $k = $i+2;
    echo '<li data-target="#carouselExampleCaptions" data-slide-to="' . $i . '"></li>';
}?>
            <li class="dfFirst" data-target="#carouselExampleCaptions"></li>
            <li class="dfSecond" data-target="#carouselExampleCaptions"></li>

        </ol>
        <div class="carousel-inner">
            <!-- 以下 -->
            <?php for ($i = 0; $i < count($bannerId); $i++) {
    echo '<div class="carousel-item">
                        <a href="./index.php" class="bannerA">
                        <span style="display:none">' . $bannerId[$i] . '</span>
                            <img src="./images/' . $bannerUrl[$i] . '" class="d-block w-100"
                                alt="...">
                            <div class="carousel-caption">
                                <h3>' . $bannerTitle[$i] . '</h3>
                                <p>' . $bannerContent[$i] . '</p>
                            </div>
                        </a>
                    </div>';
}?>
            <!-- 第一張 -->
            <div class="carousel-item">
                <a href="./index.php">
                    <img src="https://cdn.pixabay.com/photo/2017/01/14/12/59/iceland-1979445_1280.jpg" class="d-block w-100"
                        alt="...">
                    <div class="carousel-caption">
                        <h3>Example headline.</h3>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        <!-- <button type="button" class="btn btn-info">Button</button> -->
                    </div>
                </a>
            </div>
            <!-- 第二張 -->
            <div class="carousel-item">
                <a href="./index.php">
                    <img src="https://cdn.pixabay.com/photo/2019/10/14/20/09/nature-4549913_1280.jpg" class="d-block w-100"
                        alt="...">
                    <div class="carousel-caption">
                        <h3>Second slide label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </a>
            </div>
            <!-- 之後的圖片 -->

            <!-- 以上 -->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- card -->
    <div class="bg-light">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2016/07/21/20/56/anemone-1533515_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2016/08/03/14/24/roses-1566792_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2016/07/10/09/41/sage-1507499_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2017/05/08/13/15/spring-bird-2295436_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2014/02/27/18/35/daisies-276112_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2017/04/23/20/36/pink-2254970_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2013/05/11/20/44/spring-flowers-110671_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-3">
                    <div class="card">
                        <img src="https://cdn.pixabay.com/photo/2014/02/03/08/04/forget-me-not-257176_1280.jpg" alt="">
                        <div class="card-body">
                            <p>This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                                This
                                content is a little bit longer.</p>
                            <div class="d-flex justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-dark">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark">Edit</button>
                                </div>
                                <span class="text-muted">9 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- footer -->
    <div class="container py-3 footer d-flex justify-content-between">
        <div>
            <p class="">Album example is © Bootstrap, but please download and customize it for
                yourself!</p>
            <p>New to Bootstrap? Visit the homepage or read our getting started guide.</p>
        </div>
        <p><a href="">back to top</a></p>

    </div>

    <script src="js/bootstrap.js"></script>

     <!-- Sweet alert -->
     <script src="js/plugins/sweetalert/sweetalert.min.js"></script>


        <script>
            // $(document).ready(function(){

                //設定幻燈片的第一張
                let firstButton = $('.carousel-indicators').find("li").first();
                firstButton.addClass('active');

                let liButton = $('.carousel-indicators').children();

                if(liButton.length){
                    let a =liButton.length;
                    $('.dfFirst').attr("data-slide-to",a);
                    $('.dfSecond').attr("data-slide-to",a+1);

                }else{
                    $('.dfFirst').attr("data-slide-to",0);
                    $('.dfSecond').attr("data-slide-to",1);
                }

                let firstImg = $('.carousel-inner').find("div").first();
                firstImg.addClass('active');

                //計算點擊數
                $(document).on('click','.bannerA',function(){
                    bannerId = $(this).children('span').html();
                    $.ajax({
                        type: 'POST',
                        url: './clickCount.php',
                        data :{
                            id:bannerId
                        }
                    })

                })

            $(document).on('click','.logout',function(){
                $.ajax({
                    type: 'POST',
                    url: './logout.php',
                    data: {
                        logout:'1'
                        }
                })
                .done(function(data){
                    if(data){
                        $(document).on('click', '.confirm', function() {
                            setTimeout("location='./index.php'",100);
                        })
                        swal("登出成功","","success");


                    }else{
                        $(document).on('click', '.confirm', function() {
                            setTimeout("location='./index.php'",100);
                        })
                        swal("登出失敗","","error");
                    };
                })
            })

            // })


        </script>
</body>

</html>