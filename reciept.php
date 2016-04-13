<?php 

session_start();
include 'navigation.php';
include 'db_Connect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <title> </title>
    </head>
    <body>
        <?php
    
    if(count($_SESSION['cart_items'])>0){
 
    // get the product ids
    $ids = "";
    foreach($_SESSION['cart_items'] as $id=>$value){
        $ids = $ids . $id . ",";
    }
    
    // remove the last comma
    $ids = rtrim($ids, ',');
    
    // $ids = $ids + " ";
 
    //start table
    echo "<div class='title'><h1>Thank you for your order from Movie Mania</h1></div>";
    echo "<div class='title'><h1>Your Order Has Been Placed and will be delivered to you within 3-4 business days</h1></div>";
    echo "<div class='title'><h1>A copy of your Order can be found below</h1></div>";
    
    
    
    $sql = "SELECT * FROM Movies WHERE Movie_ID IN ($ids) ORDER BY Movie_Name";
    $movies = getDataBySQL($sql, $dbConn);
    echo "<table class='table table-hover table-responsive table-bordered' border = '1' align='center' >";

     //Using Form Buttons
         
         echo "<tr>Order Receipt</tr>";
         // our table heading
        echo "<tr>";
            echo "<th class='textAlignLeft'>Movie Name</th>";
            echo "<th>Year</th>";
            echo "<th>Genre)</th>";
            echo "<th>Duration(Mins)</th>";
        echo "</tr>";
        foreach ($movies as $movie) {
          echo "<tr rowspan='3'>"; 
          echo "<td align='center'>" . $movie['Movie_Name'] . "</td>"; 
          echo "<td align='center'>" . $movie['Movie_Year'] . "</td>"; 
          echo "<td align='center'>" . $movie['Movie_Genre'] . "</td>"; 
          echo "<td align='center'>" . $movie['Movie_Mins'] . "</td>"; 



          echo "</tr>";
        } //endForeach
        echo "</table>";
    }

        
    session_destroy()
?>
    </body>
</html>


