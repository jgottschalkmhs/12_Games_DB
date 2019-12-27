  <?php include("topbit.php");

    $find_sql = "SELECT * FROM `game_details`
    JOIN genre ON (game_details.GenreID = genre.GenreID)
    JOIN developer ON (game_details.DeveloperID = developer.DeveloperID)
    
    ";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);

?>

        <div class="box main">
            <h2>All Results</h2>
            
            
            <?php
            
            if($count < 1) {
                
              ?>
            
            <div class="error">
            
                Sorry!  There are no results that match your search.  Please use the search box in the side bar to try again.
                
            </div>  <!-- end error -->
            
            <?php
            } // end no results if
            
            else {
                do
                {
                    
                    ?>
            
            <!-- Results go here -->
            <div class="results">
                
                <!-- Heading and subtitle -->
                
                <div class="flex-container">
                    <div>
                        <span class="sub_heading">
                            <a href="<?php echo $find_rs['URL']; ?>">
                                <?php echo $find_rs['Name']; ?>
                            </a>
                        </span> 
                    </div>  <!-- / Title -->
                    
                    <?php
                        if($find_rs['Subtitle'] != "") 
                        
                        {
                        
                        ?>
                    <div>
                        
                       &nbsp; &nbsp; | &nbsp; &nbsp;
                        
                        <?php echo $find_rs['Subtitle'] ?>
                        
                    </div>  <!-- / subtitle -->
                    
                    <?php
                            
                        }
                    ?>
                
                
                </div>
                <!-- / Heading and subtitle -->
                
                <!-- Ratings Area -->
                
                <div class="flex-container">
                    
                    <!-- Partial Stars Original Source: https://codepen.io/Bluetidepro/pen/GkpEa -->
                    <div class="star-ratings-sprite">
                        
                    </div>  <!-- / star rating div -->
                    
                    <div class="actual-rating">
                        (<?php echo $find_rs['User Rating'] ?> based on <?php echo number_format($find_rs['Rating Count']) ?> ratings)
                        
                    </div>  <!-- / text rating div -->
                    
                </div>  <!-- / ratings flexbox -->
                
                <!--- / Ratings Area -->
                
                <!-- Price --> 
                
                <?php 
                    
                    if($find_rs['Price'] == 0) {
                        ?>
                    <p>
                        Free 
                        <?php 
                            if($find_rs['In App'] == 1) 
                            {
                                ?>
                                    (In App Purchase)
                                <?php
                                
                            }   // end In App if
                        ?>
                        
                    </p>
                
                    <?php
                    } // end price if
                    
                    else {
                      
                      ?>
                    <b>Price:</b> $<?php echo $find_rs['Price'] ?>
                
                    <?php
                        
                    }   // end price else (displays cost)
                
                ?>
                
                <!--- / Price -->
  
            </div>  <!-- / results -->
            
            <br />
            
            <?php
                    
                } // end results 'do'
                
                while
                    ($find_rs=mysqli_fetch_assoc($find_query));
                
            } // end else
            
            ?>
            

            
        </div> <!-- / main -->
        
 <?php include("bottombit.php") ?>