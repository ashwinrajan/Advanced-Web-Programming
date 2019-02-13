<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assignment 5</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</head>
<body>

	<div class="container">
		<h1>Assignment 5</h1>

		<h3>Phonebook table</h3>

		<div class="dropdown pull-right">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sort By
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="crud.ctrl.php?act=orderByFirstName">First Name (A-Z)</a></li>
			  <li><a href="crud.ctrl.php?act=orderByFirstNameDesc">First Name (Z-A)</a></li>
			  <li><a href="crud.ctrl.php?act=orderByLastName">Last Name (A-Z)</a></li>
			  <li><a href="crud.ctrl.php?act=orderByLastNameDesc">Last Name (Z-A)</a></li>
			  <li><a href="crud.ctrl.php?act=orderByEmail">Email (A-Z)</a></li>
			  <li><a href="crud.ctrl.php?act=orderByEmailDesc">Email (Z-A)</a></li>
			</ul>
		</div>

		<!-- Trigger the modal with a button -->
		<button type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#addModal">Add New Phonebook Record</button>


		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Location</th>
					<th>MC</th>
					<th>POS</th>
					<th>Dept</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?
			  foreach ($TPL["phonebook"] as $phonebookdata)
			  {
				?> 
				<tr>
				  <td><?= $phonebookdata["id"] ?></td>
				  <td><?= $phonebookdata["fname"] ?></td>
				  <td><?= $phonebookdata["lname"] ?></td>
				  <td><?= $phonebookdata["phone"] ?></td>
				  <td><?= $phonebookdata["email"] ?></td>
				  <td><?= $phonebookdata["location"] ?></td>
				  <td><?= $phonebookdata["mc"] ?></td>
				  <td><?= $phonebookdata["pos"] ?></td>
				  <td><?= $phonebookdata["dept"] ?></td>
				  <td style="text-align: center">
                        <div class="btn-toolbar">
                            <div class="btn-group">
								<a data-toggle="modal" role="button" class="btn btn-success updateModal" 
								data-id="<?php echo $phonebookdata["id"];?>"
								data-first_name="<?php echo $phonebookdata["fname"];?>" 
								data-last_name="<?php echo $phonebookdata["lname"];?>"
								data-phone="<?php echo $phonebookdata["phone"];?>"
								data-email="<?php echo $phonebookdata["email"];?>"
								data-location="<?php echo $phonebookdata["location"];?>"
								data-mc="<?php echo $phonebookdata["mc"];?>"
								data-pos="<?php echo $phonebookdata["pos"];?>"
								data-dept="<?php echo $phonebookdata["dept"];?>">Update</a>
								<a href="crud.ctrl.php?act=delete&id=<?= $phonebookdata["id"] ?>" role="button" class="btn btn-danger">Delete</a>
							</div>
                        </div>
				  </td>
				</tr>
				<?
			  }
			?>	
			</tbody>
		 </table>

		 <!-- Add Modal -->
		  <div class="modal fade" id="addModal" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Phonebook Add Form</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form" method="post" action="crud.ctrl.php?act=insert">
						<div class="form-group">
							<label for="fname" class="col-sm-3 control-label">First Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="firstname" name="fname" placeholder="First Name">
							</div>
						</div>
						<div class="form-group">
							<label for="lname" class="col-sm-3 control-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="lastname" name="lname" placeholder="Last Name">
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-3 control-label">Phone</label>
							<div class="col-sm-9">
								<input type="tel" class="form-control" id="phoneNo" name="phone" placeholder="Phone">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="emailAddr" name="email" placeholder="example@domain.com" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="loc" class="col-sm-3 control-label">Location</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="location" name="loc" placeholder="location" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="mc" class="col-sm-3 control-label">MC</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="mcNo" name="mc" placeholder="MC" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="pos" class="col-sm-3 control-label">POS</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="position" name="pos" placeholder="POS" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="dept" class="col-sm-3 control-label">Dept</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="department" name="dept" placeholder="dept" value="">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<input id="submit" name="submit" type="submit" value="Add" class="btn btn-primary">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
	      </div>

		 <!-- Update Modal -->
		  <div class="modal fade" id="updateModal" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Phonebook Update Form</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form" method="post" action="crud.ctrl.php?act=update">
						<div class="form-group">
							<label for="fname" class="col-sm-3 control-label">First Name</label>
							<div class="col-sm-9">
								<input type="hidden" class="form-control" id="phonebookId" name="phoneid"> 
								<input type="text" class="form-control" id="firstname2" name="fname2" placeholder="First Name">
							</div>
						</div>
						<div class="form-group">
							<label for="lname" class="col-sm-3 control-label">Last Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="lastname2" name="lname2" placeholder="Last Name">
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-3 control-label">Phone</label>
							<div class="col-sm-9">
								<input type="tel" class="form-control" id="phoneNo2" name="phone2" placeholder="Phone">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="emailAddr2" name="email2" placeholder="example@domain.com" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="loc" class="col-sm-3 control-label">Location</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="location2" name="loc2" placeholder="location" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="mc" class="col-sm-3 control-label">MC</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="mcNo2" name="mc2" placeholder="MC" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="pos" class="col-sm-3 control-label">POS</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="position2" name="pos2" placeholder="POS" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="dept" class="col-sm-3 control-label">Dept</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="department2" name="dept2" placeholder="dept" value="">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<input id="submit" name="submit" type="submit" value="Update" class="btn btn-primary">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
	      </div>
	</div>

	<script>

	$(document).ready(function(){
		$(document).on('click', '.updateModal', function(){
			var id=$(this).data('id');
			var fname=$(this).data('first_name');
			var lname=$(this).data('last_name');
			var phone=$(this).data('phone');
			var email=$(this).data('email');
			var location=$(this).data('location');
			var mc=$(this).data('mc');
			var pos=$(this).data('pos');
			var dept=$(this).data('dept');

	 
			$('#updateModal').modal('show');
			$('#phonebookId').val(id);
			$('#firstname2').val(fname);
			$('#lastname2').val(lname);
			$('#phoneNo2').val(phone);
			$('#emailAddr2').val(email);
			$('#location2').val(location);
			$('#mcNo2').val(mc);
			$('#position2').val(pos);
			$('#department2').val(dept);
		});
	});
	
	</script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>