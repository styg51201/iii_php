<?php
require_once ('./db.inc.php');
require_once ('./checkSession.php');

if ($_POST['check']=='all') {

    $sql = 'SELECT *
            FROM `plan1`
            INNER JOIN `ad1`
            ON `plan1`.`planId` = `ad1`.`adPlanId`
            INNER JOIN `sellgroup`
            ON `plan1`.`planId` = `sellgroup`.`groupPlanId`
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
                'planPlace' => $arr[$i]['planPlace'],
                'planGroup' => $arr[$i]['planGroup'],
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
                'adLink' => $arr[$i]['adLink'],
                'adLinkPlace' => $arr[$i]['adLinkPlace'],
                'adPlanId' => $arr[$i]['adPlanId'],
                'ad_created_at' => $arr[$i]['ad_created_at'],
                'ad_updates_at' => $arr[$i]['ad_updates_at'],
                'groupId' => $arr[$i]['groupId'],
                'groupPlanId' => $arr[$i]['groupPlanId'],
                'groupBuyItems' => $arr[$i]['groupBuyItems'],
                'groupHistoryItems' => $arr[$i]['groupHistoryItems'],
                'groupCollectItems' => $arr[$i]['groupCollectItems'],
                'groupHistoryCategory' => $arr[$i]['groupHistoryCategory'],
                'groupCollectCategory' => $arr[$i]['groupCollectCategory'],
                'groupCartCategory' => $arr[$i]['groupCartCategory'],
                'group_created_at' => $arr[$i]['group_created_at'],
                'group_updates_at' => $arr[$i]['group_updates_at'],
            ];

        }
        // echo '<pre>';
        // print_r($obj);
        // echo '</pre>';
        echo json_encode($obj);
    }else{
        echo false;

    }

}
