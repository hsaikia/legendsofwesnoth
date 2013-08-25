<div id="menu">
	<?php if (!$this->ion_auth->logged_in()) include('forms/login.php'); else include('userpanel.php'); ?>
</div> <!-- end menu -->
