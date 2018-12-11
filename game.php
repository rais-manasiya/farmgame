<?php include("code.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Farm Game</title>
		 <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	</head>
	<body>
	
<div class="container">
		<form method="post" action="" class="text-center " style="margin:20px;">
			<input type="hidden" name="check" value="<?php echo $check; ?>" />
			<input type="<?php echo $type; ?>" name="<?php echo $name; ?>" value="Feed" <?php echo $disabled; ?> class="btn btn-success" />
			<input type="submit" name="start" value="Start a new game" class="btn btn-danger" />
			<?php if( $stop == 1 ){ ?>				
				<br/><br/> <?php echo $msg; ?>
			<?php } ?>
		</form>
		

		<?php
			if( isset($_SESSION['farm']) && !empty($_SESSION['farm']) ){
		?>
			<table  class="table table-bordered">
			<thead style="background-color:#ddd;">
				<tr>
					<th>Round</td>
					<?php
						foreach( $farm_arr as $header ){
							$bgcolor = '';
							if( isset($_SESSION['dead']) && !empty($_SESSION['dead']) && in_array($header,$_SESSION['dead']) ){
								$bgcolor = 'class="bg-danger" style="color:#fff;"';
								echo "<th ".$bgcolor.">".ucfirst($header)." (Died)</th>";
							}
							else
							{
							echo "<th ".$bgcolor.">".ucfirst($header)."</th>";
							}
						}
					?>
				</tr>
				</thead>
				<tbody>
				<?php 
					foreach( $_SESSION['farm'] as $key => $indv ){
						echo "<tr>";
						echo "<td>".($key+1)."</td>";
						foreach( $farm_arr as $entity ){
							
							if( isset($_SESSION['farm'][$key][$entity]) && !empty($_SESSION['farm'][$key][$entity]) ){
								echo "<td class='bg-success' style='color:#fff;'>".ucfirst($_SESSION['farm'][$key][$entity])."</td>";
							}else{
								echo "<td></td>";
							}
						}
						echo "</tr>";
					}				
				?>
				</tbody>
			</table>
		<?php
			}
		?>
	
		<?php
			//echo "<pre>"; print_r($arr);
			//if( isset($_POST) ){ print_r($_POST); }
			//if( isset($_SESSION) ){  print_r($_SESSION);  }echo "<pre/>";
		?>
</div>
	</body>
</html>
