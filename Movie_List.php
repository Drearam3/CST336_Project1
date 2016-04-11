<?php
include 'db_Connect.php';
$conn = getDatabaseConnection();

?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <?php
            $sql = "SELECT * FROM Movies ORDER BY Movie_Name";
            $records = getDataBySQL($sql, $dbConn);
            
            echo "<table class = 'products' border = '1'>";
            
        foreach ($records as $record) {
          echo "<tr rowspan='3'>"; 
          echo "<td align='center'>" . $record['Movie_Name'] . "</td>"; 
          echo "<td align='center'>" . $record['Movie_Year'] . "</td>"; 
          echo "<td align='center'>" . $record['Movie_Genre'] . "</td>"; 
          
          echo "</tr>";
        } //endForeach
        echo "</table>";
        ?>

    </body>
</html>