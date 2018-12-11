<?php include("code.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Farm Game</title>
		 <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	</head>
	<body>
	
<div class="container" style="padding:20px;">
		<h2 class="text-center">Welcome to Farm Game</h2>
	      
	      <div class="content">
	      	    <h5>How to play game</h5>
	      	    <ul>
					<li>There’s a button to start a new game.</li>
					<li>There's a green button to feed the farmer and the animals.</li>
	      	    	<li>There are Farmer, 2 Cows and 4 Bunny.</li> 
	      		    <li>Farmer: needs to be fed at least once every 15 turns.</li> 
	      	        <li>There are 2 Cows: each cow needs to be fed at least once every 10 turns.</li> 
                    <li>There are 4 bunnies: each bunny needs to be fed at least once every 8 turns.</li>
                    <li>If any of the animals or the farmer are not fed on time, they will die.</li>
                    <li>If the farmer dies, all animals die and the game is over.</li>
                    <li>The system would randomly chooses whom to feed</li>
                    <li>The game ends after 50 turns. If the farmer and at least one cow and one bunny are still alive at that point, you win.</li>
                </ul>  
				
          </div>
		  
	          <a href="game.php" class="btn btn-success ">Start Game</a>
	      
</div>
	</body>
</html>
