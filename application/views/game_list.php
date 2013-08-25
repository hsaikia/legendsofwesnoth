<?php
include_once "globals.php"; 
global $faction, $maps;
foreach ($games as $game) {
	echo "<tr><td class='timestamp'>[". $game->date ."]</td><td style='width:500'>" . getColoredHandle($game->handle_p1, $game->rating_p1) . " (" . $faction[$game->faction_p1] . ") ";
	if($game->winner == "P1")
		echo " defeated ";
	else
		echo " lost to ";
	echo getColoredHandle($game->handle_p2, $game->rating_p2) . " (" . $faction[$game->faction_p2] . ") on ". $maps[$game->map] ."</td>";
	
	echo "<td><a style='text-decoration:none;' href='". site_url('comment_game/discuss/' . $game->id) . "'>Discuss</a></td></tr>";
} 
?>
