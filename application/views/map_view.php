<html>
<?php $this->load->view('title.php'); ?> 
<script>
<?php 
	global $faction;
	foreach($faction as $key => $value){
		$wins[$key] = 0;
		$loss[$key] = 0;
	}
	foreach($games as $game){
		if($game->winner == "P1"){
			++$wins[$game->faction_p1];		
			++$loss[$game->faction_p2];		
		} else {
			++$wins[$game->faction_p2];		
			++$loss[$game->faction_p1];		
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
<?php global $maps;?>
<?php if ($this->ion_auth->logged_in()) include "user_menu.php"; ?>	
<div id="map_page_content" class="content">
<h2>How all factions fared on <?php echo $maps[$map]?></h2>
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
		echo "<td><div><center><canvas id=". $key ." width=\"130\" height=\"130\"></canvas><br><br>". $value . " " . $wins[$key]. " Win(s) and " . $loss[$key] ." Loss(es). </center></div></td>";
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
		echo "var data = [{value : ". $wins[$key] . ", color:\"#008500\"}, {value: " . $loss[$key] . " , color:\"#a60400\"},];";
		echo "var myPie = new Chart(document.getElementById(\"". $key . "\").getContext(\"2d\")).Pie(data);";
	}
	?>
</script>
