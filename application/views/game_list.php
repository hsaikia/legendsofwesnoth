<?php
include_once "globals.php"; 
global $faction, $maps;
global $feedback;
foreach ($games as $game) {
	echo "<tr><td style='width:150px;' class='timestamp'>[". $game->date . 
		"]</td><td style='width:700'>" . getColoredHandle($game->handle_p1, $game->rating_p1) . 
		" (<a class='fac' href='" . site_url('stats/get_faction_stats/' . $game->faction_p1) . "'>" . $faction[$game->faction_p1] . "</a>) ";
	if($game->winner == "P1"){
		echo " defeated ";
		if($this->ion_auth->user()->row()->username == $game->handle_p2 && $game->sports_p1 < 0)
			$feedback = true;
		else
			$feedback = false;
	} else {
		echo " lost to ";
		if($this->ion_auth->user()->row()->username == $game->handle_p1 && $game->sports_p2 < 0)
			$feedback = true;
		else
			$feedback = false;
	}
	echo getColoredHandle($game->handle_p2, $game->rating_p2) . 
		" (<a class='fac' href='" . site_url('stats/get_faction_stats/' . $game->faction_p2) . "'>" . $faction[$game->faction_p2] . "</a>) on <a class='map' href='". 
		site_url('stats/get_map_stats/' . $game->map). "'>". $maps[$game->map] ."</a></td>";
	
	
	if($feedback == FALSE)
		echo "<td><a style='text-decoration:none;' href='". site_url('comment_game/discuss/' . $game->id) . "'>Discuss</a></td>";
	else
		echo "<td><a style='text-decoration:none;' href='". site_url('report_game/feedback/' . $game->id) . "'>Feedback</a></td>";
	
	echo "<td><a style='text-decoration:none;' href='". $game->replay . "'>Download</a></td></tr>";
} 
?>
