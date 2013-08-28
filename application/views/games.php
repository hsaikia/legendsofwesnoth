<?php $this->load->view('title.php'); ?> 
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
</div>
<?php if ($this->ion_auth->logged_in()) include "user_menu.php"; ?>	
<div class="content" style="font-size:14px;">
<h2>Recent 1 vs 1 Games</h2>
<table style="width:900px;">
<?php include "game_list.php" ?>
</table>
</div>

</div>
</center>
</body>
<?php $this->load->view('footer.php'); ?> 
