
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

					<!-- for single file upload  -->
					<!-- <div class="col-mb-6">
						<label for="image">Current Image</label><br>
						<?php if (!empty($edit_user['image'])): ?>
							<img src="<?= base_url('uploads/' . $edit_user['image']); ?>" alt="User Image" width="100">
						<?php else: ?>
							<p>No Image Available</p>
						<?php endif; ?>
					</div> -->

					
					<!-- for multiple file upload -->
					<div class="col-mb-6">
						<label for="image">Current Image</label><br>
						<?php 
						$images = json_decode($edit_user['image'], true); // Decode JSON if multiple images
						if (is_array($images)) {
							foreach ($images as $img) {
								echo '<img src="' . base_url('uploads/' . $img) . '" width="100px" height="90px" alt="User Image" style="margin:5px;">';
							}
						} elseif (!empty($edit_user['image'])) { 
							// If only a single image is stored as a string
							echo '<img src="' . base_url('uploads/' . $edit_user['image']) . '" width="100px" height="90px" alt="User Image">';
						} else {
							echo '<p>No Image Available</p>';
						}
						?>
					</div>

					<div class="col-mb-6">
						<label for="image">Upload New Images</label>
						<input type="file" class="form-control" name="upload_file[]" multiple> <!-- Allow multiple file selection -->
					</div>



					<div class="text-center">
						<button type="submit" class="btn btn-primary col-md-4 text-center">Add User</button>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>

