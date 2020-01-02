  <?php include("topbit.php") ?>

        <div class="box main">
            <h2>Add An Entry</h2>
            
            <form method="post" enctype="multipart/form-data"
                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                
                <input class="add-field" type="text" name="app_name" size="40" value="" required placeholder="App Name (required) ..."/>
                
                <input class="add-field" type="text" name="subtitle" size="40" value=""  placeholder="Subtitle (optional) ..."/>
                
                <input class="add-field" type="text" name="url" size="40" value="" required placeholder="URL (required)"/>
                
                <div class="flex-container">
                    
                <div>
                
                <!-- Genre dropdown box -->
                
                <select class="search adv" required name="genre">
                
                <option value="" disabled selected>Genre (Choose something)...</option>
                
                <!--- get options from database -->
                <?php 
                $genre_sql="SELECT * FROM `genre` ORDER BY `genre`.`Genre` ASC ";
                $genre_query=mysqli_query($dbconnect, $genre_sql);
                $genre_rs=mysqli_fetch_assoc($genre_query);

                do {
                    ?>
                <option value="<?php echo $genre_rs['Genre']; ?>"><?php echo $genre_rs['Genre']; ?></option>

                <?php

                }   // end genre do loop

                while ($genre_rs=mysqli_fetch_assoc($genre_query))

                ?>
            
            </select>
            </div> <!-- / genre div -->
                    
            <div>
                <input class="add-field" type="text" name="dev_name" value="" required size="40" placeholder="Developer Name (required) ..."/>
                
            </div>  <!-- / developer div -->
            </div> <!-- / genre | developer flex -->
                
            
            <div class="flex-container">
            
                <div>
                    <input class="add-field" type="number" name="age" value="" placeholder="Age (0 for all)"/>
                </div>     <!-- Age -->
                
                <div>
                    <input class="add-field" type="number" name="rating" value="" required  placeholder="Rating (0-5)"/>
                </div>     <!-- Rating -->
                
                <div>
                    <input class="add-field" type="number" name="count" value="" required  placeholder="# of Ratings"/>
                </div>     <!-- Count -->
                
            </div>  <!-- / age and rating flexbox -->
                
            <div class="flex-container">
                
                <div>
                    <input class="add-field" type="number" name="price" value="" required  placeholder="Cost (number only)"/>
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
            <textarea class="add-field" name="description" required rows="6" cols="100" placeholder="Description (required)"></textarea>
		</p>
                
        <p>
			<input class="submit advanced-button" type="submit" value="Submit" />
		</p>
            
            </form>          
            
        </div> <!-- / main -->
        
 <?php include("bottombit.php") ?>