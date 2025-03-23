<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
</head>

<body>
	<dib class="container">
		<div class="row">
			<div class="text-center">
				<h2>Login</h2>

				<?php if ($this->session->flashdata('error')): ?>
					<p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
				<?php endif; ?>

				<div class="col">
					<form action="<?php echo site_url('login/login_process'); ?>" method="post">
						<label>UserName:</label>
						<input type="text" name="username" required><br>

						<label>Password:</label>
						<input type="text" name="password" required><br>

						<button type="submit">Login</button>
					</form>

					<p>Don't have an account? <a href="<?php echo site_url('home/register'); ?>">Register here</a></p>

				</div>

			</div>
		</div>
	</dib>





</body>

</html>

<!-- <form method="post" action="<?= base_url('login/login_process'); ?>">
    <input type="text" name="username" placeholder="Enter Username">
    <input type="password" name="password" placeholder="Enter Password">
    <button type="submit">Login</button>
</form> -->
