<?php
include_once "globals.php"; 
global $faction, $maps2v2;
foreach ($games as $game) {
	echo "<tr><td class='timestamp'>[". date('Y-m-d', strtotime($game->date)) ."]</td><td style='font-size:14px;'>" . getColoredHandle($game->handle_w1, $game->rating_w1) . " (" . $faction[$game->faction_w1] . ") and " . getColoredHandle($game->handle_w2, $game->rating_w2) . " (" . $faction[$game->faction_w2] . ") ";
	echo " defeated ";
	echo getColoredHandle($game->handle_l1, $game->rating_l1) . " (" . $faction[$game->faction_l1] . ") and ". getColoredHandle($game->handle_l2, $game->rating_l2) . " (" . $faction[$game->faction_l2] . ") on ". $maps2v2[$game->map] ."</td>";
	
	echo "<td><a style='text-decoration:none;' href='". site_url('comment_game/discuss_2v2/' . $game->id) . "'>Discuss</a></td>";
	echo "<td><a style='text-decoration:none;' href='". $game->replay . "'>Download</a></td></tr>";
	
} 
?>
