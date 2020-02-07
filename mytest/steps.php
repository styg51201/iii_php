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

    <!-- JQ UI CSS -->
    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />

    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">

    <style>
      
    </style>

</head>

<body>
    <div id="example-basic">
        <h3>Keyboard</h3>
        <section>
            <p>Try the keyboard navigation by clicking arrow left or right!</p>
        </section>
        <h3>Effects</h3>
        <section>
            <p>Wonderful transition effects.</p>
        </section>
        <h3>Pager</h3>
        <section>
            <p>The next and previous buttons help you to navigate through your content.</p>
        </section>
    </div>

    <!-- 引入 jQuery 的函式庫 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

      <!-- JQ UI -->
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Steps -->
    <script src="js/plugins/steps/jquery.steps.min.js"></script>

    <script>
        $("#example-basic").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true
        });
    </script>
</body>
</html>