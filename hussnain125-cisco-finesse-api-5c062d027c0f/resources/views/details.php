<!DOCTYPE html>
<html>
<head>
	<title>Update FQDN and other Details</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="py-5 text-center">
        	<h2>Update Finesse User Details</h2>
        	<p class="lead">Please update the finesse supervisor user details to use the API.</p>
      	</div>
		<div class="row">
			<div class="col-6 offset-3">
				<form action="/update" method="POST">
					<div class="form-group">
						<label for="fqdn">FQDN</label>
					    <input type="text" class="form-control" name="fqdn" id="fqdn" aria-describedby="FQDN" placeholder="Enter FQDN e.g finesse1.xyz.com" value="<?php echo $fqdn; ?>">
					</div>
					<div class="form-group">
					    <label for="fqdn">PORT</label>
					    <input type="text" class="form-control" name="port" id="port" aria-describedby="PORT" value="<?php echo $port; ?>" placeholder="Enter Port">
					</div>
					<div class="form-group">
					    <label for="user">Username</label>
					    <input type="text" class="form-control" name="user" id="user" value="<?php echo $user; ?>" aria-describedby="Username" placeholder="Enter Supervisor Username">
					</div>
					<div class="form-group">
					    <label for="userPassword">Password</label>
					    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" id="userPassword" placeholder="Password">
					</div>
					<div style="text-align: center;">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>	