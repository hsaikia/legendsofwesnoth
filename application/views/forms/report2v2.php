<?php $this->load->view('title.php'); ?> 
<body>
<center>
<div id="main">
<div id="header">
<?php $this->load->view('logo.php'); ?>
<?php $this->load->view('main_menu.php');?>
</div> <!-- end header -->

<div class="content">
	<h2>Report 2 vs 2 win</h2>
	<?php echo form_open('report_game/add_game_2v2'); ?>
	
	Map<select name="map">
	<?php
		global $maps2v2;
		foreach($maps2v2 as $key => $value)
		echo "<option value='". $key ."'>". $value ."</option>"
	?>
	</select>
	<table>
		
	<tr><td></td><td>Handle</td><td>Faction</td><td>Position</td></tr>
	<tr><td>Winner 1</td><td><input readonly name="winner_handle1" value="<?php echo $this->ion_auth->user()->row()->username; ?>"/></td><td><select name="winner_faction1">
			<?php
				global $faction;
				foreach($faction as $key => $value)
					echo "<option value='". $key ."'>". $value ."</option>"
			?>
		</select></td><td><select name="winner1">
			<option value="P1">Player 1</option>
			<option value="P2">Player 2</option>
			<option value="P3">Player 3</option>
			<option value="P4">Player 4</option>
		</select></td>
	</tr>
	<tr><td>Winner 2</td><td><input name="winner_handle2" id="partner_handle" /></td><td><select name="winner_faction2">
			<?php
				global $faction;
				foreach($faction as $key => $value)
					echo "<option value='". $key ."'>". $value ."</option>"
			?>
		</select></td><td><select name="winner2">
			<option value="P1">Player 1</option>
			<option value="P2">Player 2</option>
			<option value="P3">Player 3</option>
			<option value="P4">Player 4</option>
		</select></td>
	</tr>
	<tr><td>Loser 1</td><td><input name="loser_handle1" id="opp_handle1"/></td><td><select name="loser_faction1">
			<?php
				global $faction;
				foreach($faction as $key => $value)
					echo "<option value='". $key ."'>". $value ."</option>"
			?>
		</select></td><td><select name="loser1">
			<option value="P1">Player 1</option>
			<option value="P2">Player 2</option>
			<option value="P3">Player 3</option>
			<option value="P4">Player 4</option>
		</select></td>
	</tr>
	<tr><td>Loser 2</td><td><input name="loser_handle2" id="opp_handle2"/></td><td><select name="loser_faction2">
			<?php
				global $faction;
				foreach($faction as $key => $value)
					echo "<option value='". $key ."'>". $value ."</option>"
			?>
		</select></td><td><select name="loser2">
			<option value="P1">Player 1</option>
			<option value="P2">Player 2</option>
			<option value="P3">Player 3</option>
			<option value="P4">Player 4</option>
		</select></td>
	</tr>
	</table>

	<table>
	<tr><td class="label"><input id="gobutton" type="submit" value="Report Win" size="3" /></td>
	<td class="field"><a href="<?php echo site_url('main') ?>"><input id="gobutton" value="Cancel" size="3" /></a></td>
	</tr>
	</table>
	<?php echo form_close(); ?>
</div>

</div> <!-- end main -->
</body>
<?php $this->load->view('footer.php'); ?> 
