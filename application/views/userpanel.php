<div id="userpanel_active">
	<?php 
		global $logged_in_user; 
		$logged_in_user = $this->ion_auth->user()->row()->username; 
	?>
<table>
<tr>
<td><a style="background:#770000" class="menulink" href="<?php echo site_url('user_session/view_profile/'. $logged_in_user); ?>">
<?php echo $logged_in_user; ?></a></td>
<td><a style="background:#003300" class="menulink" href="<?php echo site_url('user_session/view_players') ; ?>">Players</a></td>
<td><a style="background:#aa77ee" class="menulink" href="<?php echo site_url('report_game/request/'); ?>">Report 1 vs 1</a></td>
</tr>
<tr>
<td><a style="background:#127473" class="menulink" href="<?php echo site_url('report_game/request2v2/'); ?>">Report 2 vs 2</a></td>
<td><a style="background:#000066" class="menulink" href="<?php echo site_url('user_session/view_all_games/'); ?>">Games</a></td>
<td><a style="background:#99ff33" class="menulink" href="<?php echo site_url('user_session/logout'); ?>">Logout</a></td>
</tr>
</table>	
</div>
