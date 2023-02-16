<?php require_once __DIR__ . '/layout/header.php'; ?>
<div class="container">
	<h1>Add User</h1>
	<form method="POST" action="/add_user">
		<div class="row g-2">
			<div class="col-md">
				<div class="form-floating">
				<input type="text"  name="name" id="name" class="form-control" >
				<label for="name">Name</label>
				</div>
			</div>

			<div class="col-md">
				<div class="form-floating">
				<input type="email" name="email" id="email" class="form-control" >
				<label for="email">Email</label>
				</div>
			</div>
		</div><br>
		<button type="submit" class="btn btn-primary">Add User</button>
	</form>
	<a href="/">Back to List</a>
</div>
<?php require_once __DIR__ . '/layout/footer.php'; ?>