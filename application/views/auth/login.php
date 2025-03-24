<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if ($this->session->flashdata('error')): ?>
        <p><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <form method="POST" action="<?php echo site_url('Auth/login_process'); ?>">
        <label>Email:</label>
        <input type="text" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
