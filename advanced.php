  <?php include("topbit.php");

    
    // Get input from form...
    $app_name = $_POST['app_name'];
    $dev_name = $_POST['dev_name'];
    $genre = $_POST['genre'];

    // Check if box is ticked...
    if (isset($_POST['in_app']))
    {
        $in_app = 0;
        $in_app2 = 0;
    }   // end checkbox checker

    else {
        $in_app = 1;
        $in_app2 = 0;
    }
    
    $find_sql = "SELECT * FROM `game_details`
    JOIN genre ON (game_details.GenreID = genre.GenreID)
    JOIN developer ON (game_details.DeveloperID = developer.DeveloperID)
    WHERE `Name` LIKE '%$app_name%' 
    AND `DevName` LIKE '%$dev_name%'
    AND `Genre` LIKE '%$genre%'
    AND (`In App` = $in_app OR `In App` =$in_app2)
    
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