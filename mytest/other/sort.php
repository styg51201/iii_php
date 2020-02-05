<?php 
require_once('./db.inc.php');
// echo '<pre>';
//         print_r($_POST);
//         echo '</pre>';
//         exit();
if($_POST['check']=='sort'){

    $sqlSort = "SELECT *
    FROM `categoryies`";

    $stmtSort=$pdo->prepare($sqlSort);
    $stmtSort->execute();


    if($stmtSort->rowCount() > 0){ 
        $arrSort = $stmtSort->fetchAll(PDO::FETCH_ASSOC);
        $objSort=[];
        for($i=0;$i<count($arrSort);$i++){           
            $objSort[]=['categoryId'=> $arrSort[$i]['categoryId'],
            'categoryName'=> $arrSort[$i]['categoryName']];
        }
        // echo '<pre>';
        // print_r($objSort);
        // echo '</pre>';
        echo json_encode($objSort);
    }
}
else if($_POST['check']=='item'){

    $sqlItem = "SELECT *
    FROM `items`";

    $stmtItem=$pdo->prepare($sqlItem);
    $stmtItem->execute();


    if($stmtItem->rowCount() > 0){ 
        $arrItem = $stmtItem->fetchAll(PDO::FETCH_ASSOC);
        $objItem=[];
        for($i=0;$i<count($arrItem);$i++){           
            $objItem[]=['itemId'=> $arrItem[$i]['itemId'],
                        'itemName'=> $arrItem[$i]['itemName'],
                        'itemImg'=> $arrItem[$i]['itemImg']
            ];
        }
        // echo '<pre>';
        // print_r($objItem);
        // echo '</pre>';
        echo json_encode($objItem);
    }

}


?>