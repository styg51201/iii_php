<?php 
require_once('./checkSession.php');
require_once("./db.inc.php");


$sqlPromo = "INSERT INTO `promotion`
                (`username`,`object`,`objectId`,`rule`,`ruleNumber`,`discount`,`discountNumber`)
                VALUE (?,?,?,?,?,?,?)";
    $arrPromo = [$_SESSION["username"],
                $_POST["object"],
                0,
                $_POST["rule"],
                $_POST["ruleNumber"],
                $_POST["discount"],
                $_POST["discountNumber"]
    ];

    $stmtPromo= $pdo->prepare($sqlPromo);
    $stmtPromo->execute($arrPromo);

    if( $stmtPromo->rowCount() > 0 ){
        echo true;
    }else{
        echo false;

    }


?>