<?php $this->load->view('title.php'); ?> 
<body>
	<center>
<div id="main">
<div id="header">
<?php $this->load->view('logo.php'); ?> 
</div>
<div class="content">Your comment was successfully posted. Click <a href="<?php echo site_url('user_session/view_all_games'); ?>">here</a> to go back to the games list.</div>
</div>
	</center>
</body>
<?php $this->load->view('footer.php'); ?> 

