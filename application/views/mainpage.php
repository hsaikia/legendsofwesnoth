<!DOCTYPE html>
<html lang="en">
<?php include "title.php"?>
<body>
<center>
<div id="main">
<div id="header">
<?php include "logo.php" ?>
<?php include "main_menu.php" ?>
</div> <!-- end header -->
<?php if ($this->ion_auth->logged_in()) include "user_menu.php"; ?>
<div id="imageslider">
<iframe src="<?php echo base_url(); ?>assets/navigation/carousel.html" height="300" width="950" scrolling="no" frameborder="0"></iframe>
</div> <!-- end imageslider -->

<?php if ($this->ion_auth->logged_in()) include "mainpage_contents.php"; else include "register_now.php"; ?>

</div> <!-- end main -->
</center>
<body>
<br>
<?php include "footer.php"?>
</html>
