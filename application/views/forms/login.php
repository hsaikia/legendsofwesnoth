<?php echo form_open('user_session/login'); ?>
<div id="userpanel">
<table cellspacing="0">
	<tbody>
	<tr>
	<td><div class="form_label">Email Address </div></td>
	<td><div class="form_label">Password </div></td>
	</tr>
	<tr>
		<td><div class="form_input"><input type="text" name="email" value="" size="18" /></div></td>
		<td><div class="form_input"><input type="password" name="password" value="" size="18" /></div></td>
		<td><div class="form_submit"><input id="gobutton" type="submit" value="Log in" size="3" /></div></td>
	</tr>
	<tr>
		<td><input type="checkbox" name="remember" value="true"/> Remember Me?</td>
		<td><a href=#>Forgot Password?</a></td>
	</tr>
	</tbody>
</table>
</div>
<?php echo form_close(); ?>

