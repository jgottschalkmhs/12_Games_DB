<?php include("topbit.php");


?>

        <div class="box main">
            <div class=" add-entry">
            <h2>Add An Entry</h2>
                
            
            <form method="post" enctype="multipart/form-data"
                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                
                
                <input class="add-field>" type="text" name="app_name" size="40" value="" placeholder="App Name (required) ..."/>

               
        <p>
			<input class="submit advanced-button" type="submit" value="Submit" />
		</p>
            
            </form>     
                
            </div>  <!--- / end add entry div -->
            
        </div> <!-- / main -->
        
 <?php include("bottombit.php") ?>