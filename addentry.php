<?php include("topbit.php");
    
// Initialise variables
$app_name = "";
$subtitle = "";
$url = "";
$dev_name = "";
$age = "";
$rating = "";
$rate_count = "";
$cost = "";
$description = "Description (required)";

$has_errors = "no";

// set up error field colours / visibilty (no errors at first)
$app_error = $url_error = "no-error";
$app_field = $url_field = "form-ok";

// Code below excutes when the form is submitted...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
// Get values from form...  
$app_name = mysqli_real_escape_string($dbconnect, $_POST['app_name']); 
$subtitle = mysqli_real_escape_string($dbconnect, $_POST['subtitle']);
$url = mysqli_real_escape_string($dbconnect, $_POST['url']);
$genreID = mysqli_real_escape_string($dbconnect, $_POST['genre']);
$dev_name = mysqli_real_escape_string($dbconnect, $_POST['dev_name']);
$age = mysqli_real_escape_string($dbconnect, $_POST['age']);
$rating = mysqli_real_escape_string($dbconnect, $_POST['rating']);
$rate_count = mysqli_real_escape_string($dbconnect, $_POST['count']);
$cost = mysqli_real_escape_string($dbconnect, $_POST['price']);
$in_app = mysqli_real_escape_string($dbconnect, $_POST['in_app']);
$description = mysqli_real_escape_string($dbconnect, $_POST['description']);
    
// error checking will go here...
    
// check App Name is not blank
if ($app_name == "") {
    $has_errors = "yes";
    $app_error = "error-text";
    $app_field = "form-error";
    }
    
// Check URL is valid...
    
// Remove all illegal characters from a url
$url = filter_var($url, FILTER_SANITIZE_URL);

if (filter_var($url, FILTER_VALIDATE_URL) == false) {
    $has_errors = "yes";
    $url_error = "error-text";
    $url_field = "form-error";
}
 
// check Genre is not blank
    
// check Developer name is not blank
    
// check age is an integer, it is blank, set it to zero
    
// check rating is a decimal between 0 and 5
    
// check number of ratings is an integer that is more than 0
    
// check cost is a number, if it's blank, set it to 0
    
// check description is not blank / 'Description required'

// if there are no errors...
if ($has_errors == "no") {   
// Go to success page...
header('Location: add_success.php');

// get developer ID if it exists...
$dev_sql ="SELECT * FROM `developer` WHERE `DevName` LIKE '$dev_name'";
$dev_query=mysqli_query($dbconnect, $dev_sql);
$dev_rs=mysqli_fetch_assoc($dev_query);
$dev_count=mysqli_num_rows($dev_query);
    
// if developer is alreday in the database...
if ($dev_count > 0) {
    $developerID = $dev_rs['DeveloperID'];
} // end developer if
    
else {
    $add_dev_sql = "INSERT INTO `developer` (`DeveloperID`, `DevName`) VALUES (NULL, '$dev_name');";
    $add_dev_query = mysqli_query($dbconnect,$add_dev_sql);
    
    // Get developer ID
    $newdev_sql = "SELECT * FROM `developer` WHERE `DevName` LIKE '$dev_name'";
    $newdev_query=mysqli_query($dbconnect, $newdev_sql);
    $newdev_rs=mysqli_fetch_assoc($newdev_query);
    
    $developerID = $newdev_rs['DeveloperID'];
    
}   // end addition of developer
    
// Add entry to database    
$addentry_sql = "INSERT INTO `game_details` (`ID`, `Name`, `Subtitle`, `URL`, `GenreID`, `DeveloperID`, `Age`, `User Rating`, `Rating Count`, `Price`, `In App`, `Description`) 
VALUES (NULL, '$app_name', '$subtitle', '$url', $genreID, $developerID, $age, $rating, $rate_count, $cost, $in_app, '$description');";
$addentry_query=mysqli_query($dbconnect,$addentry_sql);
    
// Get ID for next page
$getid_sql = "SELECT * FROM `game_details` WHERE 
`Name` LIKE '$app_name' 
AND `Subtitle` LIKE '$subtitle' 
AND `URL` LIKE '$url' 
AND `GenreID` = $genreID 
AND `DeveloperID` = $developerID 
AND `Age` = $age 
AND `User Rating` = $rating 
AND `Rating Count` = $rate_count 
AND `Price` = $cost
AND `In App` = $in_app
";
$getid_query=mysqli_query($dbconnect, $getid_sql);
$getid_rs=mysqli_fetch_assoc($getid_query);
    
$ID = $getid_rs['ID'];
$_SESSION['ID']=$ID;
    
}   // End of insert entry 
    
} // end of submit button pushed if
?>

        <div class="box main">
            <h2>Add An Entry</h2>
            
            <form method="post" enctype="multipart/form-data"
                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                
                <div class="<?php echo $app_error; ?>">
                    Please fill in the 'App Name' field
                </div>
                <input class="add-field <?php echo $app_field; ?>" type="text" name="app_name" size="40" value="<?php echo $app_name; ?>" placeholder="App Name (required) ..."/>

                <input class="add-field" type="text" name="subtitle" size="40" value="<?php echo $subtitle; ?>"  placeholder="Subtitle (optional) ..."/>
                
                
                <div class="<?php echo $url_error; ?>">
                    Please provide a valid URL
                </div>
                <input class="add-field <?php echo $url_field; ?>" type="text" name="url" size="40" value="<?php echo $url; ?>" placeholder="URL (required)"/>
                
                <div class="flex-container">
                    
                <div>
                
                <!-- Genre dropdown box -->
                
                <select class="search adv" name="genre">
                
                <option value="" selected>Genre (Choose something)...</option>
                
                <!--- get options from database -->
                <?php 
                $genre_sql="SELECT * FROM `genre` ORDER BY `genre`.`Genre` ASC ";
                $genre_query=mysqli_query($dbconnect, $genre_sql);
                $genre_rs=mysqli_fetch_assoc($genre_query);
                do {
                    ?>
                <option value="<?php echo $genre_rs['GenreID']; ?>"><?php echo $genre_rs['Genre']; ?></option>

                <?php
                }   // end genre do loop
                while ($genre_rs=mysqli_fetch_assoc($genre_query))
                ?>
            
            </select>
            </div> <!-- / genre div -->
                    
            <div>
                <input class="add-field" type="text" name="dev_name" value="<?php echo $dev_name; ?>" size="40" placeholder="Developer Name (required) ..."/>
                
            </div>  <!-- / developer div -->
            </div> <!-- / genre | developer flex -->
                
            
            <div class="flex-container">
            
                <div>
                    <input class="add-field" type="number" name="age" value="<?php echo $age; ?>" placeholder="Age (0 for all)"/>
                </div>     <!-- Age -->
                
                <div>
                    <input class="add-field" type="number" name="rating" value="<?php echo $rating; ?>"  placeholder="Rating (0-5)"/>
                </div>     <!-- Rating -->
                
                <div>
                    <input class="add-field" type="number" name="count" value="<?php echo $rate_count; ?>"  placeholder="# of Ratings"/>
                </div>     <!-- Count -->
                
            </div>  <!-- / age and rating flexbox -->
                
            <div class="flex-container">
                
                <div>
                    <input class="add-field" type="number" step="0.01" min="0" name="price" value="<?php echo $cost; ?>"  placeholder="Cost (number only)"/>
                </div>     <!-- / Price -->
                
                <div class="inapp">
                <b>In App Purchase: </b>
                <!-- defaults to 'yes' -->
                <!-- NOTE: value in database is boolean, so 'no' becomes 0 and 'yes' becomes 1 -->
                <input class="radio-btn" type="radio" name="in_app" value="1" checked="checked">Yes
                <input class="radio-btn" type="radio" name="in_app" value="0">No
                
                </div>     <!-- / In App -->
                
            </div>  <!-- / In App and Price flex -->
                
        <p>            
    <textarea class="add-field" name="description" rows="6" cols="100"><?php echo $description; ?></textarea>
		</p>
                
        <p>
			<input class="submit advanced-button" type="submit" value="Submit" />
		</p>
            
            </form>          
            
        </div> <!-- / main -->
        
 <?php include("bottombit.php") ?>