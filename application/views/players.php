<?php $this->load->view('title.php'); ?>
<?php include_once "globals.php" ?> 
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
</div>
<?php if ($this->ion_auth->logged_in()) include "user_menu.php"; ?>	
<div class="content" style="font-size:14px;">
<h2>Ladder 1 vs 1</h2>	
<table style="width:600px;">
<?php 
$i = 1;
foreach ($profiles as $profile) {
	echo "<tr>
	<td class='playerinfo'>". $i ."</td>
	<td class='playerinfo'>". getColoredHandle($profile->handle, $profile->rating) . "</td>
	<td class='playerinfo'><img width='20' src='". base_url() . $profile->country . "'/></td>
	<td class='playerinfo'>". round(100*$profile->rating, 0) ."</td></tr>";
	$i = $i + 1;
} 
?>
</table>
</div>

</div>
</center>
</body>
<?php $this->load->view('footer.php'); ?> 
