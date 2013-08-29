<?php $this->load->view('title.php'); ?> 
<?php include "globals.php" ?>
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
	
</div>
<?php if ($this->ion_auth->logged_in()) include "user_menu.php"; ?>
<div class="content game_header">
<h2>Discuss Game</h2>	
<table style="width:900px;">
<tr><td>Date</td><td>Game Details</td><td>Sportsmanship(P1/P2)</td></tr>
<hr>	
<?php 
	global $faction, $maps;
	echo "<tr><td class='timestamp'>[". date('Y-m-d', strtotime($game->date)) ."]</td><td>" . getColoredHandle($game->handle_p1, $game->rating_p1) . " (" . $faction[$game->faction_p1] . ") ";
	if($game->winner == "P1")
		echo " defeated ";
	else
		echo " lost to ";
	echo getColoredHandle($game->handle_p2, $game->rating_p2) . " (" . $faction[$game->faction_p2] . ") on <a class='map' href='". site_url('stats/get_map_stats/' . $game->map). "'>". $maps[$game->map] ."</a></td>";
	
	echo "<td>";
	if($game->sports_p1 > 0) echo $game->sports_p1; else echo "-";  
	echo "/"; 
	if($game->sports_p2 > 0) echo $game->sports_p2; else echo "-";
	echo "</td></tr>";
?>
</table>
</div>
<br>
<div class="content game_discuss" >
<table style="width:900px;">
<?php
foreach ($comments as $comment) {
	echo "<tr><td style='width:150px;' class='timestamp'>[". date('Y-m-d', strtotime($comment->date)) ."]</td><td style='width:100px;'><b>". getColoredHandle($comment->handle, $comment->rating) . "</b> :</td><td style='width:600px;'>" . $comment->text ."</td></tr>";
} 
echo form_open('comment_game/add_comment/' . $game->id); ?>
<input type="hidden" name="my_handle" value='<?php echo $this->ion_auth->user()->row()->username; ?>' />
</table>
</div>
<div>
<textarea rows="3" cols="80" name="my_comment" style="font-family:Verdana"></textarea><br>
<input id="gobutton" type="submit" value="Publish Comment" size="3" />
<hr>
</div>

</div>
</center>
</body>
<?php $this->load->view('footer.php'); ?> 
