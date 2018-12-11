<?php
	session_start();
			
	// Active farmer,cow,bunny
	$farm_arr = $arr = array('farmer','cow 1','cow 2','bunny 1','bunny 2','bunny 3','bunny 4');					
	if( isset($_SESSION['dead']) && !empty($_SESSION['dead']) && is_array($_SESSION['dead']) ){
		foreach( $arr as $key=>$indv ){
			if( in_array($indv,$_SESSION['dead']) ){
				unset($arr[$key]);
			}
		}
		$arr = array_values($arr);
	}
	
	// Start new game 
	if( isset($_POST['start']) && !empty($_POST['start']) ){
		session_destroy();
		$filename = basename($_SERVER['PHP_SELF']);
		header("location:".$filename);
	}

	if( isset($_POST['feed']) && isset($_POST['check']) && isset($_SESSION['check']) && $_POST['check'] == $_SESSION['check'] ){
		
		// total rounds
		if( !isset($_SESSION['total']) ){
			$_SESSION['total'] = 1;
		}else{
			$_SESSION['total']++;
		}			
		
		// random select
		$i = 0;
		$alive_cnt = count($arr)-1;
		shuffle($arr);
		$selected = $arr[$i];
		
		// feed rounds
		
		foreach( $arr as $indv ){
			
			if( $indv == $selected ){
				if( !isset($_SESSION['count'][$indv]) ){
					$_SESSION['count'][$indv] = 1;
				}else{
					$_SESSION['count'][$indv]++;
				}
				$_SESSION['farm'][][$indv] = 'fed';
			}

			$limit = 8; // bunny rounds
			if( $indv == 'farmer1' ){
				$limit = 15; // farmer rounds
			}elseif( in_array( $indv, array('cow1','cow2') ) ){
				$limit = 10; // cow rounds
			}
			
			$fed = 0;
			if( isset($_SESSION['count'][$indv]) && !empty($_SESSION['count'][$indv]) ){
				$fed = $_SESSION['count'][$indv];
			}
			$total = $_SESSION['total'];
			$min = $total / $limit;
			
			// dead
			if( $total % $limit == 0 && $fed < $min ){
				$_SESSION['dead'][] = $indv;
			}
			
		}
		
	}
	
	$msg = '';
	$stop = 0;
	if( isset($_SESSION['total']) && !empty($_SESSION['total']) && $_SESSION['total'] >= 50 ){
		$stop = 1;
		if( isset($arr) && !empty($arr) ){
			$farmer = $cow = $bunny = 0;
			foreach( $arr as $alive ){
				if( $alive == 'farmer1' ){
					$farmer++;						
				}if( strpos($alive,'cow') !== false ){
					$cow++;						
				}if( strpos($alive,'bunny') !== false ){
					$bunny++;						
				}
			}
			if( $farmer >= 1 && $cow >= 1 && $bunny >= 1 ){
				$msg = '<div class="alert alert-success"><b>Game Over:</b> You won the game.</div>';
			}else{
				$msg = '<div class="alert alert-danger"><b>Game Over:</b> You lost the game. Atleast the farmer, 1 cow and 1 bunny should be alive.</div>';
			}
		}
	}elseif( isset($_SESSION['dead']) && !empty($_SESSION['dead']) && in_array('farmer',$_SESSION['dead']) ){
		$stop = 1;
		$msg = '<div class="alert alert-danger"><b>Game Over:</b> You lost the game, farmer died.</div>';
	}
	
	$name = 'feed';
	$type = 'submit';
	$disabled = '';
	if( $stop == 1 ){
		$name = 'stop';
		$type = 'button';
		$disabled = 'disabled';
	}
	
	$check = time();
	$_SESSION['check'] = $check;
			
?>