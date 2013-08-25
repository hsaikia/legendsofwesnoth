<?php $this->load->view('title.php'); ?> 
<body>
<center>
<div id="main">
<div id="header">
<?php $this->load->view('logo.php'); ?>
<?php $this->load->view('main_menu.php');?>
</div> <!-- end header -->

<div class="content">Please register if you are a new user, or <a href="<?php echo site_url('main') ?>">log in</a> if you are already registered!</div>

</div> <!-- end main -->
</body>
<?php $this->load->view('footer.php'); ?> 
