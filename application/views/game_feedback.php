<?php $this->load->view('title.php'); ?> 
<?php include "globals.php" ?>
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
<?php include "main_menu.php"; ?>
</div>

<div class="content game_header">
<h2>Provide Feedback for this Game</h2>	
<table style="width:900px;">
<tr><td>Date</td><td>Game Details</td><td>Sportsmanship(P1/P2)</td></tr>
<hr>	
<?php 
	global $faction, $maps;
	echo "<tr><td class='timestamp'>[". $game->date ."]</td><td>" . getColoredHandle($game->handle_p1, $game->rating_p1) . " (" . $faction[$game->faction_p1] . ") ";
	if($game->winner == "P1")
		echo " defeated ";
	else
		echo " lost to ";
	echo getColoredHandle($game->handle_p2, $game->rating_p2) . " (" . $faction[$game->faction_p2] . ") on ". $maps[$game->map] ."</td>";
	echo "<td>";
	if($game->sports_p1 > 0) echo $game->sports_p1; else echo "-";  
	echo "/"; 
	if($game->sports_p2 > 0) echo $game->sports_p2; else echo "-";
	echo "</td></tr>";
?>
</table>
</div>
<div>
	<?php echo form_open('report_game/feedback_receive/' . $game->id); ?>
<table><tr>
<td class="label">Sportsmanship</td>
<td class="field"><select name="sports">
<option selected value="0">-</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select></td>
</tr></table>
<input id="gobutton" type="submit" value="Send Feedback" size="3" />
<?php echo form_close(); ?>
<hr>
</div>

</div>
</center>
</body>
<?php $this->load->view('footer.php'); ?> 
