<?php $this->load->view('title.php'); ?> 
<body>
	<center>
<div id="main">
<div id="header">
<?php $this->load->view('logo.php'); ?> 
</div>
<div class="content">Congratulations! Your win was successfully reported! 
Click <a href="<?php echo site_url('user_session/view_profile/' . $this->ion_auth->user()->row()->username); ?>">here</a> to return to your profile!</div>
</div>
	</center>
</body>
<?php $this->load->view('footer.php'); ?> 

