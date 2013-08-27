<?php $this->load->view('title.php'); ?> 
<body>
<center>
<div id="main">
<div id="header">
<?php $this->load->view('logo.php'); ?>
<?php $this->load->view('main_menu.php');?>
</div> <!-- end header -->
<?php echo validation_errors(); ?>
<div id="report1v1" class="content">
	<h2>Report win</h2>
	<?php echo form_open('report_game/add_game'); ?>
	<input type="hidden" name="winner_handle" value="<?php echo $this->ion_auth->user()->row()->username; ?>"/>
	
	<table>
		<tr><td><hr></td><td><hr></td></tr>
		<tr><td class="label">Opponent</td><td class="field"><input type="text" name="loser_handle" id="opp_handle" /></td></tr>
		<tr>
		<td class="label">Map</td>
		<td class="field">
			<select name="map">
			<?php
				global $maps;
				foreach($maps as $key => $value)
					echo "<option value='". $key ."'>". $value ."</option>"
			?>
			</select>
		</td>
		</tr>
		
		<tr>
		<td class="label">You played as</td>
		<td class="field">
		<select name="winner">
			<option value="P1">Player 1</option>
			<option value="P2">Player 2</option>
		</select>
		
		</td>
		</tr>
		
		<tr>
		<td class="label">Your Faction</td>
		<td class="field">
		<select name="winner_faction">
			<?php
				global $faction;
				foreach($faction as $key => $value)
					echo "<option value='". $key ."'>". $value ."</option>"
			?>
		</select>
		</td>
		</tr>
		<tr>
		<td class="label">Opponent's Faction</td>
		<td class="field">
		<select name="loser_faction">
			<?php
				global $faction;
				foreach($faction as $key => $value)
					echo "<option value='". $key ."'>". $value ."</option>"
			?>
		</select>
		</td>
		</tr>

		<tr>
		<td class="label">Replay (enter the full link address to the replay, optional)</td>
		<td class="field"><input type="text" name="replay"/></td>
		</tr>
		<tr>
		<td class="label">Sportsmanship</td>
		<td class="field"><select name="sports">
		<option selected value="0">-</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		</select></td>
		</tr>
		<tr><td><hr></td><td><hr></td></tr>
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
