<?php require 'header.php'; ?>

<h2>Login</h2>

<div class="messages">
    <ul>
        <?php        
            if (isset($_SESSION['loginForm']['validationResults']['errors'])):
                foreach ($_SESSION['loginForm']['validationResults']['errors'] as $error):
                    echo "<li>$error</li>";
                endforeach;
            endif;
        ?>
    </ul>
</div>

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
