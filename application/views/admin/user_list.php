<div class="page-wrapper">
    <div class="page-content">
        <div class="container p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-content">
						<h2>User Details </h2>
                        <?php if ($this->session->flashdata('success')): ?>
                            <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                        <?php endif; ?>

                        <table class="table table-bordered table-responsive text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
									<th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo $user['table_id']; ?></td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
										<td>
											<img src="<?= base_url('uploads/'. $user['image']); ?>" width="100px" height="90px" alt="User Image">
										</td>
                                        <td>
                                            <a href="<?php echo base_url('admin/edit_user/' . $user['table_id']); ?>" class="btn btn-primary m-2">Edit</a>
                                            <a href="<?php echo base_url('admin/delete_user/' . $user['table_id']); ?>" class="btn btn-danger m-2">Delete</a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
