  <?php include("topbit.php");

// Get Genre list from database
$genre_sql="SELECT * FROM `genre` ORDER BY `genre`.`Genre` ASC ";
$genre_query=mysqli_query($dbconnect, $genre_sql);
$genre_rs=mysqli_fetch_assoc($genre_query);

// Initialise form variables

$app_name = "";
$subtitle = "";
$url = "";
$genreID = "";
$dev_name = "";
$age = "";
$rating = "";
$rate_count = "";
$cost = "";
$inapp = 1;
$description = "";

$has_errors = "no";

// Code below excutes when the form is submitted...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "You pushed the button";
    
}   // end of button submitted code

?>

        <div class="box main">
            <div class="add-entry">
            <h2>Add An Entry</h2>
            
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                
            <!-- App Name (Required) -->
            <input class="add-field" type="text" name="app_name" value="<?php echo $app_name; ?>" placeholder="App Name (required) ..."/>
            
            <!-- Subtitle (optional) -->
            <input class="add-field" type="text" name="subtitle" size="40" value="<?php echo $subtitle; ?>"  placeholder="Subtitle (optional) ..."/>
                
            <!-- URL (required, must start http://) -->
            <input class="add-field <?php echo $url_field; ?>" type="text" name="url" size="40" value="<?php echo $url; ?>" placeholder="URL (required)"/>
                
            <!-- Genre dropdown (required) -->
            <select class="adv" name="genre">
                <!-- first / selected option -->
                <option value="" selected>Genre (Choose something)....</option>
                
                <!--- get options from database -->
                <?php 

                do {
                    ?>
                <option value="<?php echo $genre_rs['GenreID']; ?>"><?php echo $genre_rs['Genre']; ?></option>

                <?php
                }   // end genre do loop
                while ($genre_rs=mysqli_fetch_assoc($genre_query))
                ?>
                
            </select>
                
            <!-- Developer Name (required) -->
            <input class="add-field <?php echo $dev_field ?>" type="text" name="dev_name" value="<?php echo $dev_name; ?>" size="40" placeholder="Developer Name (required) ..."/>
                
            <!-- Age (set to 0 if left blank) -->
            <input class="add-field" type="text" name="age" value="<?php echo $age; ?>" placeholder="Age (0 for all)"/>
                
            <!-- Rating (Number between 0 - 5, 1 dp) -->
            <div>
                <input class="add-field" type="text" name="rating" value="<?php echo $rating; ?>"  step="0.1" min=0 max=5 placeholder="Rating (0-5)"/>
            </div> 
                
            <!-- # of ratings (integer more than 0) -->
            <input class="add-field" type="text" name="count" value="<?php echo $rate_count; ?>"  placeholder="# of Ratings"/>
                
            <!-- Cost (Decimal 2dp, must be more than 0) -->
            <input class="add-field" type="text" name="price" value="<?php echo $cost; ?>"  placeholder="Cost (number only)"/>

            <br /><br />
            <!-- In App Purchase radio buttons --> 
            <div>   
                <b>In App Purchase: </b>
                <!-- defaults to 'yes' -->
                <!-- NOTE: value in database is boolean, so 'no' becomes 0 and 'yes' becomes 1 -->

                <input type="radio" name="in_app" value="1" checked="checked" />Yes
                <input type="radio" name="in_app" value="0" />No
            </div>
                
            <br />
                
            <!-- Description text area -->
            <textarea class="add-field <?php echo $description_field?>" name="description" placeholder="Description...." rows="6"><?php echo $description; ?></textarea>
                
            <!-- Submit Button -->
            <p>
                <input class="submit advanced-button" type="submit" value="Submit" />
            </p>

                
            </form>
           
            </div>  <!-- / add-entry -->
        </div> <!-- / main -->
        
 <?php include("bottombit.php") ?>