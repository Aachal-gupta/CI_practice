<!-- Show validation errors -->
<?php echo validation_errors('<p style="color: red;">', '</p>'); ?>


<div class="page-wrapper">
	<div class="page-content">
		

		<div class="container col-md-8">
		<h2 class="text-center p-2">Add New User</h2>

		<form action="<?php echo base_url('admin/update_user'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="table_id" value="<?= isset($edit_user['table_id']) ? $edit_user['table_id'] : '' ?>">

				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="name">Name:</label>
						<input type="text" class="form-control" name="name" value="<?= $edit_user['name'] ?>" required>
					</div>

					<div class="col-md-6 mb-3">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="email" value="<?= $edit_user['email'] ?>" required>
					</div>

					<div class="col-mb-6">
						<label for="image">Current Image</label><br>
						<?php if (!empty($edit_user['image'])): ?>
							<img src="<?= base_url('uploads/' . $edit_user['image']); ?>" alt="User Image" width="100">
						<?php else: ?>
							<p>No Image Available</p>
						<?php endif; ?>
					</div>

					<div class="col-mb-6">
						<label for="image">File Upload </label>
						<input type="file" class="form-control" name="upload_file">
					</div>


					<div class="text-center">
						<button type="submit" class="btn btn-primary col-md-4 text-center">Add User</button>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>

