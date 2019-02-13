<h2>Login</h2>

<p>This page is publicly accessible!</p>

<p><?php echo $this->session->flashdata("message"); ?></p>

<form action="index.php?/Login/authentication" method="post" accept-charset="utf-8">
	<fieldset>
		<legend>Login credentials</legend>
		<label for="username">Username:</label> <br>
		<input type="text" name="username" value="" id="username"  />
		 <br>
		<label for="password">Password:</label> <br>
		<input type="text" name="password" value="" id="password"  />
		 <br>
		<input type="submit" name="loginsubmit" value="Submit"  />
	</fieldset>
</form>