<!-- Show validation errors -->
<?php echo validation_errors('<p style="color: red;">', '</p>'); ?>

<div class="page-wrapper">
	<div class="page-content">
		

		<div class="container col-md-8">
		<h2 class="text-center p-2">Add New User</h2>

			<form action="<?php echo base_url('admin/insert_user'); ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="name">Name:</label>
						<input type="text" class="form-control" name="name" required>
					</div>

					<div class="col-md-6 mb-3">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="email" required>
					</div>

					<div class="col-md-6">
						<label for="fiel">Upload File</label>
						<input type="file" class="form-control" name="upload_file" required>
					</div>

					<div class="text-center p-3">
						<button type="submit" class="btn btn-primary col-md-4 text-center">Add User</button>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>
