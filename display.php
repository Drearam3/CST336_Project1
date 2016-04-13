<?php
echo "<link rel='stylesheet' type='text/css' href='main.css' />";

session_start();
include 'db_Connect.php';
include 'navigation.php';
$conn = getDatabaseConnection();


// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
 
$sql = "SELECT * FROM Descriptions WHERE Movie_ID =" . $id;
$dess = getDataBySQL($sql, $conn);
echo "<table width=500 height=400px align='center' class='table-hover table-responsive table-bordered'>";
echo "<tr>";
            
            echo "<th>Year</th>";
            echo "<th>Genre</th>";
            echo "<th>Duration(Mins)</th>";
            echo "<th>Directed by:</th>";
        echo "</tr>";
foreach ($dess as $des){
    
    echo "<tr><div class='display' align='center'><font size='7' color='blue'>" .$name. "</font></div>";echo "<br /><br /></tr>";
    echo "<tr>"; 
    $sql1 = "SELECT * FROM Movies WHERE Movie_ID =" . $id;
    $movs = getDataBySQL($sql1, $conn);
    foreach ($movs as $mov){
          echo "<td align='center'>" . $mov['Movie_Year'] . "</td>"; 
          echo "<td align='center'>" . $mov['Movie_Genre'] . "</td>"; 
          echo "<td align='center'>" . $mov['Movie_Mins'] . "</td>";
    }
          $sql2 = "SELECT Director_Name FROM Directors WHERE Director_ID ='" .  $mov['Director_ID1'] . "' OR Director_ID ='" .  $mov['Director_ID2'] . "'";
            $dirs = getDataBySQL($sql2, $conn);
            echo "<td align='center'>";
            foreach ($dirs as $dir)
            {
                echo $dir['Director_Name'] . "</br>";
            }
            echo "<td align='center'>"; 
            echo "<tr><th colspan='4' class='textAlignLeft'>Desciption</th></tr>";
          echo "<tr >";
    echo "<td colspan='4'><div class='des'align='center'>" .$des['Description']. "</div></td></tr>";
}

?>