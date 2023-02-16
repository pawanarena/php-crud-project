<?php require_once __DIR__ . '/layout/header.php'; ?>
<div class="container">
	<h1>List Users</h1>
	<a href="/add_user">add User</a>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php $count = 1 + $perPage * ($currentPage - 1); ?>
			<?php if(count($users)>0): ?>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?php echo $count++; ?></td>
						<td><?= $user->getName() ?></td>
						<td><?= $user->getEmail() ?></td>
						<td>
							<div class="row">
								<div class="col-md-6">
									<a class="btn btn-primary btn-sm" href="/edit_user/<?= $user->getId() ?>">Edit</a>
								</div>
								<div class="col-md-6">
									<form method="POST" action="/delete_user">
									<input type="hidden" name="id" value="<?= $user->getId() ?>">
									<button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">Delete</button>
									</form>
								</div>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else:?>
				<tr>
					<td colspan="4">No users found</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php require_once __DIR__ . '/pagination/pagination.php'; ?>
	<a href="/">Back to List</a>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>