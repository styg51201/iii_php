<?php
require_once ('./db.inc.php');
require_once ('./checkSession.php');

if (1) {

    $sql = 'SELECT *
            FROM `plan1`
            INNER JOIN `ad1`
            ON `plan1`.`planId` = `ad1`.`adPlanId`
            WHERE `planUsername` = ?';
    $arrParam = [$_SESSION['username']];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $obj = [];
        for ($i = 0; $i < count($arr); $i++) {
            $obj[] = ['planId' => $arr[$i]['planId'],
                'planUsername' => $arr[$i]['planUsername'],
                'planName' => $arr[$i]['planName'],
                'planTarget' => $arr[$i]['planTarget'],
                'planType' => $arr[$i]['planType'],
                'planPlace' => $arr[$i]['planPlace'],
                'planCost' => $arr[$i]['planCost'],
                'planClick' => $arr[$i]['planClick'],
                'planStatus' => $arr[$i]['planStatus'],
                'planStartTime' => $arr[$i]['planStartTime'],
                'planDueTime' => $arr[$i]['planDueTime'],
                'plan_created_at' => $arr[$i]['plan_created_at'],
                'plan_updates_at' => $arr[$i]['plan_updates_at'],
                'adId' => $arr[$i]['adId'],
                'adName' => $arr[$i]['adName'],
                'adImg' => $arr[$i]['adImg'],
                'adTitle' => $arr[$i]['adTitle'],
                'adContent' => $arr[$i]['adContent'],
                'adPlanId' => $arr[$i]['adPlanId'],
                'ad_created_at' => $arr[$i]['ad_created_at'],
                'ad_updates_at' => $arr[$i]['ad_updates_at']
            ];

        }
        // echo '<pre>';
        // print_r($obj);
        // echo '</pre>';
        echo json_encode($obj);
    }

}
