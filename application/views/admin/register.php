<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
</head>
<body>
    <h2>Register New User</h2>

		<?php if ($this->session->flashdata('success')) { ?>
		<p style="color:green;"><?php echo $this->session->flashdata('success'); ?></p>
		<?php } ?>

	<?php echo validation_errors(); // Show validation errors ?>
    <form method="post" action="<?php echo base_url('home/register_process'); ?>" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name"><br><br>

        <label>Email:</label>
        <input type="email" name="email"><br><br>

        <label>Password:</label>
        <input type="password" name="password"><br><br>

        <button type="submit">Register</button>
    </form>
	<p>Already have an account? <a href="<?php echo site_url('home/login'); ?>">Login here</a></p>

</body>
</html>
