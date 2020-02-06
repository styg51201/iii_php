<?php
require_once './checkSession.php';
require_once './db.inc.php';

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// echo count($_POST);

// exit();

if (count($_POST) >= 7) {

    $_SESSION['target'] = $_POST['target'];
    $_SESSION['type'] = $_POST['type'];
    $_SESSION['place'] = $_POST['place'];
    $_SESSION['startTime'] = $_POST['startTime'];
    $_SESSION['dueTime'] = $_POST['dueTime'];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['cost'] = $_POST['cost'];
    $_SESSION['status'] = '審核';

    header("Refresh: 0; url=./addAd.php");
    // echo '<pre>';
    // print_r($_SESSION);
    // echo '</pre>';

} else {
    header("Refresh: 3; url=./addPlan.php");
    echo "請確實填寫";
}
