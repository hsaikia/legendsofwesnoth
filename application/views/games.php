<?php $this->load->view('title.php'); ?> 
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php"; ?> 
<?php include "main_menu.php"; ?>
</div>

<div class="content" style="font-size:14px;">
<table style="width:900px;">
<?php include "game_list.php" ?>
</table>
</div>

</div>
</center>
</body>
<?php $this->load->view('footer.php'); ?> 
