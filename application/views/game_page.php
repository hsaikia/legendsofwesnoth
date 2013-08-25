<?php $this->load->view('title.php'); ?> 
<?php include "globals.php" ?>
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
<?php include "main_menu.php"; ?>
</div>

<div class="content" style="font-size:16px;">
<table style="width:800px;">
<?php 
	global $faction, $maps;
	echo "<tr><td class='timestamp'>[". $game->date ."]</td><td style='width:500'>" . getColoredHandle($game->handle_p1, $game->rating_p1) . " (" . $faction[$game->faction_p1] . ") ";
	if($game->winner == "P1")
		echo " defeated ";
	else
		echo " lost to ";
	echo getColoredHandle($game->handle_p2, $game->rating_p2) . " (" . $faction[$game->faction_p2] . ") on ". $maps[$game->map] ."</td></tr>";
?>
</table>
</div>
<br>
<div class="content" style="font-size:12px;">
<table style="width:800px;">
<?php
foreach ($comments as $comment) {
	echo "<tr><td style='width:150px;' class='timestamp'>[". $comment->date ."]</td><td style='width:100px;'><b>". getColoredHandle($comment->handle, $comment->rating) . "</b> :</td><td><i>" . $comment->text ."</i></td></tr>";
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
