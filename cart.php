<?php
session_start();
 
$page_title="Cart";
include 'db_Connect.php';
include 'navigation.php';
$conn = getDatabaseConnection();
 
$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
 
if($action=='removed'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> was removed from your cart!";
    echo "</div>";
}
 
 
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
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
        // our table heading
        echo "<tr>";
            echo "<th class='textAlignLeft'>Movie Name</th>";
            echo "<th>Year</th>";
            echo "<th>Genre</th>";
            echo "<th>Duration(Mins)</th>";
            echo "<th>Action</th>";
        echo "</tr>";
        
        $query = "SELECT * FROM Movies WHERE Movie_ID IN ($ids) ORDER BY Movie_Name";
 
        $cart_items = getDataBySQL($query);
 
        foreach($cart_items as $cart_item)
        {
            echo "<tr rowspan='3'>"; 
          echo "<td align='center'>" . $cart_item['Movie_Name'] . "</td>"; 
          echo "<td align='center'>" . $cart_item['Movie_Year'] . "</td>"; 
          echo "<td align='center'>" . $cart_item['Movie_Genre'] . "</td>"; 
          echo "<td align='center'>" . $cart_item['Movie_Mins'] . "</td>";
          echo "<td>";
            echo "<a href='remove_from_cart.php?id={$cart_item['Movie_ID']}&name={$cart_item['Movie_Name']}' class='btn btn-danger'>";
            echo "<span class='glyphicon glyphicon-remove'></span> Remove from cart";
            echo "</a>";
            echo "</td>";
            echo "</tr>";

        }
        echo "<tr>";
                    echo "<td><a href='reciept.php' class='btn btn-success'>";
                        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Checkout";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
    echo "</table>";
    }

else{
    echo "<div class='alert alert-danger'>";
        echo "<strong>No products found</strong> in your cart!";
    echo "</div>";
}


?>