<?php require 'header.php'; ?>

<h2>Login</h2>

<form action="/login" method="post">
    <label>
        Username:
        <input name="username" type="text" value="<?= $data['username']; ?>">
    </label>
    <label>
        Password:
        <input name="password" type="password" value="">
    </label>
    <input type="submit">
</form>

<?php require 'footer.php'; ?>
