<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="container mt-5">

<?php if ($this->session->flashdata("message")): ?>
				<div class="alert alert-success">
					<?= $this->session->flashdata("message"); ?>
				</div>
			<?php endif; ?>

    <h2 class="text-center">Form Submissions</h2>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
				<th>Table No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
				<th>Date/Time</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($form_data)) { ?>
                <?php foreach ($form_data as $key => $value) { ?>
                    <tr>
						<td><?=$key+1?></td>
                        <td><?= htmlspecialchars($value['tbl_name']) ?></td>
                        <td><?= htmlspecialchars($value['tbl_email']) ?></td>
                        <td><?= htmlspecialchars($value['tbl_message']) ?></td>
						<td><?=$value['entry_time']?></td>
						<td style="white-space: nowrap;" class="">
							<a href="<?= base_url()?>crudcontroller/edit_form/<?= $value['table_id']?>" class="btn btn-success  m-3">
								<i class="fa fa-edit"></i>
							</a>
							<a href="<?= base_url()?>crudcontroller/delete_form/<?= $value['table_id']?>" class="btn btn-danger m-3"
								onclick="return confirm('Are you sure ....');">
								<i class="fa fa-trash"></i>
							</a>
						</td>
                    </tr>

                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3" class="text-center">No data available</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

		

</body>
</html>
