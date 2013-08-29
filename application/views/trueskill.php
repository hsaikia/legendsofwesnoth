
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
<h1 class="static_header">Trueskill</h1>	
<h3 class="static_header">What is Trueskill?</h3>
<p>From the wikipedia article : <i>"TrueSkill is a Bayesian ranking algorithm developed by Microsoft Research and used in the Xbox matchmaking system built to address some perceived flaws in the Elo rating system. It is an extension of the Glicko rating system to multiplayer games.
TrueSkill maintains a belief on the skill of each player; every time a player plays a game, the system accordingly changes the perceived skill of the player and acquires more confidence about this perception."</i></p>

<p>So essentially a player's strength is denoted by two numbers - the mean(or mu, let's call it M) and the variance (or sigma, let's call it V, aka standard deviation or volatility in some contexts). The mean or M signifies the player's rating and the variance or V provides a measure of how "sure" can one be about this rating. The actual Trueskill rating is given by R = M - 3*V which is a conservative estimate of a player's rating. This means that one can say with a confidence of 99% that the said player is stronger than what his rating suggests. LoW uses the standard values of these parameters and they are M = 25 and V = 25/3, so every player starts of with a rating of R = 25 - 3 * (25/3) = 0.</p>
<p>In LoW this value (usually a decimal point number below 100) is multiplied by 100 and the remaining decimal points removed, and the rating is displayed as a 4-digit number.</p>
<h3 class="static_header">Do Trueskill ratings stagnate after a certain point?</h3>
<p>It is true that with every game played, the system becomes more certain of a player's true rating. Hence V drops down and further (expected)wins or (expected)losses do not change it much. For this reason an additive factor called the "dynamic factor" or let's call it T, is added to V before recalculating the new values at the start of every game. This helps in lending a bit of uncertainty to a player's strength before each game.</p>
<p>Although addition of the dynamic factor does reduce complete stagnation, a player might still play just one game in a month (or whatever the norms of the ladder are) and still stay on top for years. This is not what is needed in a community which promotes active participation in the game. Hence a new way of adding an extra additive element representing "activity" to the variance is currently being researched upon. This parameter in all likelyhood will grow exponentially with time and will help more active players to be ranked higher up. And inactive players will notice a drop in rating which will increase exponentially as time progresses. For very long periods of inactivity, such players cannot, for example stay in the Top 10. Also players playing more games in a month would enjoy a lower variance as compared to players playing only one game per month. And as one less point in variance contributes to three points in actual rating, more active players would stay on top longer. As an example a slow exponential growth function can be proportional to 2^(num_days_since_last_game) can be considered. Again, this is still being discussed and large rating drops will not be observed for inactive periods within a month. Also the variance will stop growing beyond the standard start variance of 25/3.</p>
<p>Addition of this factor will hopefully result in reduced rating stagnation at the top of the ladder, false reports against inactive players (as they won't be worth much), and more quality games being played.</p>

<h3 class="static_header">How does the color coding scheme help in determining game quality?</h3>
<p>Game quality is an important feature of any game (or sport) and the appeal of a certain game arises from the quality of its recorded games. The Trueskill standard parameter 'beta' (let's call it B) is a measure of what the likely outcome of a match between two players is before the start of the match. In essence if Player 1 has a rating of R1 and Player 2 has a rating of R2, and R1 - R2 > B, then there is a 80% chance of Player 1 winning the match and a 20% chance for Player 2. The color coding is done so as different skill classes (colors) are a multiple of B (standard value of 25/6, in LoW this is multiplied by 100 so B = 2500/6 ~ 416 points). So essentially if Player 2 is two color levels below Player 1, she only has a less than 20% chance of winning against him. This hugely depends on other factors too though, and only makes sense after each player has played a minimum of 10-12 games.</p>
<h3 class="static_header">Can you explain in more detail how stuff changes after a game?</h3>
<p>Sure. Let's pick up this great example (and images) from Jeff Moser's <a href="http://www.moserware.com/2010/03/computing-your-skill.html">brilliant article</a> on Trueskill</p>
<p>The article says : "Let’s say we have Eric, an experienced player that has played a lot and established his rating over time. In addition, we have newbie: Natalia."</p>
<p>"Here’s what their skill curves might look like before a game:"</p>
<img src="<?php echo base_url(); ?>assets/images/TrueSkillCurvesBeforeExample.png" height="200"/><img />
<img src="<?php echo base_url(); ?>assets/images/TrueSkillCurvesAfterExample.png" height="200"/><img />
<p>"Notice how Natalia’s skill curve becomes narrower and taller (i.e. makes a big update) while Eric’s curve barely moves. This shows that the TrueSkill algorithm thinks that she’s probably better than Eric, but doesn’t how much better. Although TrueSkill is a little more confident about Natalia’s mean after the game (i.e. it’s now taller in the middle), it’s still very uncertain. Looking at her updated bell curve shows that her skill could be between 15 and 50."</p>

<h3 class="static_header">Ok, but what if people still find ways to "beat" the system?</h3>
<p>Sure, and we'll try to correct it! Again keeping up with the LoW philosophy of improving the system and not put restrictions on players, or ban defaulters. It is always observed that most people don't need rules, and those who break them, break them anyway! We will consistently strive to achieve what is best for the community in general and keep changing for the better as and when the need arises.</p>
	
<h3 class="static_header">References</h3>	
<ul>
<li>Jeff Moser's article <a href="http://www.moserware.com/2010/03/computing-your-skill.html">[http://www.moserware.com/2010/03/computing-your-skill.html]</a></li>
<li>Microsoft's official Trueskill page <a href="http://research.microsoft.com/en-us/projects/trueskill/">[http://research.microsoft.com/en-us/projects/trueskill/]</a></li>
</ul>
</div>
<?php $this->load->view('footer.php'); ?>

</div> 
</center>
</body>
</html>
