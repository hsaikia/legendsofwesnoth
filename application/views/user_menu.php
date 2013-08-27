<?php 
	global $logged_in_user; 
	$logged_in_user = $this->ion_auth->user()->row()->username; 
?>

<div id="user_menu">
<ul>
<li><a href="<?php echo site_url('user_session/view_profile/'. $logged_in_user); ?>">
<?php echo $logged_in_user; ?></a></li>
<li><a href="<?php echo site_url('user_session/view_all_games/'); ?>">Games</a></li>
<li><a href="<?php echo site_url('user_session/view_all_games_2v2/'); ?>">Games 2 v 2</a></li>
<li><a href="<?php echo site_url('report_game/request/'); ?>">Report</a></li>
<li><a href="<?php echo site_url('report_game/request2v2/'); ?>">Report 2 v 2</a></li>
<li><a href="<?php echo site_url('user_session/view_players') ; ?>">Ladder</a></li>
<li><a href="<?php echo site_url('user_session/view_players2v2') ; ?>">Ladder 2 v 2</a></li>
<li><a>Trueskill</a></li>
<li><a>FAQ</a></li>
<li><a href="<?php echo site_url('user_session/modify');?>">Edit Profile</a></li>
<li><a href="<?php echo site_url('user_session/logout'); ?>">Logout</a></li>
</ul>
</div>
