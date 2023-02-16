<?php require_once __DIR__ . '/layout/header.php'; ?>
	<!-- <h1>Edit User</h1>
	<form method="POST" action="/edit_user/<?= $user->getId() ?>">
		<input type="hidden" name="id" value="<?= $user->getId() ?>">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" value="<?= $user->getName() ?>"><br>
		<label for="email">Email:</label>
		<input type="email" name="email" id="email" value="<?= $user->getEmail() ?>"><br>
		<button type="submit">Update User</button>
	</form>
	<a href="/">Back to List</a> -->

	<div class="container">
	<h1>Add User</h1>
	<form method="POST" action="/edit_user/<?= $user->getId() ?>">
		<input type="hidden" name="id" value="<?= $user->getId() ?>">
		<div class="row g-2">
			<div class="col-md">
				<div class="form-floating">
				<input type="text"  name="name" id="name" class="form-control" value="<?= $user->getName() ?>">
				<label for="name">Name</label>
				</div>
			</div>

			<div class="col-md">
				<div class="form-floating">
				<input type="email" name="email" id="email" class="form-control" value="<?= $user->getEmail() ?>">
				<label for="email">Email</label>
				</div>
			</div>
		</div><br>
		<button type="submit" class="btn btn-primary">Update User</button>
	</form>
	<a href="/">Back to List</a>
</div>
<?php require_once __DIR__ . '/layout/footer.php'; ?>