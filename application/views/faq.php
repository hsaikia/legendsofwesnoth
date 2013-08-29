<!doctype html>
<html>
<?php $this->load->view('title.php'); ?> 
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
</div>
<?php if ($this->ion_auth->logged_in()) include "user_menu.php"; ?>	

<div id="static_content" class="content">
<h1 class="static_header">FAQ</h1>	
<h3 class="static_header">Why a new ladder?</h3>
<p>Because demands of a new improved ladder were growing amongst the ladder community, and also due to several issues with old ELO based ladders. But the major reason behind LoW is allowing an improvement to the game - by means of faction balancing, map balancing, allowing of newer factions in the default era etc.</p>

<h3 class="static_header">Why Trueskill?</h3>
<p>The reasons far exceed what can be mentioned. Firstly ELO K-factors - which determine the quality of a game based on player strength and experience - are erroneously constant. They do not in any way take into account current player strength, nor her experience in the game. This leads to low quality games, as well as various other means of "tricking" the system. Several variants to Elo have been researched by the community in the past few years. What was required was a rating system which could do away with the limitations of Elo, and also at the same time, manage to scale to different game types. Trueskill was the answer. Not only does it help a player achieve her "true skill" faster, with fewer games played, it also scales to other game types. Hence a separate 2v2 ladder was finally made possible with LoW. In the future Survival game types with different scenarios and factions are going to be considered. This will hopefully contribute immensely to the balancing of factions and maps, as well as better determining other parameters in a particular game type scenario. As well as drawing more people to the game by reaching out to a larger community, rather than exclusively cater to just the 1v1 players.</p>

<h3 class="static_header">Now for the fun stuff! What is this new color coding scheme?</h3>
<p>The color coding scheme encodes the strength of a player to a particular color of their handle. This helps in quickly identifying player strengths in game discussions, or while browsing through the recent games. The color coding is done according to some standard trueskill parameter settings. The colors map to ratings like this :
<table>

<?php 
global $colorscheme;
foreach($colorscheme as $key => $value)
	if($key >= 0)
	echo "<tr><td>Greater than ". round(100 * $key , 0)  . "</td><td><div class='color_coding_sample' style='background:" . $colorscheme[$key] . "'><img /></div></td></tr>";
	else
	echo "<tr><td>Everyone else </td><td><div class='color_coding_sample' style='background:" . $colorscheme[$key] . "'><img /></div></td></tr>";
?>
</table>
<br>
Everyone else includes unrated players and players who have rating below zero.

</p>
<h3 class="static_header">What are the requirements for games/reporting?</h3>
<p>Although it is nice to put safety checks and ban people who violate rules, LoW believes that flaws inherent in the system should be corrected first, rather than trying to correct its defaulters. So there are no such checks as to prevent aliases etc, as the focus is on obtaining good stats and have nice games. The purpose of multiple aliases is defeated by the rating system itself, as discussed in quite some length in the official Wesnoth forums.</p>
<p>The time limits have to be agreed on by both players and the game title can be something like "LoW Ladder" or with the website URL. The winner reports the game, and the loser provides feedback. An admin interface is coming soon, until then discrepancies can be reported to <b>milwac</b> through a PM on the official Wesnoth forums.</p>
<p>Replay uploading is currently disabled in LoW and there involves a slight effort in finding the replay in the official Wesnoth replay archive and copy pasting the link while reporting. Correctly uploaded replays can thus be downloaded. And replays can thus never get lost or misplaced, as long as the link is preserved. If a replay is hard to find while reporting, a game can still be reported and the replay link can be pasted by one of the players, or someone else, later in the game discussion page.</p>

<h3 class="static_header">Contact</h3>
All requests for bug-fixes, new features or discrepancies while reporting can be addressed to <i><b>milwac</b></i> on the official Wesnoth forums <a href="http://forums.wesnoth.org/">here</a>.

</div>	
	
<?php $this->load->view('footer.php'); ?>

</div> 
</center>
</body>
</html>
