  <?php include("topbit.php");

    
    // Get input from form...
    $app_name = mysqli_real_escape_string($dbconnect, $_POST['app_name']);
    $dev_name = $_POST['dev_name'];
    $genre = $_POST['genre'];

    // Check if box is ticked...
    if (isset($_POST['in_app']))
    {
        // if box is ticked, we don't want in_app purchases
        $in_app = 0;
        }   // end checkbox checker

    else {
        // if box is not ticked we want BOTH in_app and no in_app purchases
        $in_app = 1;
        }

    // rating
    $rating_more_less = $_POST['rate_more_less'];
    $rating = $_POST['rating'];

    if ($rating_more_less == "at least")
    {
        $operator = ">=";
    }
    elseif ($rating_more_less == "at most")
    {
        $operator = "<=";
    }
    else
    {
        $operator = ">=";
        $rating = 0;
    }

    // rating
    
    $find_sql = "SELECT * FROM `game_details`
    JOIN genre ON (game_details.GenreID = genre.GenreID)
    JOIN developer ON (game_details.DeveloperID = developer.DeveloperID)
    WHERE `Name` LIKE '%$app_name%' 
    AND `DevName` LIKE '%$dev_name%'
    AND `Genre` LIKE '%$genre%'
    AND (`In App` = $in_app OR `In App` = 0)
    AND `User Rating` $operator $rating
    
    
    ";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);

?>

        <div class="box main">
            <h2>Advanced Search Results</h2>
            
            <?php 
            include ("results.php");
            ?>
            
        </div> <!-- / main -->
        
 <?php include("bottombit.php") ?>