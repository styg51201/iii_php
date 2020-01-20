<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">One</h1>

            </div>
            <h3>Welcome to One</h3>
            <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>


                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>

                <div class="form-group">
                    <input type="password" name="pwd" class="form-control" placeholder="Password">
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b submit">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>

            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function(){
            $(document).on('click', '.submit', function() {
                $.ajax({
                    type: 'POST',
                    url: './loginChk.php',
                    data: {
                        username:$('input[name=username]').val(),
                        pwd:$('input[name=pwd]').val()
                    }
                })
                .done(function(data) {
                    if(data){
                        $(document).on('click', '.confirm', function() { 
                            setTimeout("location='./index.php'",100);
                        })
                        swal("登入成功","","success");
                    

                    }else{
                        $(document).on('click', '.confirm', function() { 
                            setTimeout("location='./login.php'",100);
                        })
                        swal("登入失敗","","error");
                    };
                })
            })
        })    

    </script>
</body>

</html>
