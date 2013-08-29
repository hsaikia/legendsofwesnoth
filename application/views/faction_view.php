<html>
<?php $this->load->view('title.php'); ?> 
<script>
<?php 
	global $faction;
	foreach($faction as $key => $value){
		$wins[$key] = 0;
		$loss[$key] = 0;
	}
	$overall_wins = 0;
	$overall_losses = 0;
	foreach($games as $game){
		if($game->winner == "P1"){
			if($game->faction_p1 == $race && $game->faction_p2 != $race){
				++$wins[$game->faction_p2]; //wins against!	
				++$overall_wins;			
			} else if ($game->faction_p2 == $race && $game->faction_p1 != $race){
				++$loss[$game->faction_p1]; //losses against!
				++$overall_losses;
			}
		} else {
			if($game->faction_p2 == $race && $game->faction_p1 != $race){
				++$wins[$game->faction_p1];	//wins against!
				++$overall_wins;			
			} else if ($game->faction_p1 == $race && $game->faction_p2 != $race){
				++$loss[$game->faction_p2]; //losses against!
				++$overall_losses;
			}
		}
	}
?>
</script>
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
</div>
<?php global $faction;?>
<?php if ($this->ion_auth->logged_in()) include "user_menu.php"; ?>	
<div id="map_page_content" class="content">
<h2><?php echo $faction[$race]?> against other factions </h2>
<p>Note: Mirror games are not considered in these statistics.</p>
<hr>

<div id="faction_stats">
<table height="340">
<?php 
	global $faction;
	$i = 0;
	foreach($faction as $key => $value){
		if($i == 0)
			echo "<tr>";
		if($i == 3)
			echo "</tr><tr>";
		if($key != $race)	
			echo "<td><div><center><canvas id=". $key ." width=\"130\" height=\"130\"></canvas><br><br>Against ". $value . " " . $wins[$key]. " Win(s) and " . $loss[$key] ." Loss(es). </center></div></td>";
		else
			echo "<td><div><center><canvas id=". $key ." width=\"170\" height=\"170\"></canvas><br><br>Overall " . $overall_wins . " Win(s) and " . $overall_losses ." Loss(es). </center></div></td>";	
		++$i;
	}
	echo "</tr>";
?>	
</table>
</div>

</div>	
<?php $this->load->view('footer.php'); ?>
</div> 
</center>
</body>
</html>
<script>
	<?php
	foreach($faction as $key => $value){
		if($key == $race)
			echo "var data = [{value : ". $overall_wins . ", color:\"#008500\"}, {value: " . $overall_losses . " , color:\"#a60400\"},];";
		else
			echo "var data = [{value : ". $wins[$key] . ", color:\"#008500\"}, {value: " . $loss[$key] . " , color:\"#a60400\"},];";
		echo "var myPie = new Chart(document.getElementById(\"". $key . "\").getContext(\"2d\")).Pie(data);";
	}
	?>
</script>
