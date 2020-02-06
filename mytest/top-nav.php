
<!-- Sweet Alert -->
<link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="" href="./index.php">
                                <i class="fa fa-paw"></i>首頁
                            </a>
                        </li>
                      <li>
                            <a class="logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- JQ -->
    <script src="js/jquery-3.1.1.min.js"></script>

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
