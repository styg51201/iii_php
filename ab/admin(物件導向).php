<?php 

require_once('./checkSession.php');
require_once('./db.inc.php');
?>


<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <style>
    .border {
        border: 1px solid;
    }
    .w200px {
        width: 200px;
    }
    </style>
</head>
<body>

    <?php
    class Member
    {   
        public function showMember()
        {   echo '<tr>';
            echo  '<td class="border">'.$this->id.'</td>';
            echo  '<td class="border">'.$this->studentId.'</td>';
            echo  '<td class="border">'.$this->studentName.'</td>';
            echo  '<td class="border">'.$this->studentGender.'</td>';
            echo  '<td class="border">'.$this->studentBirthday.'</td>';
            echo  '<td class="border">'.$this->studentPhoneNumber.'</td>';
            echo  '<td class="border">'.$this->studentDescription.'</td>';
            echo  '<td class="border">'.$this->studentImg.'</td>';
            echo  '<td class="border">'.$this->created_at.'</td>';
            echo  '<td class="border">'.$this->updated_at.'</td>';
            echo '</tr>';
            
        }
    }

    $sql='SELECT *
        FROM `students`';

    $stmt =$pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_CLASS, 'Member');

    // print_r($row);
    // for($i=0; $i<count($row); $i++){
    
    // }
    // foreach ($row as $datainfo)
    // {
    //     echo $datainfo->showMember(); 
    // }

    // $row[0]->showMember();
  
    ?>

<table class="border">
    <thead>
        <tr>
            <th class="border">id</th>
            <th class="border">studentId</th>
            <th class="border">studentName</th>
            <th class="border">studentGender</th>
            <th class="border">studentBirthday</th>
            <th class="border">studentPhoneNumber</th>
            <th class="border">studentDescription</th>
            <th class="border">studentImg</th>
            <th class="border">created_at</th>
            <th class="border">updated_at</th>
        </tr>
    </thead>
    <tbody>

        <?php  
        foreach ($row as $datainfo)
        {
            echo $datainfo->showMember(); 
        }
        ?>

            </tbody>
        </table>

    </body>
</html>