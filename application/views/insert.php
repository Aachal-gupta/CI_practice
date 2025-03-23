<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row p-3 m-5" style="border: 1px solid black;">
        <h2>Application Form</h2>
        <div class="col-md-6 p-3">
			<form action="<?= base_url('CrudController/insert_data'); ?>" method="post">
				<label for="tbl_name" class="form-label">Name</label>
				<input class="form-control" type="text" name="tbl_name" value="<?= set_value('tbl_name'); ?>" placeholder="Enter Name...">
				<small class="text-danger"><?= form_error('tbl_name'); ?></small>

				<label for="tbl_email" class="form-label">Email</label>
				<input class="form-control" type="email" name="tbl_email" value="<?= set_value('tbl_email'); ?>" placeholder="Enter Email....">
				<small class="text-danger"><?= form_error('tbl_email'); ?></small>

				<label for="tbl_message" class="form-label">message</label>
				<textarea class="form-control" placeholder="Enter Your Message...." name="tbl_message"><?= set_value('tbl_message'); ?></textarea>
				<small class="text-danger"><?= form_error('tbl_message'); ?></small>

				<div class="p-3">
				<button class="btn btn-success" type="submit">Submit</button>
				</div>
			</form>

			<?php if ($this->session->flashdata("message")): ?>
				<div class="alert alert-success">
					<?= $this->session->flashdata("message"); ?>
				</div>
			<?php endif; ?>

			

        </div>
    </div>
</div>

</body>
</html>
