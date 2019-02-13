<h2>Admin page</h2>

<p><strong><?php echo $this->session->flashdata("message"); ?></strong></p>

<h3>User Table</h3>
<table>
 <tr>
 <th>Delete</th>
 <th>Username</th>
 <th>Password</th>
 <th>Access level</th>
 </tr>
 <?php foreach ($userresults as $user) { ?>
        <tr>
		  <td><a href="<?= site_url("/Admin/deleteUser/".$user->compid)?>">D</a></td>
          <td><?= $user->username ?></td>
          <td><?= $user->password ?></td>
          <td><?= $user->accesslevel ?></td>
  </tr>      
  <?php } ?>
</table>

<br>

  <form action="index.php?/Admin/addUser" method="post" accept-charset="utf-8">
	<fieldset>
		<legend>Add new user</legend>
		<label for="username">Username:</label> <br>
		<input type="text" name="username" value="" id="username"  />
		<br>
		<label for="password">Password:</label> <br>
		<input type="text" name="password" value="" id="password"  />
		<br>
		<label for="accesslevel">Access Level:</label> <br>
		<input type="text" name="accesslevel" value="" id="accesslevel"  />
		<br>
		<input type="submit" name="submit" value="Submit"  />
	</fieldset>  
  </form>