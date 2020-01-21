<?php
require_once('./db.inc.php');
session_start();

            // echo $arr['startTime'];
            // echo '<br>';
            // echo date('Y-m-d');
            // echo '<br>';

            $sqlOn = "SELECT  *
                    FROM `plan` INNER JOIN `ad`
                    on `plan`.`id` = `ad`.`planId`
                    WHERE `plan`.`status` = '上架'";

            // $sqlDf = "SELECT  *
            //           FROM `plan` INNER JOIN `ad`
            //           on `plan`.`id` = `ad`.`planId`
            //           WHERE `plan`.`status` = '預設'";
            $today = date('Y-m-d');
            $stmtOn = $pdo->query($sqlOn);
            // echo '<pre>';
            // print_r($sqlOn);
            //  echo '</pre>';
        
            if($stmtOn->rowCount() > 0){
                $arrOn = $stmtOn->fetchAll(PDO::FETCH_ASSOC)[0];
                    if( $arrOn['startTime'] <= $today && $arrOn['dueTime'] >= $today ){
                        $bannerUrl = './images/'.$arrOn['Img'] ;
                        $bannerId = $arrOn['id'];
                        $bannerTitle = $arrOn['title'];
                        $bannerContent = $arrOn['content'];
                        
                    }else{ $bannerUrl = './images/預設.jpg';
                    }
            }else{ $bannerUrl = './images/預設.jpg';
            }
              // $stmtDf=$pdo->query($sqlDf);
              // if($stmtDf->rowCount() > 0){
              //   $arrDf = $stmtDf->fetchAll(PDO::FETCH_ASSOC)[0];
            
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

    <!-- 引入 jQuery 的函式庫 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <style>
        a {
            text-decoration: none;
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
        .bannerImg{
            width: 100%;
            height: 100%;
            object-fit:cover;
            
        }
        .bannerA{
            display:block;
            width: 100%;
            height: 100%;

        }
        
        .banner {
            position:relative;
            height: 500px;
            padding:0px;
        }

        .bannerText {
            position:absolute;
            color:#ffffff;
            background: rgba(0, 0, 0, 0.329);
            max-width: 60%;
            margin: auto;
            border-radius: 30px;
            top:45%;
            left:75%;
            transform: translate(-50%,-50%);
            padding:0px;
            
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

    <!-- 引入 jQuery 的函式庫 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function(){

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
        })
    </script>
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
                        
                        if(isset($_SESSION['username'])){
                        echo '<a class="navbar-brand text-white" href="./setting.php">版面設定</a> 
                                <a class="navbar-brand text-white logout">登出</a>';
                        }else{
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
    <div class="banner container-fluid d-flex">
        <a href="./index.php" class="bannerA"><img src="<?php echo $bannerUrl;?>" class="bannerImg">
        <!-- 頭版上的字 -->
        <div class="bannerText text-center p-4">
        <br><h2 class="bannerTitle">Album example</h2><br><br>
            <p class="bannerContent">Something short and leading about the collection below—its contents, the creator, etc. Make it short
                and
                sweet, but not too short so folks don’t simply skip over it entirely.</p>
        
        </div>
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
        <script>
            $(document).ready(function(){

                
                let arrOn = false;

                <?php if($arrOn){ echo 'arrOn = true;';}?>

                if(arrOn){
                    $('.bannerTitle').html('<?php echo $bannerTitle ?>');
                    $('.bannerContent').html('<?php echo $bannerContent; ?>')
                }

                $(document).on('click','.bannerA',function(){
                    $.ajax({
                        type: 'POST',
                        url: './clickCount.php',
                        data :{
                            id:<?php echo $bannerId; ?>
                        }
                    })

                })
            })
        </script>
</body>

</html>