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
			<form action="<?= base_url('CrudController/update_form'); ?>" method="post">
			<input type="hidden" name="table_id" value="<?= $form['table_id'] ?>">

				
				<label for="tbl_name" class="form-label">Name</label>
				<input class="form-control" type="text" name="tbl_name" value="<?=$form['tbl_name']?>">

				<label for="tbl_email" class="form-label">Email</label>
				<input class="form-control" type="email" name="tbl_email" value="<?=$form['tbl_email']?>">

				<label for="tbl_message" class="form-label">message</label>
				<textarea class="form-control"  name="tbl_message"><?=$form['tbl_message']?></textarea>

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
