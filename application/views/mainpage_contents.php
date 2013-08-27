<div id="main_contents">
	<div id="left_sidebar">	
		<div><?php if ($this->ion_auth->logged_in()) include "top10.php"; ?></div>
		<div><?php if ($this->ion_auth->logged_in()) include "top10_2v2.php"; ?></div>
	</div>

	<div id="main_text">
		<?php include('trueskill.php');?>
	</div>
</div>
