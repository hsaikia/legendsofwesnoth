<div>
<table><tr>
	<td>
	<table><tr><td>
	<div id="descnav">	
	<ul>
	<li><a href="#">Trueskill</a></li>
	<li><a href="#">Recent News</a></li>
	<li><a href="#">FAQ</a></li>
	<?php if ($this->ion_auth->logged_in()) {echo '<li><a href="'; echo site_url('user_session/modify'); echo '">Edit Profile</a></li>';}?>
	</ul>
	</div>
		</td></tr><tr><td>
	<?php if ($this->ion_auth->logged_in()) include "top10.php"; ?>
		</td></tr>
		<tr><td>
	<?php if ($this->ion_auth->logged_in()) include "top10_2v2.php"; ?>
		</td></tr>
		</table>
	
	</td>

<td width="70%">
<div id="contents" class="content">
	<?php include('trueskill.php');?>
</div>
</td>
</tr>
</table>
</div>
