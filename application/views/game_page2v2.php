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
<h2>Discuss Game</h2>
<table style="width:800px;">
<?php 
	global $faction, $maps2v2;
	echo "<tr><td class='timestamp'>[". $game->date ."]</td><td style='width:700'>" . getColoredHandle($game->handle_w1, $game->rating_w1) . " (" . $faction[$game->faction_w1] . ") and " . getColoredHandle($game->handle_w2, $game->rating_w2) . " (" . $faction[$game->faction_w2] . ") ";
	echo " defeated ";
	echo getColoredHandle($game->handle_l1, $game->rating_l1) . " (" . $faction[$game->faction_l1] . ") and ". getColoredHandle($game->handle_l2, $game->rating_l2) . " (" . $faction[$game->faction_l2] . ") on ". $maps2v2[$game->map] ."</td>";
	
	echo "<td><a style='text-decoration:none;' href='". site_url('comment_game/discuss/' . $game->id) . "'>Discuss</a></td></tr>";
?>
</table>
</div>
<br>
<div class="content game_discuss">
<table style="width:800px;">
<?php
foreach ($comments as $comment) {
	echo "<tr><td style='width:150px;' class='timestamp'>[". $comment->date ."]</td><td style='width:100px;'><b>". getColoredHandle($comment->handle, $comment->rating) . "</b> :</td><td>" . $comment->text ."</td></tr>";
} 
echo form_open('comment_game/add_comment_2v2/' . $game->id); ?>
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
