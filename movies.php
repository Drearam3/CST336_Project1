<?php
    session_start();
    include 'db_Connect.php';
    include 'navigation.php';
    $conn = getDatabaseConnection();

    
?>
<header>
    <link rel="stylesheet" href="main.css">
</header>
<?php
session_start();

function displayAllMovies($sql){
    $movies = getDataBySQL($sql, $dbConn);

     //Using Form Buttons
         echo "<table class='table table-hover table-responsive table-bordered' border = '1'>";
         // our table heading
        echo "<tr>";
            echo "<th class='textAlignLeft'>Movie Name</th>";
            echo "<th>Year</th>";
            echo "<th>Genre)</th>";
            echo "<th>Duration(Mins)</th>";
            echo "<th>Action</th>";
        echo "</tr>";
        foreach ($movies as $movie) {
          echo "<tr rowspan='3'>"; 
          echo "<td align='center'>" . $movie['Movie_Name'] . "</td>"; 
          echo "<td align='center'>" . $movie['Movie_Year'] . "</td>"; 
          echo "<td align='center'>" . $movie['Movie_Genre'] . "</td>"; 
          echo "<td align='center'>" . $movie['Movie_Mins'] . "</td>"; 
          echo "<td><a href='add_to_cart.php?id={$movie['Movie_ID']}&name={$movie['Movie_Name']}' class='btn btn-primary'>";
                        echo "<span class='cart'></span> Add to cart";
                    echo "</a><td>";



          echo "</tr>";
        } //endForeach
        echo "</table>";
     
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    
        <body>
            <div class="bigContainer">
                  <h1>Movies</h1>
                  
                    <form action = "cart.php">
                      <button class="fsSubmitButton2" onclick="window.location.href='products.php'">Go to Cart</button>
                    </form>
               
                 <div class = "search">
                        <!--Drop Down options for the user to select an item -->
                    <form action = 'movies.php' method = 'POST' >
                        <h3 > Search: </h3>
                        <b>Order By:</b> 
                        <select name = 'order'>
                            <option></option>
                            <option value = "Movie_Name">Name</option>
                            <option value = "Movie_Year">Year</option>
                            <option value = "Movie_Genre">Genre</option>
                            <option value = "Movie_Mins">Length</option>
                        </select>
                        
                        <b>Genre:</b> 
                            <select name = 'genre'>
                            <option></option>
                            <?php
                            $sql1 = "SELECT Genre from Genres";
                            $genres = getDataBySQL($sql1, $dbConn);
                        foreach ($genres as $genre) {
                          echo "<option>" . $genre['Genre'] . "<option>"; 
                        }
                            ?>
                            </select>
                        <b>Year:</b> <select name = 'year'>
                                <option></option>
                                <option value='1930'>1930's</option>
                                <option value='1940'>1940's</option>
                                <option value='1950'>1950's</option>
                                <option value='1960'>1960's</option>
                                <option value='1970'>1970's</option>
                                <option value='1980'>1980's</option>
                                <option value='1990'>1990's</option>
                                <option value='2000'>2000's</option>
                                <option value='2010'>2010's</option>
                            </select>
                        <b>Length Under:</b> <select name = 'length'>
                                <option></option>
                                <option>60</option>
                                <option>90</option>
                                <option>120</option>
                                <option>150</option>
                                <option>180</option>
                            </select>
                        
                        <b>Ascending/Descending:</b> <select name = 'direction'>
                            <option>ASC</option>
                            <option>DESC</option>
                        </select>
                        
                        
                        
                    <input type = 'submit' name = 'submit' value = 'Search' >
                    </form>  
                </div>
            </div>
               
               <?php
        

// Establish the connection and then alter how we are tracking errors (look those keywords up)
    //Turns items of rows in database into variables to be used in php
    $button = $_POST [ 'submit' ];
    $order = $_POST [ 'order' ];
    $genre = $_POST [ 'genre' ];
    $year = $_POST[ 'year' ];
    $yearHigher = $year + 10;
    $length = $_POST[ 'length' ];
    $direction = $_POST[ 'directon' ];

    
    //echos the results you put into the drop down boxes
    echo "<div class = 'results'>
    <span class = 'r'>Your Search Results for <u>Order By:</u> <b>" . $order . "</b></span> 
    <span class= 'r'><u>Genre:</u> <b>$" . $genre . "</b> </span>
    <span class= 'r'><u>Year:</u> <b>" . $year . " </b></span>
    <span class= 'r'><u>Duration:</u> <b>" . $length . " mins</b></span>
    <span class= 'r'><u>Ascending or Descending:</u> <b>" . $direction . " </b></span>
    
    </div>";
    
    
    //SQL comboes based on the user input to the drop-down boxes
    $query = "SELECT * FROM Movies ";
    //By Price
    //When the order category is filled out
    if ($genre != NULL)
    {
        $query .= "WHERE Movie_Genre ='" . $genre . "' ";
        if($year != NULL)
        {
            $query .= "AND Movie_Year BETWEEN '" . $year . "' AND '" . $yearHigher . "' ";
            if($length != NULL)
            {
                $query .= "AND Movie_Mins < " . $length;
                if($order != NULL)
                {
                    $query .= " ORDER BY " . $order . " ";
                    if($direction != NULL)
                    {
                        $query .= $direction;
                    }
                }
            }
            
        }
    }
    if($year != NULL)
        {
            $query .= "WHERE Movie_Year BETWEEN '" . $year . "' AND '" . $yearHigher . "' ";
            if($length != NULL)
            {
                $query .= "AND Movie_Mins < " . $length;
                if($order != NULL)
                {
                    $query .= " ORDER BY " . $order . " ";
                    if($direction != NULL)
                    {
                        $query .= $direction;
                    }
                }
            }
            
        }
    if($length != NULL)
        {
            $query .= "WHERE Movie_Mins < " . $length;
            if($order != NULL)
                {
                    $query .= " ORDER BY " . $order . " ";
                    if($direction != NULL)
                    {
                        $query .= $direction;
                    }
                }
        }
    if($order != NULL)
                {
                    $query .= " ORDER BY " . $order . " ";
                    if($direction != NULL)
                    {
                        $query .= $direction;
                    }
                }
    if($direction != NULL)
        {
            $query .= $direction;
        }
       
 
if($action=='added'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$movie['Movie_Name']}</strong> was added to your cart!";
    echo "</div>";
}
 
if($action=='exists'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$movie['Movie_Name']}</strong> already exists in your cart!";
    echo "</div>";
}


   displayAllMovies($query, $conn);  
   
 ?>  
        
        
        
        </body>
</html>